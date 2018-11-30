<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>

</head>

<body>
<?php
	if( $_SERVER['REQUEST_METHOD'] == 'POST'){
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 

		header("Location: http://localhost/BulletinBoard/Board.php"); 
		exit();
	}

?>
 
</body>


</html>
