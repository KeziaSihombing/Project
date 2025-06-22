<?php

class Model{
    protected $db;
    function __construct()
    {
        $hostname = 'localhost';
        $username = 'root';
        $password = 'rahasia';
        $dbname = 'catcare';
        
        $this->db = new mysqli ($hostname, 
        $username,
        $password,
        $dbname);    
    }

        public function __destruct() {
        if ($this->db) {
            $this->db->close();
        }
    }

    protected function escape($string) {
        return $this->db->real_escape_string($string);
    }

    protected function query($sql) {
        $result = $this->db->query($sql);
        if (!$result) {
            throw new Exception("Query error: " . $this->mysqli->error);
        }
        return $result;
    }
}

