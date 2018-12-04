<?php
// Start the session
session_start();
?>

<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bbs";
 
	$conn = new mysqli($servername, $username, $password, $dbname);
 
	if ($conn->connect_error){
		die ("Connection failed: " . $conn->connect_error);
	}

	$sql_GetPost = "SELECT count(*) AS total, subject FROM postings WHERE message_id = " . $_GET['PostID'];
	$result_GetPost = $conn->query($sql_GetPost);
	$post = mysqli_fetch_assoc($result_GetPost);
	if($post['total'] > 0){
		$subject = "RE: " . $post['subject'];
	}
?>

<!DOCTYPE html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<style>
.center {
    margin: auto;
	width: 40%;
}

html, body {
    height:100%;
}

body{ 
	background-image:url("http://localhost/BulletinBoard/bg"); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

/* The Modal (background) */
.reply {
    
    position: fixed; /* Stay in place */
    padding-top: 100px; /* Location of the box */
    left: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.reply-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

</style>

</head>
<body>

 <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="opacity: 0.8;">
	<ul class="navbar-nav">
		
		<?php 
			echo "<li class=\"nav-item active\">";
					echo "<a class=\"nav-link\" href=\"Board.php\">tBoard</a>";
			echo "</li>";
			if(isset($_SESSION['user'])){

				echo "<li class=\"nav-item\">
						<a class=\"nav-link\">User: " . $_SESSION['username'] . "</a>" .
					 "</li>";
			}
		?>
	</ul>
	<ul class="navbar-nav ml-auto">
	  <?php 
		if(isset($_SESSION['user'])){
			echo "<form action=\"Logout.php\" id=\"FormLogout\" method=\"post\">";
				echo "<li class=\"nav-item\">";
					echo "<a class=\"nav-link\" href=\"javascript:{}\" onclick=\"document.getElementById('FormLogout').submit(); return false;\">Logout</a>";
				echo "</li>";
				echo "</form>";
		}
		else{
			echo "<li><a class=\"nav-link\" href=\"Register.php\">Sign Up</a></li>";
			echo "<li><a class=\"nav-link\" href=\"Signin.php\">Login</a></li>";
		}
	  ?>
	  
    </ul>
</nav>

<?php if($post['total'] > 0){ ?>
<div class="container-fluid">
	<div class="reply">
		<div class="reply-content">
			<form action="PostReply.php" method="post">
				Name:  <?php echo $_SESSION['username']; ?> <br>
				<input type="hidden" name="postBy" value="<?php echo $_SESSION['user'];?>">
				<input type="hidden" name="parent_id" value="<?php echo $_GET['PostID'];?>">
				<div class="form-inline">
					<label>Subject:&nbsp;</label>
					<input type="text" class="form-control" name="postedSubject" value="<?php echo $subject; ?>" style="width:500px;" readonly>
				</div>
				<div class="form-group">
					<label>Message:</label>
					<textarea class="form-control" rows="5" id="comment" name="content" style="width:800px;" required></textarea>
				</div>
				<input type="submit" value="Post Message" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>
<?php } ?>
</body>

</html>