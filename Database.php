<?php

class Database {
    var $servername = "thomaspinella.db";
    var $username = "thomas";
    var $password = "password";
    var $dbname = "sitedata";
    var $conn;
    
    function db_connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    function db_close() {
        $this->conn->close();
    }
    
    function do_query($sql) {
        $result = $this->conn->query($sql);
        return $result;
    }
}
