<?php

namespace Admin\Controllers;

use Admin\Models\Entities\Compra;
use Admin\Models\Entities\JogoCompra;
use Admin\Models\Services\CompraService;
use Application\Enum\MessageSkin;
use Core\Controller;
use Seven\Carrinho;

class CompraController extends Controller
{
    public function index()
    {
        try {
            $this->set('compras', $this->getCompraService()->listar());
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect();
        }
    }

    public function visualizar($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }
            $this->set('compra', $this->getCompraService()->buscar((int) $id, true));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect(array('module' => 'admin', 'controller' => 'compra'));
        }
    }

    /**
     * Finaliza a compra
     */
    public function finalizar()
    {
        $cService = $this->getCompraService();
        $cService->beginTransaction();
        try {
            $carrinho = Carrinho::getInstance($this->getSession());
            $compra = new Compra();
            foreach ($carrinho->getCarrinho() as $key => $value) {
                $jogoCompra = new JogoCompra();
                $jogoCompra->setIdJogo($key);
                $jogoCompra->setIdCompra($compra->getId());
                $jogoCompra->setPrecounitario((int) $value['preco']);
                $jogoCompra->setQuantidade($value['quantidade']);

                $compra->setItens($jogoCompra);
            }
            $cService->salvar($compra);
            $cService->commit();

            $carrinho->destruir();

            $this->setMessage(sprintf('Compra efetuada com sucesso! (%s, totalizando R$ %s)', count($compra->getItens()) > 1 ? count($compra->getItens()) . ' itens' : '1 item', $compra->calcularTotal(true)), MessageSkin::SUCCESS);
            $this->redirect(array('module' => 'admin', 'controller' => 'compra', 'action' => 'visualizar', 'id' => $compra->getId()));
        } catch (\Exception $e) {
            $cService->rollback();
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect(array('module' => 'admin', 'controller' => 'carrinho'));
        }
    }

    /**
     * @return CompraService
     */
    private function getCompraService()
    {
        return $this->getService(CompraService::class);
    }
}