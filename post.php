<?php
    session_start();
    require_once('Database.php');
    require_once('Visitors_db.php');
    
    $clientmsg = $_POST['text'];
    $convo_time = $_POST['num'];
    $session_id = $_POST['sesh_id'];
    $string_id = $_POST['string_id'];
    
    $sitedata = new Database();
    $sitedata->db_connect();
    $visitors_db = new Visitors_db($sitedata);

    switch ($convo_time) {
        case 0:
	    	$visitors_db->insert_new_user($string_id, $session_id);
	        echo "Hello and welcome to my website, <a href='http://thomaspinella.com'>thomaspinella.com</a>! As you might have guessed, my name is Thomas Pinella. I'm a Computer Science major and rising senior at the University of Rochester.

What's your name?";
	        break;
    	case 1:
    		$visitors_db->add_name($string_id, $clientmsg);
	        echo "Hi ".$clientmsg."! Happy to meet you! It gets dreadfully boring living inside this site sometimes...

Anyways, the purpose of this conversation is for you to learn a bit about me and vice versa. You're turn, ask me a question!";
			break;
    }
    
?>