<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'role', 'password'];
    protected $useTimestamps = true;

    // Automatically hash password before saving
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            $password = $data['data']['password'];

            // Only hash if it's not already hashed
            if (!password_get_info($password)['algo']) {
                $data['data']['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        return $data;
    }

    /**
     * Verify user credentials
     *
     * @param string $email The user's email
     * @param string $password The password to verify
     * @return array|false Returns user array if credentials match, false otherwise
     */
    public function verifyPassword(string $email, string $password)
    {
        if (empty($email) || empty($password)) {
            return false; // prevent null values
        }

        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
