<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Master Produk</h2>
        <a href="#" onclick="modalAction('modalAddProduct')" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
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
                <th class="text-center p-2">Nama</th>
                <th class="text-center p-2">Unit</th>
                <th class="text-center p-2">Harga</th>
                <th class="text-center p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($products)){ ?>
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data produk</td>
                </tr>
            <?php } else { ?>
                <?php foreach($products as $i => $product){ ?>
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center"><?= $i + 1 ?></td>
                    <td class="py-2 border-x p-2"><?= $product['productname'] ?></td>
                    <td class="py-2 border-x p-2 capitalize"><?= $product['unitname'] ?></td>
                    <td class="py-2 border-x p-2 text-right">Rp<?= number_format($product['price'],2,",",".") ?></td>
                    <td class="py-2 border-x p-2 text-center">
                        <button onclick='modalAction("modalEditProduct","open",<?= json_encode($product); ?>)' class="text-xs bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1">Edit</button>
                        <form method="POST" class="inline" onsubmit="return confirm('Apakah anda yakin menghapus data ini ?')">
                            <input type="hidden" name="_action" value="product.delete" />
                            <input type="hidden" name="id" value="<?= (int) $product['id'] ?>" />
                            <button class="text-xs bg-red-400 hover:bg-red-500 text-white px-2 py-1">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="modalAddProduct" class="hidden fixed inset-0 bg-black flex items-center justify-center z-50">
    <div class="bg-white shadow-xl p-4 w-96">
        <h3 class="text-lg font-bold mb-4">Tambah Produk</h3>
        <form method="POST" action="?page=master-product" autocomplete="off">
            <input type="hidden" name="_action" value="product.store" />
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" required autofocus />
            </div>
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Unit</label>
                <select name="unit_id" class="w-full border p-1 focus:outline-none focus:border-blue-800 capitalize" required >
                    <?php foreach($list_units as $list_unit){ ?>
                    <option value="<?= $list_unit['id'] ?>"><?= $list_unit['name'] ?> (<?= strtoupper($list_unit['symbol']) ?>)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Harga</label>
                <input type="number" name="price" class="w-full border p-1 focus:outline-none focus:border-blue-800" required />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="modalAction('modalAddProduct', 'close')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditProduct" class="hidden fixed inset-0 bg-black flex items-center justify-center z-50">
    <div class="bg-white shadow-xl p-4 w-96">
        <h3 class="text-lg font-bold mb-4">Edit Pengguna</h3>
        <form method="POST" action="?page=master-product" autocomplete="off">
            <input type="hidden" name="_action" value="product.update" />
            <input type="hidden" name="id" id="editProductId" />
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" id="editProductName" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" required autofocus />
            </div>
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Unit</label>
                <select name="unit_id" id="editProductUnitID" class="w-full border p-1 focus:outline-none focus:border-blue-800 capitalize" required >
                    <?php foreach($list_units as $list_unit){ ?>
                    <option value=<?= $list_unit['id'] ?>><?= $list_unit['name'] ?> (<?= strtoupper($list_unit['symbol']) ?>)</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Harga</label>
                <input type="number" name="price" id="editProductPrice" class="w-full border p-1 focus:outline-none focus:border-blue-800" required />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="modalAction('modalEditProduct', 'close')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<script>
    function modalAction(modalName, action='open', editedData={}){
        event.preventDefault();
        
        if (action === 'open'){
            document.getElementById(modalName).classList.remove("hidden");
                        
            if (modalName === "modalEditProduct" && Object.keys(editedData).length > 0){
                document.getElementById("editProductId").value = editedData?.id;
                document.getElementById("editProductName").value = editedData?.productname;
                document.getElementById("editProductPrice").value = editedData?.price;
                
                const unitIDSelector = document.getElementById("editProductUnitID");
                for (let i=0; i<unitIDSelector.options.length; i++){
                    unitIDSelector.options[i].selected = (parseInt(unitIDSelector.options[i].value) === editedData?.unitid);
                }
            }

        } else if(action === 'close') {
            document.getElementById(modalName).classList.add("hidden");
        }
    }
</script>