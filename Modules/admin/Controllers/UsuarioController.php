<?php

namespace Admin\Controllers;

use Admin\Models\Entities\Usuario;
use Admin\Models\Services\UsuarioService;
use Application\Enum\MessageSkin;
use Core\App;
use Core\Config;
use Core\Controller;
use Core\Exceptions\ResourceNotFoundException;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $this->set('usuarios', $this->getUsuarioService()->listar());
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            $this->redirect();
        }
    }

    /**
     * Cadastra um novo Usuario
     * @throws ResourceNotFoundException
     */
    public function cadastrar()
    {
        if (!empty($this->getUserSession())) {
            $this->setMessage('Você já é membro!', MessageSkin::INFO);
            $this->redirect();
        }
        $request = $this->getRequest();
        $usuario = new Usuario();

        try {
            if ($request->is('post')) {
                $post = $request->getPost();
                $usuario->hydrate($post);
                if (in_array('', $post) || in_array(null, $post)) {
                    throw new \Exception('Todos os campos são obrigatórios!');
                }
                if ($post['senha_criptografada'] !== $post['confirmar']) {
                    throw new \Exception('As senhas não coincidem!');
                }
                $uService = $this->getUsuarioService();
                $uService->beginTransaction();
                try {
                    $uService->salvar($usuario);
                    $uService->commit();

                    $sessionArray = array(
                        'id' => $usuario->getId(),
                        'name' => $usuario->getNome(),
                        'date' => $usuario->getDataInclusaoFormatada()
                    );
                    $this->getSession()->setAttribute(Config::get('login-role'), $sessionArray);

                    $this->setMessage(sprintf('Seja bem-vindo, %s! Aproveite!', $usuario->getNome()), MessageSkin::SUCCESS);
                    $this->redirect(array('module' => 'admin'));
                } catch(\Exception $e) {
                    $uService->rollback();
                    throw $e;
                }
            }
        } catch (\Exception $e) {
            $this->setMessage($e->getMessage(), MessageSkin::DANGER);
        }
        $this->set('usuario', $usuario)->setTerminal();
    }

    /**
     * Password alteration
     */
    public function alterarsenha()
    {
        if (App::getRequest()->is('post')) {
            $userService = $this->getUsuarioService();
            $userService->beginTransaction();
            try {
                $post = App::getRequest()->getPost();
                if (empty($post['senha-atual']) || empty($post['nova-senha']) || empty($post['confirmar-senha'])) {
                    throw new \Exception('Todos os campos são obrigatórios!');
                }
                $usuario = $userService->buscar($this->getUserSession()['id']);
                if ($usuario->getSenha() !== md5($post['senha-atual'])) {
                    throw new \Exception('Senha atual inválida!');
                } elseif ($post['nova-senha'] !== $post['confirmar-senha']) {
                    throw new \Exception('As Senhas não coincidem!');
                } else {
                    $usuario->setSenhaCriptografada($post['nova-senha']);
                    $userService->salvar($usuario);
                    $userService->commit();
                    $this->setMessage('Senha alterada com sucesso!', MessageSkin::SUCCESS);
                    $this->redirect(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'alterarsenha'));
                }
            } catch (\Exception $e) {
                $userService->rollback();
                $this->setMessage($e->getMessage(), MessageSkin::DANGER);
            }
        }
    }

    public function login()
    {
        if (!empty($this->getUserSession())) {
            $this->setMessage('Sua Sessão já foi iniciada!', MessageSkin::INFO);
            $this->redirect();
        }

        $request = $this->getRequest();
        $usuario = new Usuario();
        if ($request->is('post')) {
            $usuario->hydrate($request->getPost());
            if ($this->getUsuarioService()->autenticar($usuario)) {
                $sessionArray = array(
                    'id' => $usuario->getId(),
                    'name' => $usuario->getNome(),
                    'date' => $usuario->getDataInclusaoFormatada()
                );
                $this->getSession()->setAttribute(Config::get('login-role'), $sessionArray);
                $this->redirect(array('module' => 'admin'));
            }
            $this->setMessage('Falha na Autenticação!', MessageSkin::DANGER);
        }
        $this->set('usuario', $usuario)->setTerminal();
    }

    /**
     * Encerra a Sessao do Usuario
     */
    public function logout()
    {
        $this->getSession()->unsetAttribute(Config::get('login-role'));
        $this->setMessage('Você está deslogado!', MessageSkin::INFO);
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