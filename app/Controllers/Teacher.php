<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\MaterialModel;
use CodeIgniter\Controller;

class Teacher extends BaseController
{
    /**
     * ✅ Show all courses handled by the teacher
     */
    public function index()
    {
        $session = session();
        $teacher_id = $session->get('user_id');

        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->where('teacher_id', $teacher_id)->findAll();

        return view('teacher/courses', $data);
    }

    /**
     * ✅ Show Upload Form + handle upload
     */
    public function upload()
    {
        helper(['form', 'url']);

        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll(); // Show all courses (or only teacher’s courses if needed)

        return view('teacher/upload_material', $data);
    }

    /**
     * ✅ Optional: Display all uploaded materials by the teacher
     */
    public function materials()
    {
        $materialModel = new MaterialModel();
        $data['materials'] = $materialModel->findAll();

        return view('teacher/material_list', $data);
    }
}
