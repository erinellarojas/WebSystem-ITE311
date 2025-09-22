<?php

namespace App\Controllers;

class TeacherController extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'teacher') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Teacher Dashboard',
            'courses' => ['Math 101', 'Science 202'] // sample lang
        ];

        return view('teacher/dashboard', $data);
    }
}
