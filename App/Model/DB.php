<?php

namespace App\Model;
use PDO;

class DB
{
    /**
     * @var PDO
     */
    public PDO $pdo;

    /**
     * @var string
     */
    public string $dbName;

    /**
     * DB constructor.
     * @param string $db
     * @param null $username
     * @param null $password
     * @param string $host
     * @param int $port
     * @param array $options
     */
    public function __construct(string $db, $username = NULL, $password = NULL, string $host = '127.0.0.1', int $port = 3306, array $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $username, $password, $options);
            $this->dbName = $db;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param $sql
     * @param null $args
     * @return false|\PDOStatement
     */
    public function run($sql, $args = NULL)
    {
        if (!$args)
        {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}