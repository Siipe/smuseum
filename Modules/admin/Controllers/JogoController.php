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
                $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            }
        }
    }

    /**
     * @return JogoService
     */
    private function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}