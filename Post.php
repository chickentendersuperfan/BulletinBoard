<?php
// Start the session
session_start();
?>
<?php 
	function displayReplies($postID){
	 	$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "bbs";
 
		$conn = new mysqli($servername, $username, $password, $dbname);
 
		if ($conn->connect_error){
			die ("Connection failed: " . $conn->connect_error);
		}
		$sql_GetReply = "SELECT message_id, parent_id, postedBy, subject, content, date FROM postings WHERE parent_id = " . $postID;
		$result_getReply = $conn->query($sql_GetReply);
		if($result_getReply->num_rows > 0){
			while($row = $result_getReply->fetch_assoc()){
				echo "<tr>";
					echo "<td>";
						echo "<div class=\"post\">";
							$sql_GetParentPost = "SELECT message_id, postedBy, subject, content, date FROM postings WHERE message_id = " . $row['parent_id'];
							$result_GetParentPost = $conn->query($sql_GetParentPost);
							$opMessage = $result_GetParentPost->fetch_assoc();
							echo "<div class=\"row op\">";
								echo "<div class=\"col-md-4\">";
									echo "<p>Posted By: " . $opMessage['postedBy'] . " on " . $opMessage['date'] . "</p>";
								echo "</div>";
								echo "<div class=\"col-md-8\">";
									echo "<p>";
										echo "Subject:&nbsp;&nbsp;&nbsp;" . $opMessage['subject'] . "<br>";
										echo "Message:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $opMessage['content'];
									echo "</p>";

								echo "</div>";
							echo "</div>";
							echo "<br>";
							echo "<div class=\"row\" style=\"padding-left: 20px;\">";
								echo "<div class=\"col-md-4\">";
									echo "<p> Reply From: " . $row['postedBy'] . " on " . $row['date'] . "</p>";
								echo "</div>";
								echo "<div class=\"col-md-8\">";
									echo "<p>";
										echo "Subject:&nbsp;&nbsp;&nbsp;" . $row['subject'] . "<br>";
										echo "Message:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $row['content'];
									echo "</p>";
								echo "</div>";
							echo "</div>";	
						echo "</div>";
					echo "</td>";
				echo "</tr>";
				displayReplies($row['message_id']);
			}

		}
		$conn->close();
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

.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th {
   background-color: #FDEDEC;
}

.table-striped > tbody > tr:nth-child(even) > td, .table-striped > tbody > tr:nth-child(even) > th {
   background-color: #EAECEE;
}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: sticky;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


div.post{
	min-height: 100px;
	border-radius: 25px;
	padding: 10px;
}

div.op{
	border-radius: 25px;
	border: 1px;
	padding: 10px;
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
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

<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bbs";
 
	$conn = new mysqli($servername, $username, $password, $dbname);
 
	if ($conn->connect_error){
		die ("Connection failed: " . $conn->connect_error);
	}
	$sql_GetPost = "SELECT message_id, postedBy, subject, content, date FROM postings WHERE message_id = " . $_GET['PostID'];
	$result_GetPost = $conn->query($sql_GetPost);
	if($result_GetPost->num_rows > 0){
		$message = $result_GetPost->fetch_assoc();
	}

	$conn->close();

?>

<?php if($result_GetPost->num_rows > 0){ ?>
<div class="container-fluid" style="padding:10px"> 
	<div class="op" style="color:white;">
		<div class="row">
			<div class="col-md-4">
				<p>Posted By: <?php echo $message['postedBy'] . " on " . $message['date'];?></p>
			</div>
			<div class="col-md-8">
				<p>
					Subject: &nbsp;&nbsp;&nbsp; <?php echo $message['subject']; ?> <br>
					Message:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo $message['content']; ?>
				</p>
			</div>
		</div>
	</div>

	<h3><b style="color:white;">Comments</b></h3>
	<table class="table table-bordered" style="border:1px;background-color: rgba(0,0,0,0.4);color:white;">
		<tbody>
			<?php displayReplies($_GET['PostID']); ?>
		</tbody>
	</table>
</div>
<?php } ?>
 <?php 

 // Reply to the original post, but not a specific comment (yet)
	if(isset($_SESSION['user'])){
 ?>
	<div id="myModal" class="modal" style="display:none;">
		<div class="modal-content">
			<span class="close" onclick="closeForm()">&times;</span>
			<form action="Reply.php?PostID=" <?php echo $_GET['PostID']; ?> method="post">
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
				<input type="submit" value="Post Reply" class="btn btn-primary">
			</form>
		</div>
	</div>
	<div>
	<button id="buttonOpenForm" class="open-button bg-dark" onclick="openForm()">Reply</button>
	</div>
<?php } ?>
</div>

<script>
function openForm(){
	document.getElementById('myModal').style.display ="block";
	document.getElementById('divTable').style.display ="none";
	document.getElementById('buttonOpenForm').style.display ="none";
};
function closeForm(){
	document.getElementById('myModal').style.display ="none";
	document.getElementById('divTable').style.display ="block";
	document.getElementById('buttonOpenForm').style.display ="block";
};
</script>

</body>


</html>
