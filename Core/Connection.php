<?php

namespace Core;

use PDO;

class Connection
{
    private function __construct() {}

    /**
     * @var PDO
     */
    private static $connection;

    /**
     * Abre uma conexao com o Banco de Dados
     * Padrao Singleton
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (!self::$connection) {
            $config = Config::get('db');

            if (empty($config)) {
                throw new \Exception('CONNECTION: No DB config available');
            }
            self::$connection = new PDO($config['dsn'], $config['user'], $config['password']);
        }
        return self::$connection;
    }
}