<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        helper(['form', 'url']);
        $model = new UserModel();

        if($this->request->getMethod() == 'post'){
            // Validation rules
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'password_confirm' => 'matches[password]'
            ];

            if($this->validate($rules)){
                // Save user
                $model->save([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'user'
                ]);

                $this->session->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/login');
            } else {
                $this->session->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }

        echo view('auth/register');
    }

    public function login()
    {
        helper(['form', 'url']);
        $model = new UserModel();

        if($this->request->getMethod() == 'post'){
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ];

            if($this->validate($rules)){
                $user = $model->where('email', $this->request->getPost('email'))->first();

                if($user && password_verify($this->request->getPost('password'), $user['password'])){
                    // Set session
                    $this->session->set([
                        'user_id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLoggedIn' => true
                    ]);

                    return redirect()->to('/dashboard');
                } else {
                    $this->session->setFlashdata('error', 'Invalid email or password');
                    return redirect()->back()->withInput();
                }
            } else {
                $this->session->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
        }

        echo view('auth/login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        if(!$this->session->get('isLoggedIn')){
            return redirect()->to('/login');
        }

        echo "Welcome, ".$this->session->get('name')."! <br>";
        echo '<a href="/logout">Logout</a>';
    }
}
