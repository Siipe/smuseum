<?php

namespace Core;

class Connection
{
    private function __construct() {}

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

            //TODO - Conexao com banco
        }
        return self::$connection;
    }
}