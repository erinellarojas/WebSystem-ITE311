<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EnrollmentModel;

class Course extends Controller
{
    public function enroll()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized']);
        }

        $user_id = $session->get('id');
        $course_id = $this->request->getPost('course_id');
        $model = new EnrollmentModel();

        if ($model->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Already enrolled']);
        }

        $model->enrollUser([
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Enrolled successfully']);
    }
}

