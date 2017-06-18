<?php

namespace Admin\Controllers;

use Admin\Models\Entities\Jogo;
use Admin\Models\Services\JogoService;
use Application\Enum\MessageSkin;
use Core\Controller;
use Seven\Utils;

class JogoController extends Controller
{
    public function index()
    {
        try {
            $this->set('jogos', $this->getJogoService()->listar($this->getRequest()->getGet('pesquisa')));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect();
        }
    }

    public function inserir()
    {
        $request = $this->getRequest();
        if ($request->is('post')) {
            $jogo = new Jogo();
            $jService = $this->getJogoService();
            $jService->beginTransaction();
            try {
                $jogo->hydrate($request->getPost());

                $file = $request->getPost('cropped');
                if ($file) {
                    $fileDestination = ROOT . DS . 'public' . DS . 'img' . DS . 'jogos' . DS;
                    if (!$fileName = Utils::decodeAndMoveBase64File($file, $fileDestination)) {
                        throw new \Exception('Ocorreu um erro no envio do arquivo!');
                    }
                    $jogo->setImagem($fileName);
                }

                $jogo->setIdUsuarioInclusao((int) $this->getUserSession()['id']);

                $jService->salvar($jogo);
                $jService->commit();

                $this->setMessage(sprintf('Jogo [%s] cadastrado com sucesso!', $jogo->getNome()), MessageSkin::SUCCESS);
                $this->redirect(array('module' => 'admin', 'controller' => 'jogo'));
            } catch(\Exception $e) {
                $jService->rollback();
                $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            }
        }
    }

    public function visualizar($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }
            $this->set('jogo', $this->getJogoService()->buscar((int) $id, true));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect(array('module' => 'admin', 'controller' => 'jogo'));
        }
    }

    public function editar($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }

            $request = $this->getRequest();
            $jService = $this->getJogoService();
            $jogo = $jService->buscar((int) $id);

            if (!$jService->possuiPermissoes($jogo)) {
                throw new \Exception(sprintf('Você não possui permissões sobre o jogo [%s].', $jogo->getNome()));
            }

            if ($request->is('post')) {
                $jService->beginTransaction();
                try {
                    $jogo->hydrate($request->getPost());

                    $file = $request->getPost('cropped');
                    if ($file) {
                        $fileDestination = ROOT . DS . 'public' . DS . 'img' . DS . 'jogos' . DS;
                        if (!$fileName = Utils::decodeAndMoveBase64File($file, $fileDestination)) {
                            throw new \Exception('Ocorreu um erro no envio do arquivo!');
                        }
                        unlink(ROOT . DS . 'public' . DS . 'img' . DS . 'jogos' . DS . $jogo->getImagem());
                        $jogo->setImagem($fileName);
                    }

                    $jService->salvar($jogo);
                    $jService->commit();

                    $this->setMessage(sprintf('Jogo [%s] alterado com sucesso!', $jogo->getNome()), MessageSkin::SUCCESS);
                    $this->redirect(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'editar', 'id' => $id));
                } catch (\Exception $e) {
                    $jService->rollback();
                    $this->setMessage($e->getMessage(), MessageSkin::DANGER);
                }
            }
            $this->set('jogo', $jogo);
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect(array('module' => 'admin', 'controller' => 'jogo'));
        }
    }

    public function excluir($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }

            $jService = $this->getJogoService();
            $jogo = $jService->buscar((int) $id);

            if (!$jService->possuiPermissoes($jogo)) {
                throw new \Exception(sprintf('Você não possui permissões sobre o jogo [%s].', $jogo->getNome()));
            }

            $jService->beginTransaction();
            try {
                $jService->delete($jogo->getId());
                $jService->commit();

                $this->setMessage(sprintf('Jogo [%s] excluído com sucesso!', $jogo->getNome()), MessageSkin::SUCCESS);
            } catch (\Exception $e) {
                $jService->rollback();
                $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            }
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
        }

        $this->redirect(array('module' => 'admin', 'controller' => 'jogo'));
    }

    /**
     * @return JogoService
     */
    private function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}