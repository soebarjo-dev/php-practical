<div class="bg-white shadow p-4">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-2">Master Pelanggan</h2>
        <a href="#" onclick="modalAction('modalAddCustomer')" class="bg-blue-600 text-white p-1 hover:bg-blue-700 inline-block mb-2">
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
                <th class="text-center p-2">E-Mail</th>
                <th class="text-center p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($customers)){ ?>
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data pengguna</td>
                </tr>
            <?php } else { ?>
                <?php foreach($customers as $i => $customer){ ?>
                <tr class="border hover:bg-gray-100">
                    <td class="w-24 border-x p-2 text-center"><?= $i + 1 ?></td>
                    <td class="py-2 border-x p-2"><?= $customer['name'] ?></td>
                    <td class="py-2 border-x p-2"><?= $customer['email'] ?></td>
                    <td class="py-2 border-x p-2 text-center">
                        <button onclick='modalAction("modalEditCustomer","open",<?= json_encode($customer); ?>)' class="text-xs bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1">Edit</button>
                        <form method="POST" class="inline" onsubmit="return confirm('Apakah anda yakin menghapus data ini ?')">
                            <input type="hidden" name="_action" value="customer.delete" />
                            <input type="hidden" name="id" value="<?= (int) $customer['id'] ?>" />
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

<div id="modalAddCustomer" class="hidden fixed inset-0 bg-black flex items-center justify-center z-50">
    <div class="bg-white shadow-xl p-4 w-96">
        <h3 class="text-lg font-bold mb-4">Tambah Pelanggan</h3>
        <form method="POST" action="?page=master-customer" autocomplete="off">
            <input type="hidden" name="_action" value="customer.store" />
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" required autofocus />
            </div>
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">E-Mail</label>
                <input type="email" name="email" class="w-full border p-1 focus:outline-none focus:border-blue-800" required />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="modalAction('modalAddCustomer', 'close')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditCustomer" class="hidden fixed inset-0 bg-black flex items-center justify-center z-50">
    <div class="bg-white shadow-xl p-4 w-96">
        <h3 class="text-lg font-bold mb-4">Edit Pelanggan</h3>
        <form method="POST" action="?page=master-customer" autocomplete="off">
            <input type="hidden" name="_action" value="customer.update" />
            <input type="hidden" name="id" id="editCustomerId" />
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">Nama</label>
                <input type="text" id="editCustomerName" name="name" class="w-full border p-1 focus:outline-none focus:border-blue-800" required autofocus />
            </div>
            <div class="mb-3">
                <label class="block text-sm text-gray-600 mb-1">E-Mail</label>
                <input type="email" id="editCustomerEmail" name="email" class="w-full border p-1 focus:outline-none focus:border-blue-800" required />
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="modalAction('modalEditCustomer', 'close')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm">Batal</button>
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
                        
            if (modalName === "modalEditCustomer" && Object.keys(editedData).length > 0){
                document.getElementById("editCustomerId").value = editedData?.id;
                document.getElementById("editCustomerName").value = editedData?.name;
                document.getElementById("editCustomerEmail").value = editedData?.email;
            }

        } else if(action === 'close') {
            document.getElementById(modalName).classList.add("hidden");
        }
    }
</script>