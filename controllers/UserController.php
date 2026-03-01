<?php

class UserController
{
    public function index(){
        return App::user()->getAll();
    }

    public function store() {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $messages = "";

        if (empty($name) || empty($email) || empty($password)){
            $messages = "Name, email, dan password wajib diisi.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $messages = "Format email tidak sesuai.";
        }

        $createdBy = current_user('id') ?? 0;
        $success = App::user()->create($name, $email, $password, $createdBy);
        $messages = $success ? "Pengguna berhasil ditambahkan":"Gagal menambahkan pengguna";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        redirect('?page=master-user');
    }

    public function update() {
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($id <= 0){
            $messages = "Data tidak valid";
        }

        if (empty($name) || empty($email)){
            $messages = "Name, email, dan password wajib diisi.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $messages = "Format email tidak sesuai.";
        }

        $updatedBy = current_user('id') ?? 0;
        $success = App::user()->update($id, $name, $email, $updatedBy);
        $messages = $success ? "Pengguna berhasil diperbarui":"Gagal memperbarui pengguna";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        redirect('?page=master-user');
    }

    public function destroy() {}
}