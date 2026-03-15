<?php

class TransactionController
{
    public function index(){
        return App::transaction()->getAll();
    }

    public function lists($selectedList=''){
        $list = [
            'units' => App::unit()->getAll(),
            'customers' => App::customer()->getAll(),
            'products' => App::product()->getAll(),
        ];

        $output = $list;
        if(!empty($selectedList)){
            $output = [];
            if (isset($list[$selectedList])){
                $output = $list[$selectedList];
            }
        }

        return $output;
    }

    public function store(){
        $customerID = (int) $_POST['customer_id'];
        $transactionDate = trim($_POST['transaction_date']);
        $taxPercent = (float) $_POST['tax_percent'];
        $productIDs = $_POST['product_id'];
        $quantities = $_POST['quantity'];
        $prices = $_POST['price'];
        $messages = "";

        if (empty($customerID) || $customerID <= 0 || empty($transactionDate)){
            $messages = "Pelanggan dan tanggal transaksi wajib diisi";
        }

        $items = [];
        foreach($productIDs as $idx => $productID){
            $qty = (int) ($quantities[$idx]) ?? 0;
            $price = (int) ($prices[$idx]) ?? 0;
            
            if ((int) $productID > 0 && $qty > 0 && $price > 0){
                $items[] = [
                    'product_id' => (int) $productID,
                    'quantity' => $qty,
                    'price' => $price
                ];
            }
        }

        if (empty($items)){
            $messages = "Minimal 1 item transaksi harus diisi dengan benar";
        }

        $userId = (int) current_user('id');
        $success = App::transaction()->create($userId, $customerID, $transactionDate, $taxPercent, $items);
        $messages = $success ? "Transaksi berhasil disimpan":"Gagal melakukan transaksi";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function detail($id){
        $transaction = App::transaction()->findByID($id);

        if (!$transaction){
            return false;
        }

        $items = App::transaction()->getItems($id);
        return compact('transaction', 'items');
    }

    private function baseRedirectTo(){
        redirect('?page=transaction');
    }
}