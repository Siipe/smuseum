<?php

namespace Admin\Controllers;

use Admin\Models\Services\CompraService;
use Admin\Models\Services\JogoService;
use Application\Enum\MessageSkin;
use Core\Controller;

class InicioController extends Controller
{
    public function index()
    {
        try {
            $this->set(array(
                'compra' => $this->getCompraService()->getUltima(),
                'jogo' => $this->getJogoService()->getUltimo()
            ));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
        }
    }

    /**
     * @return CompraService
     */
    private function getCompraService()
    {
        return $this->getService(CompraService::class);
    }

    /**
     * @return JogoService
     */
    private function getJogoService()
    {
        return $this->getService(JogoService::class);
    }
}