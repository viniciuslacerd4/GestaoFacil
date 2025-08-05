<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $senha = $this->request->getPost('senha');

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getByEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                session()->set('usuario_id', $usuario['id']);
                session()->set('usuario_nome', $usuario['nome']);
                return redirect()->to('/dashboard');
            } else {
                return view('auth/login', ['erro' => 'E-mail ou senha inválidos.']);
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
