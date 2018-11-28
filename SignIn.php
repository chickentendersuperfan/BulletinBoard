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
 <?php 
	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $dbname = "bbs";
 
	 $conn = new mysqli($servername, $username, $password, $dbname);
 
	 if ($conn->connect_error){
		die ("Connection failed: " . $conn->connect_error);
	 }

	 $conn->close();
 ?>

 <div class="container">
 	<div class="center">
		<form method="post">
			<div class="form-group">
					Email: <input type="text" name="EmailInput" class="form-control" required>
			</div>
			<div class="form-group">
					Password: <input type="password" name="PasswordInput" class="form-control" required>
			</div>
			<input type="submit" class="btn btn-primary">
		</form>
	</div>
 </div>


 
	
</body>


</html>