<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Authorization check
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/'); // bawal pumasok kung hindi admin
        }

        // Sample data (pwede mo palitan later)
        $data = [
            'title' => 'Admin Dashboard',
            'totalUsers' => 50,
            'totalCourses' => 12
        ];

        return view('admin/dashboard', $data);
    }
}
