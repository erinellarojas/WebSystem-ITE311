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
            'enrolledCourses' => ['English 101', 'IT Fundamentals']
        ];

        return view('student/dashboard', $data);
    }

    public function myClasses()
    {
        return view('student/my_classes');
    }

    public function grades()
    {
        return view('student/grades');
    }
}
