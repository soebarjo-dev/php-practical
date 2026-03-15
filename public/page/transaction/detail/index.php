<div class="bg-white shadow p-4">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold text-gray-700">Detail Transaksi</h2>
        <a href="?page=transaction" class="text-sm text-blue-600 hover:underline">
            Kembali ke Daftar Transaction
        </a>
    </div>

    <div class="grid grid-cols-2 gap-x-8 gap-y-3 mb-6 text-sm">
        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">No. Invoice</p>
            <p class="font-semibold font-mono">
                <?= $transaction['invoice_number'] ?>
            </p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Tanggal</p>
            <p class="font-semibold font-mono">
                <?= $transaction['transaction_date'] ?>
            </p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Pelanggan</p>
            <p class="font-semibold font-mono">
                <?= $transaction['customername'] ?>
            </p>
        </div>

        <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Kasir</p>
            <p class="font-semibold font-mono">
                <?= $transaction['username'] ?>
            </p>
        </div>
    </div>

    <h3 class="font-semibold text-gray-700 mb-2 text-sm">Daftar Produk</h3>
    <table class="w-full border-collapse text-sm mb-6">
        <thead>
            <tr class="bg-gray-100 border">
                <th class="p-2 text-center w-10">No</th>
                <th class="p-2 text-left">Produk</th>
                <th class="p-2 text-center w-20">Qty</th>
                <th class="p-2 text-center w-36">Harga Satuan</th>
                <th class="p-2 text-center w-36">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $i => $item){ ?>
                <tr class="border hover:bg-gray-50">
                    <td class="p-2 text-center"><?= $i+1 ?></td>
                    <td class="p-2 text-left">
                        <?= $item['productname'] ?>
                    </td>
                    <td class="p-2 text-right">
                        <?= $item['quantity'] ?>
                        <span class="text-gray-400 text-xs">(<?= $item['unitsymbol'] ?>)</span>
                    </td>
                    <td class="p-2 text-right">IDR<?= number_format($item['price'], 2, ",", ".") ?></td>
                    <td class="p-2 text-right">IDR<?= number_format($item['total'], 2, ",", ".") ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="flex justify-end">
        <table class="text-sm w-72">
            <tr>
                <td class="py-1 pr-4 text-gray-500">Subtotal</td>
                <td class="py-1 text-right">IDR<?= number_format($transaction['subtotal'], 2, ",", ".") ?></td>
            </tr>
            <tr>
                <td class="py-1 pr-4 text-gray-500">Pajak (<?= number_format($transaction['tax_percent'],2) ?>%)</td>
                <td class="py-1 text-right">IDR<?= number_format($transaction['tax_amount'], 2, ",", ".") ?></td>
            </tr>
            <tr class="border-t-2 border-gray-300 font-bold">
                <td class="py-1 pr-4 text-gray-500">Grand Total</td>
                <td class="py-1 text-right">IDR<?= number_format($transaction['grand_total'], 2, ",", ".") ?></td>
            </tr>
        </table>
    </div>
</div>