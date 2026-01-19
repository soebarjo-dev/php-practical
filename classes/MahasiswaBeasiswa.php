<?php

require_once __DIR__ . "/Mahasiswa.php";

class MahasiswaBeasiswa extends Mahasiswa
{
    private string $jenisBeasiswa;
    public function __construct(string $jenisBeasiswa, string $nama, string $alamat, int $umur, string $jenisKelamin, string $kelas, int $nilai){
        parent::__construct($nilai, $kelas, $nama, $alamat, $umur, $jenisKelamin);
        $this->jenisBeasiswa = $jenisBeasiswa;
    }

    // GETTER
    public function getJenisBeasiswa(): string {
        return $this->jenisBeasiswa;
    }

    public function getStatus(): string {
        return $this->nilai >= 90 ? "LULUS & MENDAPATKAN BEASISWA {$this->jenisBeasiswa}" : "TIDAK LULUS (BEASISWA)";
    }
}