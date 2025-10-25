<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

class Material extends Controller
{
    protected $materialModel;
    protected $enrollmentModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->materialModel = new MaterialModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    // ✅ Upload material (teacher only)
    public function upload($course_id)
    {
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material');

            // Validation check
            if (!$file || !$file->isValid()) {
                return redirect()->back()->with('error', 'Invalid file upload.');
            }

            // Move file to folder
            $newName = $file->getRandomName();
            $file->move('uploads/materials', $newName);

            // Insert into DB
            $this->materialModel->insert([
                'course_id'   => $course_id,
                'filename'    => $file->getClientName(),
                'filepath'    => 'uploads/materials/' . $newName,
            'uploaded_by' => session()->get('user_id'),
                'uploaded_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back()->with('success', 'Material uploaded successfully!');
        }

        // Display upload form
        return view('materials/upload', ['course_id' => $course_id]);
    }

    // ✅ Download material (students only, must be enrolled)
    public function download($id)
    {
        $session = session();
        $user_id = $session->get('user_id');

        $material = $this->materialModel->find($id);

        if (!$material) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Material not found');
        }

        // Check if student is enrolled in this course
        if (!$this->enrollmentModel->isAlreadyEnrolled($user_id, $material['course_id'])) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }

        $filePath = WRITEPATH . '../public/' . $material['filepath'];

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File does not exist on server.');
        }

        return $this->response->download($filePath, null);
    }

    // ✅ Delete material (teacher/admin)
    public function delete($id)
    {
        $material = $this->materialModel->find($id);

        if ($material) {
            $filePath = WRITEPATH . '../public/' . $material['filepath'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->materialModel->delete($id);
            return redirect()->back()->with('success', 'Material deleted successfully.');
        }

        return redirect()->back()->with('error', 'Material not found.');
    }

    // ✅ List all materials (for teacher or student)
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $materials = $this->materialModel
            ->select('materials.*, courses.course_name, users.username as uploader_name')
            ->join('courses', 'courses.id = materials.course_id')
            ->join('users', 'users.id = materials.uploaded_by')
            ->findAll();

        return view('materials/list', ['materials' => $materials]);
    }
}
