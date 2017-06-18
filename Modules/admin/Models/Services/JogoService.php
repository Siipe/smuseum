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
            'imagem' => $jogo->getImagem()
        );
        if ($jogo->isNew()) {
            $query = 'INSERT INTO ' . $this->table . '(nome, plataforma, descricao, preco, id_usuario_inclusao, imagem) VALUES (:nome, :plataforma, :descricao, :preco, :id_usuario_inclusao, :imagem)';
            $bindParams['id_usuario_inclusao'] = $jogo->getIdUsuarioInclusao();
        } else {
            $query = 'UPDATE ' . $this->table . ' SET nome=:nome, plataforma=:plataforma, descricao=:descricao, preco=:preco, imagem=:imagem WHERE id = :id';
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
        $query = 'SELECT id, nome, preco, plataforma, imagem, id_usuario_inclusao FROM ' . $this->table;
        $bindParams = null;
        if ($like) {
            $query .= ' WHERE nome LIKE ?';
            $bindParams = array("%$like%");
        }
        $query .= ' ORDER BY id DESC';
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

    /**
     * @param null $id
     * @param null $buscarUsuario
     * @return Jogo|null
     * @throws \Exception
     */
    public function buscar($id = null, $buscarUsuario = null)
    {
        if (!$id) {
            throw new \Exception('JOGO: Id inválido!');
        }

        $query = 'SELECT id, nome, descricao, preco, plataforma, data_inclusao, id_usuario_inclusao, imagem FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(array('id' => $id));

        if ($result = $stmt->fetch()) {
            $jogo = new Jogo();
            $jogo->hydrate($result);
            $uService = new UsuarioService($this->getUserSession());
            if ($buscarUsuario) {
                $jogo->setUsuario($uService->buscar($jogo->getIdUsuarioInclusao()));
            }
            return $jogo;
        }
        throw new \Exception('Jogo inexistente!');
    }

    /**
     * @param null $id
     * @throws \Exception
     */
    public function delete($id = null)
    {
        if (!$id) {
            throw new \Exception('JOGO: Id inválido!');
        }

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(array('id' => $id));
    }

    /**
     * @param $jogo Jogo
     * @return bool
     */
    public function possuiPermissoes($jogo)
    {
        return $jogo->getIdUsuarioInclusao() == $this->getUserSession()['id'];
    }
}