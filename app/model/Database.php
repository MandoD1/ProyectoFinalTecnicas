<?php

namespace App\Models;

class Database {
    protected $db;

    public function __construct(){
        $this->db = new \mysqli('127.0.0.1', 'root', 'root', 'proyectoFinalTecnicas');

        if ($this->db->connect_error) {
            die("Conexión fallida: " . $this->db->connect_error);
        }
    }

    public function __destruct(){
        $this->db->close();
    }

    public function getConnection(): \mysqli{
        return $this->db;
    }

}
