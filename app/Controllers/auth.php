<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Auth extends Controller
{
    public function login()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function auth()
    {
        $session = session();
        $db = Database::connect();
        $builder = $db->table('users');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $builder->where('username', $username)->get()->getRowArray();

        // fallback admin login
        if (!$user && $username === 'admin' && $password === '12345') {
            $session->set([
                'isLoggedIn' => true,
                'id'         => 1,
                'username'   => 'admin',
                'role'       => 'admin',
            ]);
            return redirect()->to('/dashboard');
        }

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'isLoggedIn' => true,
                'id'         => $user['id'],
                'username'   => $user['username'],
                'role'       => $user['role'],
            ]);
            return redirect()->to('/dashboard');
        }

        $session->setFlashdata('error', 'Invalid username or password');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}





