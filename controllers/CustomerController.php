<?php

class CustomerController
{
    public function index(){
        return App::customer()->getAll();
    }

    public function store() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $messages = "";

        if (empty($name) || empty($email)){
            $messages = "Name, email wajib diisi.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $messages = "Format email tidak sesuai.";
        }

        $createdBy = current_user('id') ?? 0;
        $success = App::customer()->create($name, $email, $createdBy);
        $messages = $success ? "Pelanggan berhasil ditambahkan":"Gagal menambahkan pelanggan";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function update() {
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($id <= 0){
            $messages = "Data tidak valid";
        }

        if (empty($name) || empty($email)){
            $messages = "Name, email wajib diisi.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $messages = "Format email tidak sesuai.";
        }

        $updatedBy = current_user('id') ?? 0;
        $success = App::customer()->update($id, $name, $email, $updatedBy);
        $messages = $success ? "Pelanggan berhasil diperbarui":"Gagal memperbarui pelanggan";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function destroy() {
        $id = (int) $_POST['id'] ?? 0;
        $currentId = (int) current_user('id');

        $success = App::customer()->delete($id, $currentId);
        $messages = $success ? "Pelanggan berhasil dihapus":"Gagal menghapus pelanggan";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    private function baseRedirectTo(){
        redirect('?page=master-customer');
    }
}