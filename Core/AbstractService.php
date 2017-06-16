<?php

namespace Core;

abstract class AbstractService
{
    /**
     * @var \PDO
     */
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollback()
    {
        $this->connection->rollBack();
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}