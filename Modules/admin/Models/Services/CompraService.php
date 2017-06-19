<?php

namespace Admin\Models\Services;

use Admin\Models\Entities\Compra;
use Core\AbstractService;

class CompraService extends AbstractService
{
    private $table = 'compra';

    /**
     * @param $compra Compra
     * @return Compra
     */
    public function salvar($compra)
    {
        $compra->setIdUsuario($this->getUserSession()['id']);
        $bindParams = array(
            'id_usuario' => $compra->getIdUsuario(),
        );

        $query = 'INSERT INTO ' . $this->table . '(id_usuario) VALUES (:id_usuario)';

        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($bindParams);
        $compra->setId($this->getConnection()->lastInsertId());

        $this->salvarItens($compra);
        return $compra;
    }

    public function buscar($id = null, $buscarItens = false)
    {
        if (!$id) {
            throw new \Exception('COMPRA: Id inválido!');
        }

        $query = 'SELECT id, data_inclusao FROM ' . $this->table . ' WHERE id = :id AND id_usuario = :id_usuario';
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(array(
            'id' => $id,
            'id_usuario' => $this->getUserSession()['id'])
        );

        if ($result = $stmt->fetch()) {
            $compra = new Compra();
            $compra->hydrate($result);
            $jcService = new JogoCompraService($this->getUserSession());
            if ($buscarItens) {
                $compra->setItens($jcService->buscarPorCompra($compra->getId()));
            }
            return $compra;
        }
        throw new \Exception('compra inexistente!');
    }

    /**
     * @param null $idUsuario
     * @return Compra[]
     * @throws \Exception
     */
    public function listar($idUsuario = null)
    {
        if (!$idUsuario) {
            throw new \Exception('COMPRA: Id inválido!');
        }

        $query = 'SELECT id, data_inclusao FROM ' . $this->table . ' WHERE id_usuario = :id_usuario';
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(array('id_usuario' => $idUsuario));
        $result = $stmt->fetchAll();
        $listCompra = array();

        foreach ($result as $item) {
            $compra = new Compra();
            $compra->hydrate($item);
            $listCompra[] = $compra;
        }
        return $listCompra;
    }

    /**
     * @param $compra Compra
     */
    private function salvarItens($compra)
    {
        $jcService = new JogoCompraService($this->getUserSession());
        foreach ($compra->getItens() as $item) {
            $item->setIdCompra($compra->getId());
            $jcService->salvar($item);
        }
    }
}