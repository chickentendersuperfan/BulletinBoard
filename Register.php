<!DOCTYPE html>
<head>

<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Bootstrap Elegant Sign Up Form with Icons That I Totally Found Online</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<style type="text/css">

html, body {
    height:100%;
} 

body{ 
	background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); 
	background-repeat:no-repeat; 
	background-position:center; 
	background-size:cover; 
	padding:10px;
}
/*body {
	color: #999;
	background: #f5f5f5;
	font-family: 'Roboto', sans-serif;
}*/
.form-control, .form-control:focus, .input-group-addon {
	border-color: #e1e1e1;
    border-radius: 0;
}
.signup-form {
	width: 390px;
	margin: 0 auto;
	padding: 30px 0;
}
.signup-form h2 {
	color: #636363;
    margin: 0 0 15px;
	text-align: center;
}
.signup-form .lead {
    font-size: 14px;
	margin-bottom: 30px;
	text-align: center;
}
.signup-form form {		
	border-radius: 1px;
	margin-bottom: 15px;
    background: #fff;
	border: 1px solid #f3f3f3;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form label {
	font-weight: normal;
	font-size: 13px;
}
.signup-form .form-control {
	min-height: 38px;
	box-shadow: none !important;
	border-width: 0 0 1px 0;
}	
.signup-form .input-group-addon {
	max-width: 42px;
	text-align: center;
	background: none;
	border-width: 0 0 1px 0;
	padding-left: 5px;
}
.signup-form .btn {        
    font-size: 16px;
    font-weight: bold;
	background: #19aa8d;
    border-radius: 3px;
	border: none;
	min-width: 140px;
    outline: none !important;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #179b81;
}
.signup-form a {
	color: #19aa8d;
	text-decoration: none;
}	
.signup-form a:hover {
	text-decoration: underline;
}
.signup-form .fa {
	font-size: 21px;
}
.signup-form .fa-paper-plane {
	font-size: 17px;
}
.signup-form .fa-check {
	color: #fff;
	left: 9px;
	top: 18px;
	font-size: 7px;
	position: absolute;
}

</style>
</head>

<body>

<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<ul class="navbar-nav">
		<li class="nav-item active">
		  <a class="nav-link" href="Board.php">Bulletin Board</a>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
      <li><a class="nav-link" href="Register.php">Sign Up</a></li>
      <li><a class="nav-link" href="Signin.php">Login</a></li>
    </ul>
</nav> -->

 <?php
	if( $_SERVER['REQUEST_METHOD'] == 'POST'){

		 $servername = "localhost";
		 $username = "root";
		 $password = "";
		 $dbname = "bbs";
 
		 $conn = new mysqli($servername, $username, $password, $dbname);
 
		 if ($conn->connect_error){
			die ("Connection failed: " . $conn->connect_error);
		 }

		 $sql = "INSERT INTO bbusers (email, name, password, nickname)" .
				"VALUES ('" . $_POST['EmailInput'] . "', '" . $_POST['NameInput'] . "', '" . $_POST['PasswordInput'] . "', '" . $_POST['NickNameInput'] . "')";

		if ($conn->query($sql) === TRUE){
			echo "<div class=\"center text-center text-success\">";
			echo "Account Created";
			echo "<br><a style=\"text-decoration:none;\" href=\"SignIn.php\">Click Here To Sign In</a>";
			echo "</div>";

		} else{
			echo "<div class=\"center text-center text-danger\">";
			echo "EMAIL IS REGISTERED TO AN ACCOUNT";
			echo "<br><a style=\"text-decoration:none;\" href=\"SignIn.php\">Click Here To Sign In</a>";
			echo "</div>";
		}
		$conn->close();
	}
 ?>

<div class="signup-form">	
    <form action="Register.php" method="post">
		<h2>Create Account</h2>
		<p class="lead">Then you get to meme all you want!</p>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
				<input type="text" class="form-control" name="NickNameInput" placeholder="Username" required="required">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
				<input type="text" class="form-control" name="NameInput" placeholder="First Name" required="required">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-paper-plane"></i></span>
				<input type="email" class="form-control" name="EmailInput" placeholder="Email Address" required="required">
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="text" class="form-control" name="PasswordInput" placeholder="Password" required="required">
			</div>
        </div>      
		<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
        </div>
		<p class="small text-center">By clicking the Sign Up button, you agree to our <br><a href="https://www.google.com/search?q=kappa&rlz=1C1ASRM_enUS673US674&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjPj5iYyPveAhVOKa0KHa8GCyUQ_AUIDygC&biw=1920&bih=938#imgrc=4WLuJ7eulcssIM:" target="_blank">Terms &amp; Conditions</a>, and <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Privacy Policy</a>.</p>
    </form>
	<div class="text-center">Already have an account? <a href="SignIn.php">Login here</a>.</div>
</div>

</body>

</html>