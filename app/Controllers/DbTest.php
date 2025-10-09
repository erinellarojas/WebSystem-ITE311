<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DbTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            $query = $db->query("SELECT DATABASE() AS db_name");
            $result = $query->getRow();
            return "Database connected successfully: " . $result->db_name;
        } catch (\Exception $e) {
            return "Database connection failed: " . $e->getMessage();
        }
    }
}
