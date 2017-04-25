<?php
session_start();
require_once('Database.php');

?>
<html>
	<body>
		<?php
			if (isset($_POST['submit'])) {
				if ($_REQUEST['psw'] == "abc123") {
					echo "you're in!";
					$sitedata = new Database();
			        $sitedata->db_connect();
			        $result = $sitedata->do_query("select * from visitors");
			        while ($row = mysqli_fetch_array($result)) {
			            echo "Name: ".$row['name'].", Time Visited: ".$row['time_visited'].", Email: ".$row['email'].
			            ", Inspiration: ".$row['inspiration'].", qcf: ".$row['qcf'];
			        }
				} else {
					echo "Wrong!";
				}
			} else {
				echo '
				<form method="POST">
					<input type="password" name="psw">
	        		<input name="submit" type="submit" id="submitmsg" value="Send" />
				</form>';
			}
		?>
	</body>
</html>