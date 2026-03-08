<?php

class UnitController
{
    public function index(){
        return App::unit()->getAll();
    }

    public function store() {
        $name = trim($_POST['name'] ?? '');
        $symbol = trim($_POST['symbol'] ?? '');
        $messages = "";

        if (empty($name) || empty($symbol)){
            $messages = "Name, symbol wajib diisi.";
        }

        $createdBy = current_user('id') ?? 0;
        $success = App::unit()->create($name, $symbol, $createdBy);
        $messages = $success ? "Unit berhasil ditambahkan":"Gagal menambahkan unit";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function update() {
        $id = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $symbol = trim($_POST['symbol'] ?? '');

        if ($id <= 0){
            $messages = "Data tidak valid";
        }

        if (empty($name) || empty($symbol)){
            $messages = "Name, symbol wajib diisi.";
        }

        $updatedBy = current_user('id') ?? 0;
        $success = App::unit()->update($id, $name, $symbol);
        $messages = $success ? "Pengguna berhasil diperbarui":"Gagal memperbarui pengguna";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    public function destroy() {
        $id = (int) $_POST['id'] ?? 0;

        $success = App::unit()->delete($id);
        $messages = $success ? "Unit berhasil dihapus":"Gagal menghapus unit";

        $_SESSION[$success ? 'flash_success':'flash_error'] = $messages;

        $this->baseRedirectTo();
    }

    private function baseRedirectTo(){
        redirect('?page=master-unit');
    }
}