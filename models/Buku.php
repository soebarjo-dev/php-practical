<?php

class Buku
{
    private $connection;
    private $table = "buku";

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function all()
    {
        $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE tanggal_hapus IS NULL");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($params)
    {
        $statement = $this->connection->prepare("
            INSERT INTO {$this->table} (judul, penulis, tahun_terbit, jenis_buku, status_buku)
            VALUES(?, ?, ?, ?, ?)
        ");

        return $statement->execute($params);
    }

    public function update($id, $params)
    {
        $statement = $this->connection->prepare("
            UPDATE {$this->table}
            SET judul = ?, penulis = ?, tahun_terbit = ?, jenis_buku = ?, status_buku = ?
            WHERE id = ${id}
        ");

        return $statement->execute($params);
    }

    public function delete($id)
    {
        $statement = $this->connection->prepare("
            DELETE FROM {$this->table}
            WHERE id = ${id}
        ");

        return $statement->execute($params);
    }

    public function softDelete($id)
    {
        $statement = $this->connection->prepare("
            UPDATE {$this->table}
            SET tanggal_hapus = now()
            WHERE id = ${id}
        ");

        return $statement->execute($params);
    }
}