<?php

namespace Core;

class Config
{
    /**
     * Array de configuracoes
     * @var array
     */
    private static $settings = array();

    /**
     * Recupera o item atribuido na configuracao
     * Retorna-se NULL no caso da configuracao nao existir
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        if (isset(self::$settings[$key])) {
            return self::$settings[$key];
        }
        return null;
    }

    /**
     * Guarda no objeto Config o par chave e valor
     * @param string $key
     * @param $value
     */
    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}