<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Transaksi</h2>
        <a href="#" onclick="modalAction('modalAddTransaction')" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
            + Tambah
        </a>
    </div>

    <?php if($flashSuccess){ ?>
        <div class="mb-3 p-3 bg-green-100 border border-green-300 text-green-700 text-sm">
            <?= $flashSuccess ?>
        </div>
    <?php } ?>

    <?php if($flashError){ ?>
        <div class="mb-3 p-3 bg-red-100 border border-red-300 text-red-700 text-sm">
            <?= $flashError ?>
        </div>
    <?php } ?>

    <table class="w-full border-collapse mt-4">
        <thead>
            <tr class="bg-gray-200 border">
                <th class="text-center p-2">No.</th>
                <th class="text-center p-2">No. Invoice</th>
                <th class="text-center p-2">Tanggal</th>
                <th class="text-center p-2">Pelanggan</th>
                <th class="text-center p-2">Kasir</th>
                <th class="text-center p-2">Subtotal</th>
                <th class="text-center p-2">Pajak</th>
                <th class="text-center p-2">Grand Total</th>
                <th class="text-center p-2 w-20">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($transactions)){ ?>
                <tr>
                    <td colspan="9" class="p-4 text-center text-gray-400">Belum ada data transaksi</td>
                </tr>
            <?php } else { ?>
                <?php foreach($transactions as $i => $transaction){ ?>
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center"><?= $i + 1 ?></td>
                    <td class="py-2 border-x p-2"><?= $transaction['invoice_number'] ?></td>
                    <td class="py-2 border-x p-2 capitalize"><?= $transaction['transaction_date'] ?></td>
                    <td class="py-2 border-x p-2 text-right"><?= $transaction['customername'] ?></td>
                    <td class="py-2 border-x p-2 text-right"><?= $transaction['username'] ?></td>
                    <td class="py-2 border-x p-2 text-right">IDR<?= number_format($transaction['subtotal'], 2,",",".") ?></td>
                    <td class="py-2 border-x p-2 text-right">IDR<?= number_format($transaction['tax_amount'], 2,",",".") ?> (<?= number_format($transaction['tax_percent'],2) ?>%)</td>
                    <td class="py-2 border-x p-2 text-right">IDR<?= number_format($transaction['grand_total'], 2,",",".") ?></td>
                    <td class="py-2 border-x p-2 text-center">
                        <a href="index.php?page=transaction&detailID=<?= (int) $transaction['id'] ?>" class="text-xs bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1">Detail</a>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="modalAddTransaction" class="hidden fixed inset-0 bg-black flex items-center justify-center z-50">
    <div class="bg-white shadow-xl p-4 w-120">
        <h3 class="text-lg font-bold mb-4">Tambah Transaksi</h3>
        <form method="POST" action="?page=transaction" autocomplete="off">
            <input type="hidden" name="_action" value="transaction.store" />
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Pelanggan</label>
                <select name="customer_id" class="w-full border p-2 text-sm">
                    <?php foreach($customers as $customer){ ?>
                    <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex justify-between gap-1">
                <div class="w-full">
                    <label class="block text-sm text-gray-600 mb-1">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" value="<?= date('Y-m-d') ?>" class="w-full border p-1 focus:outline-none focus:border-blue-800" required />
                </div>
                <div class="w-full">
                    <label class="block text-sm text-gray-600 mb-1">Pajak (%)</label>
                    <input type="number" name="tax_percent" step="0.5" min="0" class="text-right w-full border p-1 focus:outline-none focus:border-blue-800" required />
                </div>
            </div>
            
            <div class="mb-2 mt-4 flex justify-between items-center">
                <h4 class="font-semibold text-gray-700 text-sm">Produk</h4>
                <button type="button" class="text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1" onclick="addProductRow()">Tambah</button>
            </div>
            <div class="mb-1 grid grid-cols-12 gap-1 text-xs text-gray-500 font-semibold">
                <div class="col-span-5">Produk</div>
                <div class="col-span-3">Qty</div>
                <div class="col-span-3">Harga Satuan</div>
                <div class="col-span-1"></div>
            </div>
            <div id="productContainer" class="mb-4"></div>

            <div class="flex justify-end gap-2 mt-3">
                <button type="button" onclick="modalAction('modalAddTransaction', 'close')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    <?php
        $productList = json_encode(
            array_map(fn($p) => [
                "id" => (int) $p['id'],
                "name" => $p['productname'],
                "price" => (float) $p['price'],
            ], $products), JSON_UNESCAPED_UNICODE
        );
    ?>
    const productList = <?= $productList; ?>


    function addProductRow(){
        const container = document.getElementById('productContainer')
        const idx = container.children.length
        const options = productList.map(p => 
            `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`
        )
        const row = document.createElement('div')

        row.className = "grid grid-cols-12 gap-1 mb-2 items-center"
        row.innerHTML = `
            <div class="col-span-5">
                <select name="product_id[]" onchange="fillPrice(this, ${idx})" class="w-full border p-1 focus:outline-none focus:border-blue-800">
                    <option>-- Produk --</option>
                    ${options}
                </select>
            </div>
            <div class="col-span-3">
                <input type="number" name="quantity[]" class="text-right w-full border p-1 focus:outline-none focus:border-blue-800" required />
            </div>
            <div class="col-span-3">
                <input type="number" id="price_${idx}" name="price[]" class="text-right w-full border p-1 focus:outline-none focus:border-blue-800" required readonly />
            </div>
            <div class="col-span-1 text-center">
                <button type="button" onclick="this.closest('.grid').remove()" class="text-red-500 hover:text-red-600 font-bold text-lg leading-none">x</button>
            </div>
        `

        container.appendChild(row)
    }

    function fillPrice(select, idx){
        const option = select.options[select.selectedIndex]
        document.getElementById('price_' + idx).value = option.getAttribute('data-price') || ''
    }

    function modalAction(modalName, action='open', editedData={}){
        event.preventDefault();

        if (action === 'open'){
            document.getElementById(modalName).classList.remove("hidden");
                        
            if (modalName === "modalEditUnit" && Object.keys(editedData).length > 0){
                document.getElementById("editUnitId").value = editedData?.id;
                document.getElementById("editUnitName").value = editedData?.name;
                document.getElementById("editUnitSymbol").value = editedData?.symbol;
            }

        } else if(action === 'close') {
            document.getElementById(modalName).classList.add("hidden");
        }
    }
</script>