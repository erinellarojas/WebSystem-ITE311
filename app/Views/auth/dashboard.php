<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = Database::connect();
        $role = $session->get('role');
        $username = $session->get('username');
        $userId = $session->get('id');

        // Default values
        $totalUsers = 0;
        $totalCourses = 0;
        $myCourses = 0;
        $assignments = 0;
        $enrolled = 0;
        $pendingAssignments = 0;

        if ($role === 'admin') {
            $totalUsers = $db->table('users')->countAllResults();
            $totalCourses = $db->table('courses')->countAllResults();
        } elseif ($role === 'teacher') {
            $myCourses = $db->table('courses')->where('teacher_id', $userId)->countAllResults();
            $assignments = $db->table('assignments')
                              ->join('courses', 'courses.id = assignments.course_id')
                              ->where('courses.teacher_id', $userId)
                              ->countAllResults();
        } elseif ($role === 'student') {
            $enrolled = $db->table('enrollments')->where('student_id', $userId)->countAllResults();
            $pendingAssignments = $db->table('assignments')
                                      ->join('enrollments', 'assignments.course_id = enrollments.course_id')
                                      ->where('enrollments.student_id', $userId)
                                      ->countAllResults();
        }

        $data = [
            'role' => $role,
            'username' => $username,
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'myCourses' => $myCourses,
            'assignments' => $assignments,
            'enrolled' => $enrolled,
            'pendingAssignments' => $pendingAssignments,
        ];

        return view('dashboard/index', $data);
    }
}
