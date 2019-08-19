<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$query = 'SELECT ClassID FROM student WHERE StudentID = $_POST["ID"]';
		$result = mysqli_query($con, $query);
		if (!($result = mysqli_query($con, $query))) {
			printf("Error: %s\n", mysqli_error($conn));
			exit(1);
		}

		$count = mysqli_num_rows($result);
		

		if ($count == 1) {
			session_register("myusername");
         	$_SESSION['login_user'] = $myusername;
         
         	header("location: welcome.php");
      		}	else {
         $error = "Your Login Name or Password is invalid";
      	}

		}

	?>

<!DOCTYPE html>
<html>
<body>

<h2>Here you can check which courses you have and have not completed evaluations for. Only classes you have taken appear.</h2>

<form action="/Evaluations.php" method="post">
  Courses:<br>
  <select name="courses">
  	<option value=$
</form>

