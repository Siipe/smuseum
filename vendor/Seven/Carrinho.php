<?php

namespace Seven;

use Core\Session;

class Carrinho
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var Carrinho
     */
    private static $carrinho;
    
    private function __construct($session = null)
    {
        $this->session = $session;
        $this->criar();
    }

    /**
     * @param null $session
     * @return Carrinho
     * @throws \Exception
     */
    public static function getInstance($session = null)
    {
        if (!$session || !($session instanceof Session)) {
            throw new \Exception('Session Class inválida!');
        }
        if (!self::$carrinho) {
            self::$carrinho = new self($session);
        }
        return self::$carrinho;
    }

    /**
     * Busca o carrinho na Sessao
     * @return mixed|null
     */
    public function getCarrinho()
    {
        return $this->session->getAttribute('carrinho');
    }

    /**
     * @param $idx
     * @return mixed
     */
    public function getItem($idx)
    {
        if (isset($this->getCarrinho()[$idx])) {
            return $this->getCarrinho()[$idx];
        }
        return null;
    }

    /**
     * Remove item do carrinho
     * @param $idx
     * @throws \Exception
     */
    public function removerItem($idx)
    {
        $carrinho = $this->getCarrinho();
        if (!isset($carrinho[$idx])) {
            throw new \Exception('Item inexistente no carrinho!');
        }
        unset($carrinho[$idx]);
        $this->atualizar($carrinho);
    }

    /**
     * @param $idx
     * @param $values
     */
    public function atualizar($values, $idx = null)
    {
        if ($idx) {
            $carrinho = $this->getCarrinho();
            $carrinho[$idx] = $values;
        } else {
            $carrinho = $values;
        }
        $this->session->setAttribute('carrinho', $carrinho);
    }

    /**
     * Destroi o carrinho
     */
    public function destruir()
    {
        $this->session->unsetAttribute('carrinho');
    }

    /**
     * @return bool
     */
    private function isCriado()
    {
        return $this->session->exists('carrinho');
    }

    /**
     * Cria o carrinho se ele nao estiver criado
     */
    private function criar()
    {
        if (!$this->isCriado()) {
            $this->session->setAttribute('carrinho', array());
        }
    }
}