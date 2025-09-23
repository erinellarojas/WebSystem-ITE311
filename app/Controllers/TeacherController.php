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
            'courses' => ['Math 101', 'Science 202']
        ];

        return view('teacher/dashboard', $data);
    }

    public function myCourses()
    {
        return view('teacher/my_courses');
    }

    public function assignments()
    {
        return view('teacher/assignments');
    }
}
