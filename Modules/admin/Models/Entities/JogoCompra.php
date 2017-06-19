<?php

namespace Admin\Models\Entities;

use Core\AbstractEntity;

class JogoCompra extends AbstractEntity
{
    /**
     * @var int
     */
    private $id_jogo;

    /**
     * @var int
     */
    private $id_compra;

    /**
     * @var float
     */
    private $preco_unitario;

    /**
     * @var int
     */
    private $quantidade;

    /**
     * @var Jogo
     */
    private $jogo;

    /**
     * @param int $decimals
     * @return string
     */
    public function getPrecoFormatado($decimals = 2)
    {
        return number_format($this->preco_unitario, $decimals, ',', '.');
    }

    /**
     * @return int
     */
    public function getIdJogo()
    {
        return $this->id_jogo;
    }

    /**
     * @param $id_jogo
     * @return $this
     */
    public function setIdJogo($id_jogo)
    {
        $this->id_jogo = $id_jogo;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdCompra()
    {
        return $this->id_compra;
    }

    /**
     * @param $id_compra
     * @return $this
     */
    public function setIdCompra($id_compra)
    {
        $this->id_compra = $id_compra;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrecounitario()
    {
        return $this->preco_unitario;
    }

    /**
     * @param $preco_unitario
     * @return $this
     */
    public function setPrecounitario($preco_unitario)
    {
        $this->preco_unitario = $preco_unitario;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param $quantidade
     * @return $this
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    /**
     * @return Jogo
     */
    public function getJogo()
    {
        return $this->jogo;
    }

    /**
     * @param Jogo $jogo
     * @return JogoCompra
     */
    public function setJogo($jogo)
    {
        $this->jogo = $jogo;
        return $this;
    }
}