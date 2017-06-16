<?php

namespace Admin\Models\Services;

use Admin\Models\Entities\Usuario;
use Core\AbstractService;

class UsuarioService extends AbstractService
{
    /**
     * @var string
     */
    private $table = 'usuario';

    /**
     * @param $usuario Usuario
     * @return Usuario
     */
    public function save($usuario)
    {
        $bindParams = array(
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'login' => $usuario->getLogin(),
            'senha' => $usuario->getSenha(),
            'avatar' => $usuario->getAvatar()
        );
        if ($usuario->isNew()) {
            $query = 'INSERT INTO ' . $this->table . '(nome, email, login, senha, avatar) VALUES (:nome, :email, :login, :senha, :avatar)';
        } else {
            $query = 'UPDATE ' . $this->table . 'SET nome=:nome, email=:email, login=:login, senha=:senha, avatar=:avatar WHERE id = :id';
            $bindParams['id'] = $usuario->getId();
        }

        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($bindParams);
        return $usuario->setId($this->getConnection()->lastInsertId());
    }

    /**
     * @param $usuario Usuario
     * @return bool|Usuario
     */
    public function autenticar($usuario)
    {
        $stmt = $this->getConnection()->prepare('SELECT * FROM ' . $this->table . ' WHERE login = :login AND senha = :senha LIMIT 1');
        $stmt->execute(array(
            'login' => $usuario->getLogin(),
            'senha' => $usuario->getSenha()
        ));

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(empty($result)) {
            return false;
        }
        $usuario = new Usuario();
        echo '<pre>';
        return $usuario->hydrate($result);
    }
}