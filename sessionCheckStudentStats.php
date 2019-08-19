<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	session_start();

	$instructor_id = $_SESSION['instructor'];
	$instructor_class = $_SESSION['course'];
?>