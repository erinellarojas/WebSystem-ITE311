<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DbTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect(); // connect to default DB
            $result = $db->query("SELECT DATABASE() AS db")->getRow();

            return "Database connection successful! Connected to: " . $result->db;
        } catch (\Exception $e) {
            return "Database connection failed: " . $e->getMessage();
        }
    }
}
