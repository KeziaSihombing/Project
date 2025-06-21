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
}

