<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class StudentController extends Controller
{
    public function dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'student') {
            return redirect()->to('/login');
        }

        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        $data = [
            'courses' => $courseModel->findAll(),
            'enrollments' => $enrollmentModel->getUserEnrollments($session->get('user_id'))
        ];

        return view('dashboard/index', $data);
    }
}
