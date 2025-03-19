<?php

class Database
{
    private $host = "localhost";
    private $user = "postgres";
    private $pass = "pp";
    private $dbname = "Formatrack";

    public $connect;

    public function getConnection()
    {
        $this->connect = null;

        try {
            $this->connect = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $this->connect;
    }
}
