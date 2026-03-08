<?php

class Transaction extends Base
{
    public function getAll(){
        $query = "
            SELECT 
                transaction.id,
                transaction.invoice_number,
                transaction.transaction_date,
                transaction.subtotal,
                transaction.tax_percent,
                transaction.tax_amount,
                transaction.grand_total,
                transaction.created_at,
                customer.name customerName,
                user.name userName
            FROM {$this->tableName()} transaction
            JOIN {$this->tableName('customers')} customer ON customer.id = transaction.customer_id
            JOIN {$this->tableName('users')} user ON user.id = transaction.user_id
            ORDER BY transaction.transaction_date DESC, transaction.id DESC
        ";
        return $this->connection->query($query)->fetchAll();
    }

    public function findByID($id){
        $query = "
            SELECT 
                transaction.id,
                transaction.invoice_number,
                transaction.transaction_date,
                transaction.subtotal,
                transaction.tax_percent,
                transaction.tax_amount,
                transaction.grand_total,
                transaction.created_at,
                customer.name customerName,
                user.name userName
            FROM {$this->tableName()} transaction
            JOIN {$this->tableName('customers')} customer ON customer.id = transaction.customer_id
            JOIN {$this->tableName('users')} user ON user.id = transaction.user_id
            WHERE transaction.id = :paramID
            ORDER BY transaction.transaction_date DESC, transaction.id DESC
        ";

        $statement = $this->connection->prepare($query);
        return $statement->execute(['paramID' => $id])->fetch();
    }

    public function getItems($transactionId){
        $query = "
            SELECT 
                transaction_item.id,
                transaction_item.quantity,
                transaction_item.price,
                transaction_item.total,
                product.name productName,
                unit.symbol unitSymbol
            FROM {$this->tableName('transaction_items')} transaction_item
            JOIN {$this->tableName('products')} product ON product.id = transaction_item.product_id
            JOIN {$this->tableName('units')} unit ON unit.id = transaction_item.unit_id
            WHERE transaction_item.transaction_id = :paramTransactionID
        ";

        $statement = $this->connection->prepare($query);
        return $statement->execute(['paramTransactionID' => $transactionId])->fetchAll();
    }

    public function generateInvoiceNumber(){
        $prefix = "INV-" . date('Ymd') . "-";
        $query = "SELECT COUNT(*) FROM transactions WHERE invoice_number LIKE :prefix";
        $statement = $this->connection->prepare($query)->execute(['prefix' => $prefix . "%"]);

        $count = (int) $statement->fetchColumn();
        return $prefix . str_pad($count + 1, 4, 0, STR_PAD_LEFT);
    }

    public function create($createdBy, $customerId, $transactionDate, $taxPercent, $items){
        $this->connection->beginTransaction();

        try {
            $subTotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));
            $taxAmount = round(($subTotal * $taxPercent / 100), 2);
            $grandTotal = $subTotal + $taxAmount;
            $invoice = $this->generateInvoiceNumber();

            $query = "
                INSERT INTO {$this->tableName()} 
                    (user_id, customer_id, invoice_number, transaction_date, subtotal, tax_percent, tax_amount, grand_total)
                VALUES
                    (:paramUserId, :paramCustomerId, :paramInvoiceNumber, :paramTransactionDate, :paramSubtotal, :paramTaxPercent, :paramTaxAmount, :paramGrandTotal)
            ";

            $paramBind = [
                'paramUserId' => $createdBy,
                'paramCustomerId' => $customerId,
                'paramInvoiceNumber' => $invoice,
                'paramTransactionDate' => $transactionDate,
                'paramSubtotal' => $subTotal,
                'paramTaxPercent' => $taxPercent,
                'paramTaxAmount' => $taxAmount,
                'paramGrandTotal' => $grandTotal,
            ];
            $statement = $this->connection->prepare($query)->execute($paramBind);
            $transactionID = (int) $this->connection->lastInsertId();

            $queryItem = "
                INSERT INTO transaction_item
                    (transaction_id, product_id, quantity, price, total)
                VALUES
                    (:paramTransactionId, :paramProductId, :paramQuantity, :paramPrice, :paramTotal)
            ";

            $statementItem = $this->connection->prepare($queryItem);
            foreach ($items as $item){
                $total = $item['quantity'] * $item['price'];
                $statementItem->execute([
                    'paramTransactionId' => $transactionID,
                    'paramProductId' => $item['product_id'],
                    'paramQuantity' => $item['quantity'],
                    'paramPrice' => $item['price'],
                    'paramTotal' => $total,
                ]);
            }
            
            $this->connection->commit();
            return true;
        } catch(\Throwable $e){
            $this->connection->rollback();
            error_log($e->getMessage());
            return false;
        }
    }

    private function tableName($name='transactions'){
        return $name;
    }
}