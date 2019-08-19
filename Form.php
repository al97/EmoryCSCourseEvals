<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	session_start();

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		mysqli_select_db($con, "evaluationsDB");
		$studentID = mysqli_real_escape_string($con,$_POST['ID']);
		$classNo = mysqli_real_escape_string($con,$_POST['Course']);

		$student = "SELECT studentID FROM student WHERE studentID = '$studentID'";
		$class = "SELECT classNo FROM evaluationCheck WHERE studentID = '$studentID' AND classNo = '$classNo'";
		$eval = "SELECT evalCheck FROM evaluationCheck WHERE studentID = '$studentID' AND classNo = '$classNo' AND evalCheck = 1";

		$result = mysqli_query($con, $student);
		if (!($result = mysqli_query($con, $student))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$result1 = mysqli_query($con, $class);
		if (!($result1 = mysqli_query($con, $class))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$result2 = mysqli_query($con, $eval);
		if (!($result2 = mysqli_query($con, $eval))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

		$count = mysqli_num_rows($result);
		$count1 = mysqli_num_rows($result1);
		$count2 = mysqli_num_rows($result2);
		

		if ($count == 1 && $count1 == 1 && $count2 == 0) {
			$s = $result->fetch_assoc();
			$c = $result1->fetch_assoc();
			$_SESSION['user'] = $s["studentID"];
			$_SESSION['class'] = $c["classNo"];
         
         	header('Location: FillOut.php');
         	exit;
      	}	
      	else if ($count == 1 && $count1 == 0) {
      		printf("Error: Your user ID exists but you have not taken this class, or the class number does not exist.");
      		
      	}
      	else if ($count == 1 && $count1 == 1 && $count2 == 1) {
      		printf("Error: You have already filled out an evaluation for this class!");
      	}
      	else {
        	printf("Error: Either your user ID is invalid or that class number doesn't exist.");
        	
      	}

		}

	?>

<!DOCTYPE html>
<html>
<body>

<h2>Welcome to Evaluations! Please sign in.</h2>

<form action="" method="post">
  ID:<br>
  <input type="text" name="ID">
  <br>
  Course Number:<br>
  <input type="text" name="Course">
  <input type="submit" value="Submit">
</form>