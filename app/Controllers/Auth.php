<?php 

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
        $this->session = session();

        // No auto-login for production
    }

    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password_hash'])) {
                $this->session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard');
            } else {
                return view('auth/login', ['error' => 'Invalid credentials']);
            }
        }

        return view('auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role') ?? 'student',
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->userModel->insert($data)) {
                return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
            } else {
                return view('auth/register', ['error' => 'Registration failed']);
            }
        }

        return view('auth/register');
    }

    public function dashboard()
    {
        // Perform authorization check (ensure user is logged in)
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role = $this->session->get('role');
        $username = $this->session->get('username');
        $stats = [];

        // Fetch role-specific data from the database
        if ($role === 'admin') {
            $db = \Config\Database::connect();
            $stats['users_count'] = $db->table('users')->countAll();
        } elseif ($role === 'teacher') {
            $courseModel = new \App\Models\CourseModel();
            $stats['course_count'] = $courseModel->where('teacher_id', $this->session->get('user_id'))->countAllResults();
        } elseif ($role === 'student') {
            $enrollmentModel = new \App\Models\EnrollmentModel();
            $stats['enrolled_courses'] = $enrollmentModel->where('user_id', $this->session->get('user_id'))->countAllResults();
        }

        $data = ['role' => $role, 'username' => $username, 'stats' => $stats];

        // For students, include additional data for enrolled courses and materials
        if ($role === 'student') {
            $enrollmentModel = new \App\Models\EnrollmentModel();
            $courseModel = new \App\Models\CourseModel();
            $materialModel = new \App\Models\MaterialModel();

            $data['enrolledCourses'] = $enrollmentModel->getUserEnrollments($this->session->get('user_id'));
            $data['materialModel'] = $materialModel;

            $enrolledCourseIds = array_column($data['enrolledCourses'], 'id');
            if (!empty($enrolledCourseIds)) {
                $data['availableCourses'] = $courseModel->whereNotIn('id', $enrolledCourseIds)->findAll();
            } else {
                $data['availableCourses'] = $courseModel->findAll();
            }
        }

        // For teachers, include courses data
        if ($role === 'teacher') {
            $courseModel = new \App\Models\CourseModel();
            $data['courses'] = $courseModel->where('teacher_id', $this->session->get('user_id'))->findAll();
        }

        echo view('templates/header', $data);
        echo view('auth/dashboard', $data);
        echo view('templates/footer');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
