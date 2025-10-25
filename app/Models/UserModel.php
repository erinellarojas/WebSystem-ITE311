<?php namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','email','password_hash','role','created_at','updated_at'];
    protected $useTimestamps = true;

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }
}
