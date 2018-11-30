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
		<li class="nav-item active">
		  <a class="nav-link" href="Board.php">Bulletin Board</a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
      <li><a class="nav-link" href="Register.php">Sign Up</a></li>
      <li><a class="nav-link" href="Signin.php">Login</a></li>
    </ul>
</nav>

 <?php 
	$emailText = "";
 	if( $_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$emailText = $_POST['EmailInput'];

		 $servername = "localhost";
		 $username = "root";
		 $password = "";
		 $dbname = "bbs";
 
		 $conn = new mysqli($servername, $username, $password, $dbname);
 
		 if ($conn->connect_error){
			die ("Connection failed: " . $conn->connect_error);
		 }
		 $sql = "SELECT COUNT(email), nickname AS total FROM bbusers WHERE email = '" . $_POST['EmailInput'] . "' AND password = '" . $_POST['PasswordInput'] . "'";
		 $result = $conn->query($sql);
		 $data = mysqli_fetch_assoc($result);
		 $conn->close();

		 if($data['total'] == 1){
			$_SESSION['user'] = $_POST['EmailInput'];
			$_SESSION['username'] = $data['nickname'];
			header("Location: http://localhost/BulletinBoard/Board.php"); 
			exit();

		 }else{
			echo "<div class=\"center text-center text-danger\">";
			echo "PASSWORD IS INCORRECT";
			echo "</div>";
		}

		 
	}
 ?>

 <div class="container">
 	<div class="center">
		<h3>Sign In</h2>
		<form method="post">
			<div class="form-group">

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="width: 90px;">Email</span>
					</div>
					<input type="text" name="EmailInput" value="<?php echo $emailText; ?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" style="width: 90px;">Password</span>
					</div>
				<input type="password" name="PasswordInput" class="form-control" required>
				</div>
			</div>
			<input type="submit" value="Sign In" class="btn btn-primary">
		</form>

	</div>

 </div>


 
	
</body>


</html>