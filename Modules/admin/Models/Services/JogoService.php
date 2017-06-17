<?php

namespace Admin\Models\Services;

use Admin\Models\Entities\Jogo;
use Core\AbstractService;

class JogoService extends AbstractService
{
    /**
     * @var string
     */
    private $table = 'jogo';

    /**
     * @param $jogo Jogo
     * @return Jogo
     */
    public function salvar($jogo)
    {
        $bindParams = array(
            'nome' => $jogo->getNome(),
            'plataforma' => $jogo->getPlataforma(),
            'descricao' => $jogo->getDescricao(),
            'preco' => $jogo->getPreco(),
            'id_usuario_inclusao' => $jogo->getIdUsuarioInclusao(),
            'imagem' => $jogo->getImagem()
        );
        if ($jogo->isNew()) {
            $query = 'INSERT INTO ' . $this->table . '(nome, plataforma, descricao, preco, id_usuario_inclusao, imagem) VALUES (:nome, :plataforma, :descricao, :preco, :id_usuario_inclusao, :imagem)';
        } else {
            $query = 'UPDATE ' . $this->table . 'SET nome=:nome, plataforma=:plataforma, descricao=:descricao, preco=:preco, imagem=:imagem WHERE id = :id';
            $bindParams['id'] = $jogo->getId();
        }

        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($bindParams);
        return $jogo->setId($this->getConnection()->lastInsertId());
    }

    /**
     * @param null $like
     * @return Jogo[]
     */
    public function listar($like = null)
    {
        $query = 'SELECT nome, preco, plataforma, imagem FROM ' . $this->table;
        $bindParams = null;
        if ($like) {
            $query .= ' WHERE nome LIKE ?';
            $bindParams = array("%$like%");
        }
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($bindParams);
        $result = $stmt->fetchAll();
        $listJogo = array();

        foreach ($result as $item) {
            $jogo = new Jogo();
            $jogo->hydrate($item);
            $listJogo[] = $jogo;
        }
        return $listJogo;
    }
}