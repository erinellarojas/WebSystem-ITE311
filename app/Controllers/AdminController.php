<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController
{
    private function guard()
    {
        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied');
        }
        return null;
    }

    public function dashboard()
    {
        if ($redirect = $this->guard()) return $redirect;

        $userModel = new UserModel();

        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => $userModel->countAllResults(),
            'totalCourses' => 12
        ];

        return view('admin/dashboard', $data);
    }

    public function users()
    {
        if ($redirect = $this->guard()) return $redirect;
        return view('admin/users');
    }

    public function courses()
    {
        if ($redirect = $this->guard()) return $redirect;
        return view('admin/courses');
    }

    public function settings()
    {
        if ($redirect = $this->guard()) return $redirect;
        return view('admin/settings');
    }
}
