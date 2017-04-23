<?php
    session_start();
    $clientmsg = $_POST['text'];
    $convo_time = $_POST['num'];

    $fp = fopen("data.txt", 'a+');
    fwrite($fp, "Here is what they said: ".$text);
    fclose($fp);
    echo "I'm a Thomas!".$text.$convo_time;

    function($clientmsg, $convo_time) {
    	
    }

?>