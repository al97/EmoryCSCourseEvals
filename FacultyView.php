<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		mysqli_select_db($con, "evaluationsDB");
		$instructorid = mysqli_real_escape_string($con,$_POST['InstructorID']);
		$course = mysqli_real_escape_string($con,$_POST['Course']);

		$instructorQuery = "SELECT instructorID FROM instructor WHERE instructorID = '$instructorid'";
		$courseQuery = "SELECT classNo FROM class WHERE classNo = '$course'";
		$validationQuery = "SELECT classNo FROM class WHERE instructorID = '$instructorid' AND classNo = '$course'";

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

		$result2 = mysqli_query($con, $validationQuery);
		if (!($result2 = mysqli_query($con, $validationQuery))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$count = mysqli_num_rows($result);
		$count1 = mysqli_num_rows($result1);
		$count2 = mysqli_num_rows($result2);
		

		if ($count == 1 && $count1 == 1 && $count2 == 1) {
			$s = $result->fetch_assoc();
			$c = $result1->fetch_assoc();
			$_SESSION['instructor'] = $s["instructorID"];
			$_SESSION['course'] = $c["classNo"];
         
         	header('Location: FacultyStats.php');
         	exit;
      	}

      	else if ($count == 1 && $count1 == 0) {
      		printf("Are you sure that class exists?");
      	}

      	else if ($count == 1 && $count1 == 1 && $count2 == 0) {
      		printf("Why are you sneaking a look at other teachers' evaluations? ;)");
      	}
      	
      	else {
        	printf("Error: Either that instructor doesn't exist or you got the wrong course number.");
        	
      	}

		}

	?>

<!DOCTYPE html>
<html>
<body>

<h2>Welcome to Faculty View! Enter in your class's specific number and your instructor number.</h2>

<form action="" method="post">
  Instructor<br>
  <input type="text" name="InstructorID">
  <br>
  Course Number:<br>
  <input type="text" name="Course">
  <input type="submit" value="Submit">
</form>