<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    public function enroll()
    {
        $session = session();

        // ✅ Ensure the user is logged in
        if (!$session->get('user_id')) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Unauthorized'
            ])->setStatusCode(401);
        }

        // ✅ Get the POST data
        $course_id = $this->request->getPost('course_id');
        $user_id   = $session->get('user_id');

        // ✅ Initialize the model
        $enrollmentModel = new EnrollmentModel();

        // ✅ Prevent duplicate enrollments
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Already enrolled'
            ]);
        }

        // ✅ Insert new enrollment record
        $enrollmentModel->enrollUser([
            'user_id'         => $user_id,
            'course_id'       => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Enrollment successful'
        ]);
    }
}
