<?php
class Visitors_db {
	var $database;
	function __construct($db) {
		$this->database = $db;
	}

	function get_item($sql, $item_name) {
        $result = $this->database->do_query($sql);
        $item = "";
        while ($row = mysqli_fetch_array($result)) {
            $item = $row[$item_name];
        }
        return $item;
	}

	function insert_new_user($string_id, $session_id) {
		$sql = "INSERT INTO visitors VALUES (DEFAULT, '".$string_id."', '".$session_id."', CURRENT_TIMESTAMP, null, null, null, null);";
        $result = $this->database->do_query($sql);
	}

	function add_name($string_id, $name) {
		$sql = "UPDATE visitors SET name = '".$name."' WHERE string_id = '".$string_id."';";
        $result = $this->database->do_query($sql);
	}

	function add_email($string_id, $email) {
		$sql = "UPDATE visitors SET email = '".$email."' WHERE string_id = '".$string_id."';";
        $result = $this->database->do_query($sql);
	}

	function get_name($string_id) {
		$sql = "SELECT name FROM visitors WHERE string_id = '".$string_id."';";
		return $this->get_item($sql, 'name');
	}

	function get_inspiration($string_id) {
		$sql = "SELECT inspiration FROM visitors WHERE string_id = '".$string_id."';";
		return $this->get_item($sql, 'inspiration');
	}
}
?>