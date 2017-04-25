<?php
class Visitors_db {
	var $database;
	function __construct($db) {
		$this->database = $db;
        $result = $this->database->do_query("select * from visitors");
        while ($row = mysqli_fetch_array($result)) {
            echo $row['name'];
        }
	}

	function get_item($sql, $item_name) {
        $result = $this->database->do_query($sql);
        $item = "";
        while ($row = mysqli_fetch_array($result)) {
            $item = $row[$item_name];
        }
        return $item;
	}

	function insert_new_user($session_id) {
		$sql = "INSERT INTO visitors VALUES (DEFAULT, ".$session_id.", CURRENT_TIMESTAMP, null, null, null, null);";
        $result = $this->database->do_query($sql);
        echo $result;
	}

	function add_name($session_id) {
		$sql = "UPDATE visitors SET name = '".$name."' WHERE session_id = ".$session_id.";";
        $result = $this->database->do_query($sql);
	}

	function add_email($session_id, $email) {
		$sql = "UPDATE visitors SET email = '".$email."' WHERE session_id = ".$session_id.";";
        $result = $this->database->do_query($sql);
	}

	function get_name($session_id) {
		$sql = "SELECT name FROM visitors WHERE session_id = ".$session_id.";";
		return get_item($sql, 'name');
	}

	function get_inspiration($session_id) {
		$sql = "SELECT inspiration FROM visitors WHERE session_id = ".$session_id.";";
		return get_item($sql, 'inspiration');
	}
}
?>







































