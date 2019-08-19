<?php

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	session_start();

	$user_id = $_SESSION['user'];
	$user_class = $_SESSION['class'];
?>