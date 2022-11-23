<?php

namespace App\Framework;

use App\Framework\Exceptions\EntityNotFoundException;
use PDO;

class Manager
{
    protected PDO $_connection;

    public function __construct(
        private readonly string $_table_name,
        private readonly mixed  $_object,
    ) {
        $this->_connection = Database::getInstance()->getConnection();
    }

    public function getById($id)
    {
        $req = $this->_connection->prepare('SELECT * FROM ' . $this->_table_name . ' WHERE id = :id');
        $req->bindParam(':id', $id);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return null;
        }

        return new $this->_object($data);
    }

    public function getAll(): array
    {
        $req = $this->_connection->prepare('SELECT * FROM ' . $this->_table_name);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($data as $object) {
            $objects[] = new $this->_object($object);
        }
        return $objects;
    }

    public function getBy(string $key, mixed $value): array
    {
        $req = $this->_connection->prepare('SELECT * FROM ' . $this->_table_name . ' WHERE ' . $key . ' = :value');
        $req->bindParam(':value', $value);
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($data as $object) {
            $objects[] = new $this->_object($object);
        }
        return $objects;
    }

    public function create($object): mixed
    {
        $req = $this->_connection->prepare('INSERT INTO ' . $this->_table_name . ' (' . implode(', ', array_keys($object)) . ') VALUES (:' . implode(', :', array_keys($object)) . ')');
        foreach ($object as $key => &$value) {
            $req->bindParam(":$key", $value);
        }
        $req->execute();
        return $this->getById($this->_connection->lastInsertId());
    }

    public function update($id, $object): mixed
    {
        $sql = 'UPDATE ' . $this->_table_name . ' SET ';
        foreach ($object as $key => $value) {
            $sql .= $key . ' = :' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql .= ' WHERE id = :id';
        
        $req = $this->_connection->prepare($sql);
        $req->bindParam(':id', $id);
        foreach ($object as $key => &$value) {
            $req->bindParam(":$key", $value);
        }
        $req->execute();
        return $this->getById($id);
    }

    public function delete($id): void
    {
        $req = $this->_connection->prepare('DELETE FROM ' . $this->_table_name . ' WHERE id = :id');
        $req->bindParam(':id', $id);
        $req->execute();
    }
}
