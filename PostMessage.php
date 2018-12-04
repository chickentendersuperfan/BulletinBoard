<?php
// Start the session
session_start();
?>
<?php
	if(isset($_POST['postedSubject']) and !empty($_POST['postedSubject'])) {

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bbs";
	 
		$conn = new mysqli($servername, $username, $password, $dbname);
	 
		if ($conn->connect_error){
			die ("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT nickname, user_id FROM bbusers WHERE email = '" . $_SESSION['user'] . "'";
		$result_GetNN= $conn->query($sql);
		$row = $result_GetNN->fetch_assoc();
		$nickname = $row['nickname'];
		$user_id = $row['user_id'];
		
		$sql_insert = "INSERT INTO bbs.postings (poster_id, postedBy, subject, content, parent_id) ".
					  "VALUES (" . $user_id . ", \"" . $nickname . "\", \"" . $_POST['postedSubject'] . "\", \"" . $_POST['content'] . "\" , 0);";

		$conn->query($sql_insert);
		
		$conn->close();
		header("Location: http://localhost/BulletinBoard/Board.php"); 
		exit();
		
	}
?>