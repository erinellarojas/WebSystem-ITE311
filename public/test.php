<?php
$db = \Config\Database::connect();

if ($db->connID) {
    echo "Database connection OK!";
} else {
    echo "Failed to connect to database.";
}

