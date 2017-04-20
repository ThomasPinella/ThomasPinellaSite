<?php
	session_start();
	$text = $_POST['text'];

	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>Me</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	fclose($fp);
?>