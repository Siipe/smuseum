<?php

namespace Application\Controllers;

use Application\Enum\MessageSkin;

class JogoController extends JogoBaseController
{
    public function visualizar($id = null)
    {
        try {
            if (!$id || !((int) $id)) {
                throw new \Exception('Id inválido!');
            }
            $this->set('jogo', $this->getJogoService()->buscar((int) $id));
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect(array('controller' => 'jogo'));
        }
    }
}