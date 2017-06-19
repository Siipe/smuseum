<?php

namespace Admin\Controllers;

use Admin\Models\Services\JogoService;
use Application\Enum\MessageSkin;
use Core\Controller;
use Seven\Carrinho;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = Carrinho::getInstance($this->getSession());
        $this->set('itens', $carrinho->getCarrinho());
    }

    public function adicionar()
    {
        $request = $this->getRequest();
        if ($request->is('ajax')) {
            try {
                $id = $request->getPost('id');
                $quantidade = $request->getPost('quantidade');

                $jogo = $this->getJogoService()->buscar($id);

                $carrinho = Carrinho::getInstance($this->getSession());
                $carrinho->atualizar(array('nome' => $jogo->getNome(), 'preco' => $jogo->getPreco(), 'quantidade' => $quantidade), $jogo->getId());

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
     * @param null $id
     */
    public function remover($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }
            $carrinho = Carrinho::getInstance($this->getSession());
            $item = $carrinho->getItem($id)['nome'];

            $carrinho->removerItem($id);

            $this->setMessage(sprintf('Item <strong>%s</strong> removido com sucesso!', $item), MessageSkin::SUCCESS);
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
        }
        $this->redirect(array('module' => 'admin', 'controller' => 'carrinho'));
    }

    /**
     * @return JogoService
     */
    private function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}