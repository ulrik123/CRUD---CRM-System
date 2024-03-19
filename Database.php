<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = ''; // Use the actual password for the MySQL root user, if set
    private $dbName = 'Crude_crm'; // Make sure this matches the name on your MySQL server

    public $conn;

    public function __construct() {
        // Attempt to establish a MySQL connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbName);

        // Check connection
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }
}

?>
