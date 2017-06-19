<?php

namespace Admin\Models\Entities;

use Core\AbstractEntity;

class Compra extends AbstractEntity
{
    /**
     * @var \DateTime
     */
    private $data_inclusao;

    /**
     * @var int
     */
    private $id_usuario;

    /**
     * @var JogoCompra[]
     */
    private $itens;

    /**
     * @return string
     */
    public function getDataInclusaoFormatada()
    {
        return $this->data_inclusao->format('l\, d/m/Y');
    }

    /**
     * @return float|int
     */
    public function calcularTotal($formatado)
    {
        $total = 0;
        foreach ($this->itens as $item) {
            for ($i=0; $i<$item->getQuantidade(); $i++) {
                $total += $item->getPrecounitario();
            }
        }
        return $formatado ? number_format($total, 2, ',', '.') : $total;
    }

    /**
     * @return \DateTime
     */
    public function getDataInclusao()
    {
        return $this->data_inclusao;
    }

    /**
     * @param \DateTime $data_inclusao
     * @return Compra
     */
    public function setDataInclusao($data_inclusao)
    {
        if (!($data_inclusao instanceof \DateTime)) {
            $data_inclusao = \DateTime::createFromFormat('Y-m-d H:i:s', $data_inclusao);
        }
        $this->data_inclusao = $data_inclusao;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     * @return Compra
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return JogoCompra[]
     */
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * @param JogoCompra[]|JogoCompra $itens
     */
    public function setItens($itens)
    {
        if (is_array($itens)) {
            $this->itens = $itens;
        } else {
            $this->itens[] = $itens;
        }
    }
}