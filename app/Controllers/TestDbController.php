<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestDbController extends Controller
{
    public function index()
    {
        log_message('debug', 'Testing database connection');
        try {
            $db = \Config\Database::connect();
            if (!$db->connID) {
                log_message('error', 'Failed to connect to database');
                throw new \Exception('Unable to connect to the database');
            }
            $query = $db->query('SELECT * FROM pengguna');
            log_message('debug', 'Query executed successfully: SELECT * FROM pengguna');
            echo '<pre>';
            print_r($query->getResultArray());
            echo '</pre>';
        } catch (\Exception $e) {
            log_message('error', 'Database Error: ' . $e->getMessage());
            echo 'Database Error: ' . $e->getMessage();
        }
    }
}