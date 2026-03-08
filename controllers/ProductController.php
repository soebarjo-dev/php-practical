<?php

class ProductController
{
    public function index(){
        return App::product()->getAll();
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

    public function store() {
        $name = trim($_POST['name'] ?? '');
        $unitID = (int) trim($_POST['unit_id'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $messages = "";
        
        if (empty($name) || empty($unitID) || empty($price)){
            $messages = "Nama, unit id, harga wajib diisi.";
        }

        $createdBy = current_user('id') ?? 0;
        $success = App::product()->create($name, $unitID, $price, $createdBy);
        $messages = $success ? "Produk berhasil ditambahkan":"Gagal menambahkan produk";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function update() {
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $unitID = trim($_POST['unit_id'] ?? '');
        $price = trim($_POST['price'] ?? '');

        if ($id <= 0){
            $messages = "Data tidak valid";
        }

        if (empty($name) || empty($unitID) || empty($price)){
            $messages = "Nama, unit id, harga wajib diisi.";
        }

        $updatedBy = current_user('id') ?? 0;
        $success = App::product()->update($id, $name, $unitID, $price, $updatedBy);
        $messages = $success ? "Produk berhasil diperbarui":"Gagal memperbarui produk";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function destroy() {
        $id = (int) $_POST['id'] ?? 0;
        $currentId = (int) current_user('id');

        $success = App::product()->delete($id, $currentId);
        $messages = $success ? "Produk berhasil dihapus":"Gagal menghapus produk";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    private function baseRedirectTo(){
        redirect('?page=master-product');
    }
}