<?php

namespace Admin\Models\Entities;

use Core\AbstractEntity;

class Usuario extends AbstractEntity
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $senha;

    /**
     * @var \DateTime
     */
    private $data_inclusao;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return Usuario
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = md5($senha);
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
     * @return Usuario
     */
    public function setDataInclusao($data_inclusao)
    {
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $data_inclusao);
        $this->data_inclusao = $datetime;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return Usuario
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}