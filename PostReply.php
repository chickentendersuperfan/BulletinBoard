<?php
// Start the session
session_start();
?>
<?php
	if(isset($_POST['parent_id']) and isset($_POST['postedSubject']) and !empty($_POST['postedSubject'])) {

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
		
		$sql_insert = "INSERT INTO bbs.postings (poster_id, postedBy, subject, content, parent_id)".
					  "VALUES (" . $user_id . ", \"" . $nickname . "\", \"" . $_POST['postedSubject'] . "\", \"" . $_POST['content'] . "\" ," . $_POST['parent_id'] . ");";

		$conn->query($sql_insert);
		
		$conn->close();		
	}
?>

<!DOCTYPE html>
<head></head>
	
<body>
	<form id="myForm" action="Post.php" method="get">
		<input type="hidden" name="PostID" value="<?php echo $_POST['parent_id']; ?>">	
	</form>
	<script>
		document.getElementById('myForm').submit();
	</script>
</body>


</html>