<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = 'materials';
    protected $allowedFields = ['course_id', 'filename', 'filepath', 'uploaded_by', 'uploaded_at'];

    // Removed insertMaterial method as it's not needed

    public function getMaterialsByCourse($course_id)
    {
        return $this->where('course_id', $course_id)->findAll();
    }
}
