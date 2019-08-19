<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		mysqli_select_db($con, "evaluationsDB");
		$instructorFname = mysqli_real_escape_string($con,$_POST['InstructorFname']);
		$instructorLname = mysqli_real_escape_string($con,$_POST['InstructorLname']);
		$course = mysqli_real_escape_string($con,$_POST['Course']);

		$instructorQuery = "SELECT instructorID FROM instructor WHERE instructorFname = '$instructorFname' AND instructorLname = '$instructorLname'";
		$courseQuery = "SELECT courseNo FROM class WHERE courseNo = '$course'";

		$result = mysqli_query($con, $instructorQuery);
		if (!($result = mysqli_query($con, $instructorQuery))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$result1 = mysqli_query($con, $courseQuery);
		if (!($result1 = mysqli_query($con, $courseQuery))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$count = mysqli_num_rows($result);
		$count1 = mysqli_num_rows($result1);
		

		if ($count == 1 && $count1 >= 1) {
			$s = $result->fetch_assoc();
			$c = $result1->fetch_assoc();
			$_SESSION['instructor'] = $s["instructorID"];
			$_SESSION['course'] = $c["courseNo"];
         
         	header('Location: StudentStats.php');
         	exit;
      	}	
      	
      	else {
        	printf("Error: Either that instructor doesn't exist or you got the wrong course number.");
        	
      	}

		}

	?>

<!DOCTYPE html>
<html>
<body>

<h2>Welcome to Student View! Which class and instructor do you want stats for?</h2>

<form action="" method="post">
  Instructor First Name and Last Name:<br>
  <input type="text" name="InstructorFname">
  <input type="text" name="InstructorLname">
  <br>
  Course Number:<br>
  <input type="text" name="Course">
  <input type="submit" value="Submit">
</form>