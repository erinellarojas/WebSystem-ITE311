<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['course_name', 'description', 'teacher_id', 'created_at'];
    protected $useTimestamps = false;

    /**
     * Get all courses with teacher information
     */
    public function getCoursesWithTeacher()
    {
        return $this->select('courses.*, users.username as teacher_name')
                    ->join('users', 'users.id = courses.teacher_id')
                    ->findAll();
    }

    /**
     * Get courses by teacher
     */
    public function getCoursesByTeacher($teacher_id)
    {
        return $this->where('teacher_id', $teacher_id)->findAll();
    }
}
