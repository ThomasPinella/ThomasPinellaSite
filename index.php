<?php
    session_start();
    require_once('Database.php');

    function generateRandomString($length = 10) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

	$session_id = generateRandomString(16);

	$ip_address = $_SERVER["REMOTE_ADDR"];
	
?>

<html>
    <head>
    	<link rel="apple-touch-icon" sizes="57x57" href="fav.ico/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="fav.ico/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="fav.ico/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="fav.ico/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="fav.ico/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="fav.ico/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="fav.ico/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="fav.ico/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="fav.ico/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="fav.ico/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="fav.ico/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="fav.ico/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="fav.ico/favicon-16x16.png">
		<link rel="manifest" href="fav.ico/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thomas Pinella</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-98196751-1', 'auto');
			ga('send', 'pageview');

		</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
            	var input = document.getElementById('sp');
				input.focus();
            	var counter = 0;
        		window.loop = false;
            	// Initial Message
                waveAnimation();
            	setTimeout(function() {
                	responseMessage("");
                }, 200);

                $("#usermsg").click(function() {
                	input.focus();
                });

                $("#submitmsg").click(function() {
                    var clientmsg = sendUserMessage();
                    setTimeout(function() {
                    	responseMessage(clientmsg);
                    }, 900);
                    return false;
                });

                $("#usermsg").keypress(function(e){
                	if (e.keyCode == 13) {
                		e.preventDefault();
                		var clientmsg = sendUserMessage();
                    	setTimeout(function() {
                    		responseMessage(clientmsg);
                    	}, 900);
                    	return false;
                	}
                });

                function sendUserMessage() {
                    var clientmsg = $("#sp").val();
                    var html = $("#chatbox").html() + "<div class='msg-wrapper user_msg'><div class='msgln_user'>"+clientmsg+"</div></div>";
                    $("#chatbox").html(html);
                    $("#sp").val("");
                    input.focus();
                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);
                    waveAnimation();
                    return clientmsg;
                }

                function waveAnimation() {
                	var html = $("#chatbox").html() + "<div class='msg-wrapper wave-wrapper'><img id='profile-img' src='images/Profile2.jpg' alt='Profile'><div class='msgln_thomas' id='wave'><span class='dot'></span><span class='dot'></span><span class='dot'></span></div></div>";
                	$("#chatbox").html(html);
                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);
                }
                
                function responseMessage(clientmsg) {
                	$.post("post.php", {text: clientmsg, num: counter, sesh_id: "<?php echo session_id()?>", string_id: "<?php echo $session_id?>", ip_address: "<?php echo $ip_address?>"}, function(data) {
                		$(".wave-wrapper").remove();
	                    var html = $("#chatbox").html() + 
	                    "<div class='msg-wrapper thomas_msg'><img id='profile-img' src='images/Profile2.jpg' alt='Profile'><div class='msgln_thomas'>"+data+"</div></div>";
	                    $("#chatbox").html(html);
	                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);
	                    if (!window.loop) {
	                    	counter++;
	                	}
                    });
                }
            });
        </script>
    </head>
    <body>

    	<table cellspacing="0" cellpadding="0" id="wrapper">
	        <tr><td colspan="2" id="chatbox-wrapper"><div id="chatbox"></div></td></tr>
        	<tr><td colspan="2"><div id="usermsg"><input id="sp"></div></td><!--<td id="submitmsg">submit</td>--></tr>
        </table>
            <!--<form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" size="63" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
            </form>-->
    </body>
</html>







































