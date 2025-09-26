<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Auth extends BaseController
{
    public function register()
    {
        $session = session();

       
        if ($session->get('userID')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
          
            $rules = [
                'name'             => 'required|min_length[2]|max_length[100]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]'
            ];

            if (! $this->validate($rules)) {
                return view('auth/register', ['validation' => $this->validator]);
            }

           
            $data = [
                'name'       => $this->request->getPost('name'),
                'email'      => $this->request->getPost('email'),
                'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'       => $this->request->getPost('role') ?? 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

           
            $db      = Database::connect();
            $builder = $db->table('users');

            if ($builder->insert($data)) {
                $session->setFlashdata('success', 'Registration successful! Please login.');
                return redirect()->to('/login');
            } else {
                $session->setFlashdata('error', 'Registration failed. Please try again.');
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        $db      = Database::connect();
        $session = session();

      
        if ($session->get('userID')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required'
            ];

            if (! $this->validate($rules)) {
                return view('auth/login', ['validation' => $this->validator]);
            }

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

         
            $builder = $db->table('users');
            $user    = $builder->where('email', $email)->get()->getRowArray();

            if ($user && password_verify($password, $user['password'])) {
              
                $session->set([
                    'userID'     => $user['id'],
                    'name'       => $user['name'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true
                ]);


                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to('/admin/dashboard');
                    case 'teacher':
                        return redirect()->to('/teacher/dashboard');
                    case 'student':
                        return redirect()->to('/student/dashboard');
                    default:
                        return redirect()->to('/dashboard');
                }
            } else {
                $session->setFlashdata('error', 'Invalid email or password.');
                return redirect()->back()->withInput();
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        $session = session();
        $session->setFlashdata('success', 'You have been logged out successfully.');
        $session->destroy();
        return redirect()->to('/login');
    }

    public function dashboard()
    {
        $session = session();

        
        if (! $session->get('userID')) {
            $session->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to('/login');
        }

        $data = [
            'user' => [
                'id'    => $session->get('userID'),
                'name'  => $session->get('name'),
                'email' => $session->get('email'),
                'role'  => $session->get('role')
            ]
        ];

        return view('auth/dashboard', $data);
    }
}
