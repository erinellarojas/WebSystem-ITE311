<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();

        // Only process POST requests
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/auth');
        }

        $email = trim($this->request->getPost('email') ?? '');
        $password = trim($this->request->getPost('password') ?? '');

        // Prevent empty input
        if (empty($email) || empty($password)) {
            $session->setFlashdata('error', 'Email and password are required');
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();
        $user = $userModel->verifyPassword($email, $password);

        if ($user) {
            // Set user session
            $session->set([
                'user_id'    => $user['id'],
                'name'       => $user['name'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            $session->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth');
    }
}
