<?php

namespace Admin\Controllers;

use Admin\Models\Entities\Usuario;
use Admin\Models\Services\UsuarioService;
use Application\Enum\MessageSkin;
use Core\Config;
use Core\Controller;
use Core\Exceptions\ResourceNotFoundException;

class UsuarioController extends Controller
{
    /**
     * Cadastra um novo Usuario
     * @throws ResourceNotFoundException
     */
    public function cadastrar()
    {
        $request = $this->getRequest();
        if ($request->is('post')) {
            $usuario = new Usuario();
            $uService = $this->getUsuarioService();
            $uService->beginTransaction();
            try {
                $uService->save($usuario->hydrate($request->getPost()));
                $uService->commit();

                $sessionArray = array(
                    'id' => $usuario->getId(),
                    'name' => $usuario->getNome()
                );
                $this->getSession()->setAttribute(Config::get('login-role'), $sessionArray);

                $this->setMessage(sprintf('Seja bem-vindo, %s! Aproveite!', $usuario->getNome()), MessageSkin::SUCCESS);
                $this->redirect(array('module' => 'admin'));

            } catch(\Exception $e) {
                $this->setMessage($e->getMessage(), MessageSkin::DANGER);
                $this->redirect();
            }
        }
        throw new ResourceNotFoundException('Requisição inválida!');
    }

    public function login()
    {
        $request = $this->getRequest();
        if ($request->is('post')) {
            $usuario = new Usuario();
            if ($usuario = $this->getUsuarioService()->autenticar($usuario->hydrate($request->getPost()))) {
                $sessionArray = array(
                    'id' => $usuario->getId(),
                    'name' => $usuario->getNome()
                );
                $this->getSession()->setAttribute(Config::get('login-role'), $sessionArray);
                $this->redirect(array('module' => 'admin'));
            }
            $this->setMessage('Falha na Autenticação!', MessageSkin::DANGER);
        }
        $this->setTerminal();
    }

    /**
     * Encerra a Sessao do Usuario
     */
    public function logout()
    {
        $this->getSession()->destroy();
        $this->redirect(array(), false);
    }

    /**
     * @return UsuarioService
     */
    private function getUsuarioService()
    {
        return $this->getService(UsuarioService::class);
    }
}