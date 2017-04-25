<?php
    session_start();
    require_once('Database.php');

    function generateRandomString($length = 10) {
    	return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

	$session_id = generateRandomString(16);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thomas Pinella</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
            	//document.getElementById('sp').contentEditable = 'true';
            	var input = document.getElementById('sp');
				input.focus();

            	var counter = 0;

            	// Initial Message

            	setTimeout(function() {
                	responseMessage("");
                }, 1000);

                $("#usermsg").click(function() {
                	input.focus();
                });

                $("#submitmsg").click(function() {
                    var clientmsg = sendUserMessage();
                    setTimeout(function() {
                    	responseMessage(clientmsg);
                    }, 1000);
                    return false;
                });

                $("#usermsg").keypress(function(e){
                	if (e.keyCode == 13) {
                		e.preventDefault();
                		var clientmsg = sendUserMessage();
                    	setTimeout(function() {
                    		responseMessage(clientmsg);
                    	}, 1000);
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
                    return clientmsg;
                }
                
                function responseMessage(clientmsg) {
                	$.post("post.php", {text: clientmsg, num: counter, sesh_id: "<?php echo session_id()?>", string_id: "<?php echo $session_id?>"}, function(data) {
	                    var html = $("#chatbox").html() + 
	                    "<div class='msg-wrapper thomas_msg'><img id='profile-img' src='images/Profile2.jpg' alt='Profile'><div class='msgln_thomas'>"+data+"</div></div>";
	                    $("#chatbox").html(html);
	                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);
	                    counter++;
                    });
                }
            });
        </script>
    </head>
    <body>

    	<table cellspacing="0" cellpadding="0" id="wrapper">
	        <tr><td colspan="2" id="chatbox-wrapper"><div id="chatbox"></div></td></tr>
        	<tr><td colspan="2"><div id="usermsg"><input id="sp" placeholder="Say your name"></div></td><!--<td id="submitmsg">submit</td>--></tr>
        </table>
            <!--<form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" size="63" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
            </form>-->
        </div>
    </body>
</html>







































