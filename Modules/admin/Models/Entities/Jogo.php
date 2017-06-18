<?php

namespace Admin\Models\Entities;

use Core\AbstractEntity;

class Jogo extends AbstractEntity
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $plataforma;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var float
     */
    private $preco;

    /**
     * @var \DateTime
     */
    private $data_inclusao;

    /**
     * @var int
     */
    private $id_usuario_inclusao;

    /**
     * @var string
     */
    private $imagem;

    /** @var  Usuario */
    private $usuario;

    /**
     * @param int $decimals
     * @return string
     */
    public function getPrecoFormatado($decimals = 2)
    {
        return number_format($this->preco, $decimals, ',', '.');
    }

    /**
     * @return string
     */
    public function getCaminhoImagem()
    {
        return 'jogos' . DS . $this->imagem;
    }

    /**
     * @return string
     */
    public function getDataInclusaoFormatada()
    {
        return $this->data_inclusao->format('l\, d/m/Y');
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Jogo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlataforma()
    {
        return $this->plataforma;
    }

    /**
     * @param string $plataforma
     * @return Jogo
     */
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return Jogo
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     * @return Jogo
     */
    public function setPreco($preco)
    {
        $this->preco = (float) $preco;
        return $this;
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
     * @return Jogo
     */
    public function setDataInclusao($data_inclusao)
    {
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $data_inclusao);
        $this->data_inclusao = $datetime;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdUsuarioInclusao()
    {
        return $this->id_usuario_inclusao;
    }

    /**
     * @param int $id_usuario_inclusao
     * @return Jogo
     */
    public function setIdUsuarioInclusao($id_usuario_inclusao)
    {
        $this->id_usuario_inclusao = (int) $id_usuario_inclusao;
        return $this;
    }

    /**
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param string $imagem
     * @return Jogo
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
}