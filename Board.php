<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<style>
.center {
    margin: auto;
	width: 40%;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<ul class="navbar-nav">
		
		<?php 
			echo "<li class=\"nav-item active\">";
					echo "<a class=\"nav-link\" href=\"Board.php\">Bulletin Board</a>";
			echo "</li>";
			if(isset($_SESSION['user'])){

				echo "<li class=\"nav-item\">
						<a class=\"nav-link\">User: " . $_SESSION['user'] . "</a>" .
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

 <?php
 	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bbs";
 
	$conn = new mysqli($servername, $username, $password, $dbname);
 
	if ($conn->connect_error){
	die ("Connection failed: " . $conn->connect_error);
	}

	if(isset($_SESSION['user'])){

		$sql_GetName = "SELECT name FROM bbusers WHERE email = '" . $_SESSION['user'] . "'";
		$result_GetName = $conn->query($sql_GetName);
		mysqli_data_seek($result_GetName,0);
		$name = mysqli_fetch_row($result_GetName)[0];
	}

	$conn->close();
 ?>


<div class="container"> 
 <?php 
	if(isset($_SESSION['user'])){
 ?>
	<div>
		<form action="PostMessage" method="post">
			Name:  <?php echo $name; ?> <br>
			Email: <?php echo $_SESSION['user'];?>
			<input type="hidden" name="postBy" value="<?php echo $_SESSION['user'];?>">
			<div class="form-inline">
				<label>Subject:&nbsp;</label>
				<input type="text" class="form-control" name="postedSubject" style="width:500px;">
			</div>
			<div class="form-group">
				<label>Message:</label>
				<textarea class="form-control" rows="5" id="comment" name="content" style="width:800px;"></textarea>
			</div>
			<input type="submit" value="Post Message" class="btn btn-primary">
		</form>
	</div>
<?php } ?>
</div>
</body>


</html>