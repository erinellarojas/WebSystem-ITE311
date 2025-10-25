<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;
use App\Models\MaterialModel;

class Student extends BaseController
{
    public function dashboard()
    {
        $session = session();

        // ✅ TEMPORARY: Auto-login for testing
        if (! $session->get('user_id')) {
            $session->set([
                'user_id' => 4,          // student1 ID from seeder
                'username' => 'student1',
                'role' => 'student'
            ]);
        }

        $user_id = $session->get('user_id');

        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();
        $materialModel = new MaterialModel();

        $data['enrolledCourses'] = $enrollmentModel->getUserEnrollments($user_id);
        $data['materialModel'] = $materialModel;

        $enrolledCourseIds = array_column($data['enrolledCourses'], 'id');

        if (!empty($enrolledCourseIds)) {
            $data['availableCourses'] = $courseModel
                ->whereNotIn('id', $enrolledCourseIds)
                ->findAll();
        } else {
            $data['availableCourses'] = $courseModel->findAll();
        }

        return view('student/dashboard', $data);
    }
}
