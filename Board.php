<?php
// Start the session
session_start();
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
	background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); 
	background-repeat:no-repeat; 
	background-position:center; 
	background-size:cover; 
	padding:10px;
}

.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th {
   background-color: #FDEDEC;
}

.table-striped > tbody > tr:nth-child(even) > td, .table-striped > tbody > tr:nth-child(even) > th {
   background-color: #EAECEE;
}



</style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
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

	$sql_GetPosts = "SELECT t1.message_id, t1.poster_id, t1.postedBy, t1.subject, t1.date, 
					(SELECT COALESCE((SELECT COUNT(message_id) FROM postings WHERE parent_id = t1.message_id group by parent_id),0)) AS reply FROM postings t1 WHERE parent_id = 0";

	
	$result_GetPosts = $conn->query($sql_GetPosts);

	$conn->close();
 ?>


<div class="container-fluid" style="margin-top:80px;"> 
<div>
<?php if($result_GetPosts->num_rows > 0) { ?>
	<table class="table table-bordered table-striped" style="border:1px;">
	<thead>
		<tr class="bg-dark" style="color:white;">
		<td style="font-weight:bold;width:50%;">Subject</td>
		<td style="font-weight:bold;width:27%;">Posted By</td>
		<td style="font-weight:bold;width:3$;"><i class="fas fa-comments" style="font-size:24px"></i></td>
		<td style="font-weight:bold;width:20%;">Post Date</td>
		</tr>
	</thead>
	<tbody>
    <?php while($row = $result_GetPosts->fetch_assoc()) { ?>
		<tr>
			<td><a <?php echo "href=\"Post.php?PostID=" . $row['message_id'] ."\""; ?> style="text-decoration:none;"> <?php echo $row['subject']; ?> </a></td>
			<td><?php echo $row['postedBy'] ?></td>
			<td><?php echo $row['reply'] ?></td>
			<td><?php echo $row['date'] ?></td>
		</tr>
	<?php } ?>
	<tbody>
	</table>
<?php } ?>


</div>
 <?php 
	if(isset($_SESSION['user'])){
 ?>
	<div>
		<form action="PostMessage.php" method="post">
			Name:  <?php echo $_SESSION['username']; ?> <br>
			Email: <?php echo $_SESSION['user'];?>
			<input type="hidden" name="postBy" value="<?php echo $_SESSION['user'];?>">
			<div class="form-inline">
				<label>Subject:&nbsp;</label>
				<input type="text" class="form-control" name="postedSubject" style="width:500px;" required>
			</div>
			<div class="form-group">
				<label>Message:</label>
				<textarea class="form-control" rows="5" id="comment" name="content" style="width:800px;" required></textarea>
			</div>
			<input type="submit" value="Post Message" class="btn btn-primary">
		</form>
	</div>
<?php } ?>
</div>

</body>


</html>