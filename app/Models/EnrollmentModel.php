<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    /**
     * ✅ Enroll a user in a course
     */
    public function enrollUser($data)
    {
        // Prevent duplicate enrollment
        if ($this->isAlreadyEnrolled($data['user_id'], $data['course_id'])) {
            return false;
        }

        return $this->insert($data);
    }

    /**
     * ✅ Get all courses a specific user is enrolled in
     */
    public function getUserEnrollments($user_id)
    {
        return $this->select('courses.id, courses.course_name, enrollments.enrollment_date')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->findAll();
    }

    /**
     * ✅ Check if user is already enrolled in a given course
     */
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        return $this->where([
            'user_id' => $user_id,
            'course_id' => $course_id
        ])->first();
    }

    /**
     * ✅ Count total enrolled students per course (for teacher dashboard)
     */
    public function countEnrollmentsByCourse($course_id)
    {
        return $this->where('course_id', $course_id)->countAllResults();
    }
}
