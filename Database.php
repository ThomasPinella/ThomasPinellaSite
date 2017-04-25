<?php
//set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib1.0.5');

//include('Net/SSH2.php');

class Database {
    var $servername = "thomaspinella.db";
    var $username = "thomas";
    var $password = "password";
    var $dbname = "sitedata";
    var $conn;
    
    function db_connect() {
        // For testing


        /*
        $ssh = new Net_SSH2('ssh.phx.nearlyfreespeech.net');
        if (!$ssh->login('txpinella_thomaspinella', 'oakman101')) {
            exit('Login Failed');
        }*/

        // For on server
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

    function insert($sql) {
        $this->conn->query($sql);
    }
}

?>