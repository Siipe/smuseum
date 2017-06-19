<?php

namespace Application\Controllers;

use Admin\Models\Services\JogoService;
use Application\Enum\MessageSkin;
use Core\Controller;

class JogoBaseController extends Controller
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

    /**
     * @return JogoService
     */
    protected function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}