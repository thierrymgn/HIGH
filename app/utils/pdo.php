<?php
function createPDO(): PDO
{
    $dsn = 'mysql:host=db; port=3306; dbname=data';
    $username = 'root';
    $password = 'password';
    try {
        return new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

$pdo = createPDO();
