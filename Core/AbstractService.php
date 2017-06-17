<?php

namespace Core;

abstract class AbstractService
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var array|null
     */
    private $userSession;

    public function __construct($idUser = null)
    {
        $this->connection = Connection::getInstance();
        $this->userSession = $idUser;
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

    /**
     * @return null|array
     */
    public function getUserSession()
    {
        return $this->userSession;
    }
}