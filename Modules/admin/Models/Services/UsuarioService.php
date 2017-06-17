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
    public function salvar($usuario)
    {
        $bindParams = array(
            'nome' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'login' => $usuario->getLogin(),
            'senha' => $usuario->getSenha()
        );
        if ($usuario->isNew()) {
            $usuario->setDataInclusao(new \DateTime());
            $query = 'INSERT INTO ' . $this->table . '(nome, email, login, senha, data_inclusao) VALUES (:nome, :email, :login, :senha, :data_inclusao)';
            $bindParams['data_inclusao'] = $usuario->getDataInclusao()->format('Y-m-d H:i');
        } else {
            $query = 'UPDATE ' . $this->table . 'SET nome=:nome, email=:email, login=:login, senha=:senha WHERE id = :id';
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
        return $usuario->hydrate($result);
    }
}