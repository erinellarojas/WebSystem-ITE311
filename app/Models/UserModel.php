<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
<<<<<<< HEAD
    protected $allowedFields = ['username', 'email', 'password', 'role'];
}
=======
    protected $allowedFields = ['name', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}

>>>>>>> 898cc8a9ba3b665aa087f60ba3366d7bdbd719e3
