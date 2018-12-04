<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>

html, body {
    height:100%;
} 

.center {
    margin: auto;
	width: 40%;
}

body{ 
	background-image:url("http://localhost/BulletinBoard/images/bg"); 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	padding:10px;
}

/*body {
	color: #999;
	background: #f5f5f5;
	font-family: 'Roboto', sans-serif;
}*/

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}
</style>
</head>

<body>

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
		 $sql = "SELECT COUNT(email) AS total, nickname FROM bbusers WHERE email = '" . $_POST['EmailInput'] . "' AND password = '" . $_POST['PasswordInput'] . "'";
		 $result = $conn->query($sql);
		 $data = mysqli_fetch_assoc($result);
		 $conn->close();

		if($data['total'] == 1){
			$_SESSION['user'] = $_POST['EmailInput'];
			$_SESSION['username'] = $data['nickname'];
			header("Location: http://localhost/BulletinBoard/Board.php"); 
			exit();

		}else{
			header("location: SignIn.php?error=1");
		}

		 
	}
 ?>


<div class="container" align="center">
    <a href="SignIn.php">
        <img border="0" src="http://localhost/BulletinBoard/images/elephant" width="100" height="100">
    </a>
	<h1 class="display-6">tBoard</h1>

<div class="login-form">
	<div class="main-div">
	   <div class="panel">
	   		<h2>User Login</h2>
	   		<p>Please enter your email and password</p>
	   </div>
	    <form id="Login" method="POST">
	        <div class="form-group">
	            <input type="email" class="form-control" name="EmailInput" value="<?php echo $emailText; ?>" placeholder="Email Address">
	        </div>
	        <div class="form-group">
	            <input type="password" class="form-control" name="PasswordInput" placeholder="Password">
	        </div>
	        <button type="submit" name="submitbtn" class="btn btn-primary">Login</button>
	         <?php 
		    	if(isset($_GET['error'])==1 ) {
		    		echo "<div class=\"center text-center text-danger\">";
					echo "Incorrect email or password";
					echo "</div>";
		    	}
	    	?>
	        <div class="forgot" align="center">
	        	<br><center><a href="Register.php">Create Account</a></center>
			</div>
	    </form>

	</div>
</div>
</div>
 
	
</body>
</html>