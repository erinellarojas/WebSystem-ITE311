<?php

namespace App\Controllers;

class StudentController extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'student') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Student Dashboard',
            'enrolledCourses' => ['English 101', 'IT Fundamentals'] // sample
        ];

        return view('student/dashboard', $data);
    }
}
