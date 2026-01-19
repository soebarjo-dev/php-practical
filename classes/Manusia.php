<?php

abstract class Manusia 
{
    protected string $nama;
    protected string $alamat;
    protected int $umur;
    protected string $jenisKelamin;

    public function __construct(string $nama, string $alamat, int $umur, string $jenisKelamin)
    {
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->umur = $umur;
        $this->jenisKelamin = $jenisKelamin;
    }

    // GETTER
    public function getNama(): string {
        return $this->nama;
    }

    public function getAlamat(): string {
        return $this->alamat;
    }

    public function getUmur(): int {
        return $this->umur;
    }

    public function getJenisKelamin(): string {
        return $this->jenisKelamin;
    }

    // SETTER
    public function setAlamat(string $alamat){
        $this->alamat = $alamat;
    }

    public function setUmur(int $umur){
        if ($umur > 0){
            $this->umur = $umur;
        }
    }

    // Polymorphism
    abstract public function getStatus(): string;
}