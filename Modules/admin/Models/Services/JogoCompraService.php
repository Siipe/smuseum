<?php

namespace Admin\Models\Services;

use Admin\Models\Entities\JogoCompra;
use Core\AbstractService;

class JogoCompraService extends AbstractService
{
    private $table = 'jogo_compra';

    /**
     * @param $jogoCompra JogoCompra
     * @return JogoCompra
     */
    public function salvar($jogoCompra)
    {
        $bindParams = array(
            'id_jogo' => $jogoCompra->getIdJogo(),
            'id_compra' => $jogoCompra->getIdCompra(),
            'preco_unitario' => $jogoCompra->getPrecounitario(),
            'quantidade' => $jogoCompra->getQuantidade()
        );

        $query = 'INSERT INTO ' . $this->table . '(id_jogo, id_compra, preco_unitario, quantidade) VALUES (:id_jogo, :id_compra, :preco_unitario, :quantidade)';

        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute($bindParams);
        return $jogoCompra->setId($this->getConnection()->lastInsertId());
    }

    /**
     * @param null $idCompra
     * @return JogoCompra[]
     * @throws \Exception
     */
    public function buscarPorCompra($idCompra = null)
    {
        if (!$idCompra) {
            throw new \Exception('JOGO_COMPRA: Id_compra inválido!');
        }

        $query = 'SELECT id, id_jogo, preco_unitario, quantidade FROM ' . $this->table . ' WHERE id_compra = :id_compra';
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute(array('id_compra' => $idCompra));
        $result = $stmt->fetchAll();
        $listJogoCompra = array();

        foreach ($result as $item) {
            $jogoCompra = new JogoCompra();
            $jogoCompra->hydrate($item);
            $jService = new JogoService($this->getUserSession());
            $listJogoCompra[] = $jogoCompra->setJogo($jService->buscar($jogoCompra->getIdJogo(), false, true));
        }

        return $listJogoCompra;
    }
}