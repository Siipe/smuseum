<?php

namespace Admin\Controllers;

use Admin\Models\Services\JogoService;
use Application\Enum\MessageSkin;
use Core\Controller;

class CarrinhoController extends Controller
{
    public function index()
    {
        $this->set('itens', $this->getCarrinho());
    }

    public function adicionar()
    {
        $request = $this->getRequest();
        if ($request->is('ajax')) {
            try {
                $id = $request->getPost('id');
                $quantidade = $request->getPost('quantidade');

                $jogo = $this->getJogoService()->buscar($id);
                $this->criarCarrinho();
                $carrinho = $this->getCarrinho();
                $carrinho[$jogo->getId()] = array('nome' => $jogo->getNome(), 'preco' => $jogo->getPreco(), 'quantidade' => $quantidade);
                $this->atualizarCarrinho($carrinho);

                echo json_encode(array(
                    'failure' => false,
                    'message' => sprintf('Jogo <strong>%s</strong> adicionado ao carrinho com sucesso!<br/>Preço unitário: R$ %s <br />Quantidade: %s', $jogo->getNome(), $jogo->getPrecoFormatado(), $quantidade)
                ));
            } catch (\Exception $e) {
                echo json_encode(array(
                    'failure' => true,
                    'message' => $e->getMessage()
                ));
            }
            exit;
        } else {
            $this->setMessage('Requisição inválida!', MessageSkin::WARNING);
            $this->redirect();
        }
    }

    /**
     * Funcao de remover item do carrinho
     */
    public function remover($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }
            $carrinho = $this->getCarrinho();
            $item = $carrinho[$id]['nome'];
            unset($carrinho[$id]);
            $this->atualizarCarrinho($carrinho);
            $this->setMessage(sprintf('Item <strong>%s</strong> removido com sucesso!', $item), MessageSkin::SUCCESS);
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
        }
        $this->redirect(array('module' => 'admin', 'controller' => 'carrinho'));
    }

    public function finalizar()
    {
        try {
            $carrinho = $this->getCarrinho();
            $total = 0;

            foreach ($carrinho as $key => $value) {
                for ($i=0; $i<$value['quantidade']; $i++) {
                    $total += (int) $value['preco'];
                }
            }

            var_dump($total);
            exit;
        } catch (\Exception $e) {

        }
    }

    /**
     * @return bool
     */
    private function isCarrinhoCriado()
    {
        return $this->getSession()->exists('carrinho');
    }

    /**
     * Cria o carrinho se ele nao estiver criado
     */
    private function criarCarrinho()
    {
        if (!$this->isCarrinhoCriado()) {
            $this->getSession()->setAttribute('carrinho', array());
        }
    }

    /**
     * Busca o carrinho na Sessao
     * @return mixed|null
     */
    private function getCarrinho()
    {
        return $this->getSession()->getAttribute('carrinho');
    }

    /**
     * Atualiza o carrinho na Sessao
     * @param $carrinho
     */
    private function atualizarCarrinho($carrinho)
    {
        $this->getSession()->setAttribute('carrinho', $carrinho);
    }

    /**
     * @return JogoService
     */
    private function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}