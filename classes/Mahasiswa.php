<?php

require_once __DIR__ . "/Manusia.php";

class Mahasiswa extends Manusia
{
    protected int $nilai;
    protected string $kelas;

    public function __construct(int $nilai, string $kelas, string $nama, string $alamat, int $umur, string $jenisKelamin){
        parent::__construct($nama, $alamat, $umur, $jenisKelamin);
        $this->nilai = $nilai;
        $this->kelas = $kelas;
    }

    // GETTER 
    public function getNilai(): int {
        return $this->nilai;
    }

    public function getKelas(): string {
        return $this->kelas;
    }

    // SETTER
    public function setNilai(int $nilai){
        if ($nilai >= 0 || $nilai <= 100){
            $this->nilai = $nilai;
        }
    }

    public function getStatus(): string {
        return $this->nilai >= 75 ? "LULUS" : "TIDAK LULUS";
    }
}