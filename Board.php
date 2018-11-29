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
			if( $_SERVER['REQUEST_METHOD'] == 'POST'){

				echo "<form action=\"Board.php\" id=\"FormHome\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"user\" value=\"" . $_POST['user'] . "\">";
				echo "<li class=\"nav-item active\">";
					echo "<a class=\"nav-link\" href=\"javascript:{}\" onclick=\"document.getElementById('FormHome').submit(); return false;\">Bulletin Board</a>";
				echo "</li>";
				echo "</form>";

				echo "<li class=\"nav-item\">
						<a class=\"nav-link\">User: " . $_POST['user'] . "</a>" .
					 "</li>";
			}
			else{
				echo "<li class=\"nav-item active\">";
					echo "<a class=\"nav-link\" href=\"Board.php\">Bulletin Board</a>";
				echo "</li>";
			}
		?>
	</ul>
	<ul class="navbar-nav ml-auto">
      <li><a class="nav-link" href="Register.php">Sign Up</a></li>
      <li><a class="nav-link" href="Signin.php">Login</a></li>

	  <?php 
		if( $_SERVER['REQUEST_METHOD'] == 'POST'){
			echo "<li><a class=\"nav-link\" href=\"Board.php\">Logout</a></li>";
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

	if( $_SERVER['REQUEST_METHOD'] == 'POST'){

		$sql_GetName = "SELECT name FROM bbusers WHERE email = '" . $_POST['user'] . "'";
		$result_GetName = $conn->query($sql_GetName);
		mysqli_data_seek($result_GetName,0);
		$name = mysqli_fetch_row($result_GetName)[0];
	}

	$conn->close();
 ?>


<div class="container"> 
 <?php 
	if( $_SERVER['REQUEST_METHOD'] == 'POST'){
 ?>
	<div>
		<form action="PostMessage" method="post">
			Name:  <?php echo $name; ?> <br>
			Email: <?php echo $_POST['user'];?>
			<input type="hidden" name="postBy" value="<?php echo $_POST['user'];?>">
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