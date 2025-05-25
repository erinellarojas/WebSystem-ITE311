<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    // Registration
    public function register()
    {
        helper(['form']);

        $data = [];

        if($this->request->getMethod() == 'post') {
            // Validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $model->save([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'user',
                ]);

                session()->setFlashdata('success', 'Registration Successful! Please login.');
                return redirect()->to('/login');
            }
        }

        echo view('auth/register', $data);
    }

    // Login
    public function login()
    {
        helper(['form']);

        $data = [];

        if($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[255]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getPost('email'))->first();

                if($user){
                    if(password_verify($this->request->getPost('password'), $user['password'])){
                        $this->setUserSession($user);
                        session()->setFlashdata('success', 'Welcome '.$user['name']);
                        return redirect()->to('/dashboard');
                    } else {
                        session()->setFlashdata('error', 'Incorrect password.');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('error', 'Email not found.');
                    return redirect()->back();
                }
            }
        }

        echo view('auth/login', $data);
    }

    // Set user session
    private function setUserSession($user)
    {
        $data = [
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // Protected Dashboard
    public function dashboard()
    {
        if(!session()->get('isLoggedIn')){
            return redirect()->to('/login');
        }

        echo view('auth/dashboard', [
            'name' => session()->get('name')
        ]);
    }
}
