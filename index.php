<?php
    session_start();
    require_once('Database.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Thomas Pinella</title>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="ConversationLogic.js"></script>
        <script>
            $(document).ready(function() {
            	var counter = 0;
                $("#submitmsg").click(function() {
                    var clientmsg = $("#usermsg").val();
                    var html = $("#chatbox").html() + "<div class='msgln'>Me: "+clientmsg+"</div>";
                    $("#chatbox").html(html);
                    $("#usermsg").val("");
                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);

                    setTimeout(function() {
                    	responseMessage(clientmsg);
                    }, 1000);
                    
                    return false;
                });
                
                function responseMessage(clientmsg) {
                	$.post("post.php", {text: clientmsg, num: counter}, function(data) {
	                    var html = $("#chatbox").html() + "<div class='msgln'>Thomas: "+data+"</div>";
	                    $("#chatbox").html(html);
	                    $('#chatbox').animate({scrollTop: $('#chatbox').prop("scrollHeight")}, 1);
	                    counter++;
                    });
                }
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="menu">
            <p class="welcome">Welcome, <b></b></p>
            <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
            <div style="clear:both"></div>
        </div>

        <div id="chatbox">

        </div>
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" size="63" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
            </form>
        </div>
        <?php
            echo session_id();
            echo $_SERVER['DOCUMENT_ROOT'];
            echo "<br>";
            $sitedata = new Database();
            $sitedata->db_connect();
            $result = $sitedata->do_query("select * from visitors");
            while ($row = mysqli_fetch_array($result)) {
                echo $row['name'];
            }
        ?>
    </body>
</html>







































