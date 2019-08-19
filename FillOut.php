<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
			header('Location: complete.html');
			}
			?>
<!DOCTYPE html>
<html>
<body>

<h2>Fill out your evaluation! All questions except comments are required.</h2>

<form action="" method="post">

<?php
	include("sessionCheck.php");

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	mysqli_select_db($con, "evaluationsDB");
	$questions = "SELECT b.question, b.questionType, b.questionID FROM questionBank b, questionLog l WHERE b.questionID = l.questionID AND l.classNo = '$user_class'";
		

	$result3 = mysqli_query($con, $questions);
	if (!($result3 = mysqli_query($con, $questions))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

	$count3 = mysqli_num_rows($result3);

	$yearErr = $genderErr = $classMissedErr = $majorErr = $expectedGradeErr = $reasonErr = $organizationErr = $concernErr = $gradingCriteriaErr = $enthusiasmErr = $factualKnowledgeErr = $PrinciplesAndConceptsErr = $recommendCourseErr = $recommendInstructorErr = "";

	$year = $gender = $classMissed = $major = $expectedGrade = $reason = $organization = $concern = $gradingCriteria = $enthusiasm = $factualKnowledge = $principlesAndConcepts = $recommendCourse = $recommendInstructor = $comment = $comment1 = $comment2 = $comment3 = "";

	for ($x = 0; $x < $count3; $x++) {
		while ($row = $result3->fetch_assoc()) {
				if ($row["questionID"] == "q1") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="Year" value="First">First
					<input type="radio" name="Year" value="Second">Second
					<input type="radio" name="Year" value="Third">Third
					<input type="radio" name="Year" value="Fourth">Fourth
					<input type="radio" name="Year" value="Fourth+">Fourth+
					<input type="radio" name="Year" value="Graduate">Graduate
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST['Year'])) {
							$yearErr = "Year is required";
						}
						else {
							$year = mysqli_real_escape_string($con, $_POST['Year']);
						}
					}
				}
				else if ($row["questionID"] == "q2") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="gender" value="Male">Male
					<input type="radio" name="gender" value="Female">Female
					<input type="radio" name="gender" value="Other">Other
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST['gender'])) {
							$genderErr = "Gender is required";
						}
						else {
							$gender = mysqli_real_escape_string($con, $_POST['gender']);
						}
					}
					
				}
				else if ($row["questionID"] == "q3") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="ClassMissed" value="0%">0%
					<input type="radio" name="ClassMissed" value="6-10%">6-10%
					<input type="radio" name="ClassMissed" value="11-15%">11-15%
					<input type="radio" name="ClassMissed" value="16-20%">16-20%
					<input type="radio" name="ClassMissed" value="21-25%">21-25%
					<input type="radio" name="ClassMissed" value="26-30%">26-30%
					<input type="radio" name="ClassMissed" value="31-40%">31-40%
					<input type="radio" name="ClassMissed" value="41-50%">41-50%
					<input type="radio" name="ClassMissed" value="51-60%">51-60%
					<input type="radio" name="ClassMissed" value="61-80%">61-80%
					<input type="radio" name="ClassMissed" value="81-99%">81-99%
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["ClassMissed"])) {
							$classMissedErr = "Class Missed is required";
						}
						else {
							$classMissed = mysqli_real_escape_string($con, $_POST['ClassMissed']);
						}	
					}
					
				}
				else if ($row["questionID"] == "q4") {
					echo $row["question"];
					?>
					<br>
					<select name="Major">
						<option selected="selected">Select a major</option>
						<option value="Applied Mathematics">Applied Mathematics</option>
						<option value="Applied Physics">Applied Physics</option>
						<option value="Biology">Biology</option>
						<option value="Business">Business</option>
						<option value="Business Administration">Business Administration</option>
						<option value="Chemistry">Chemistry</option>
						<option value="Computer Science">Computer Science</option>
						<option value="Economics">Economics</option>
						<option value="Economics & Mathematics">Economics &amp; Mathematics</option>
						<option value="Mathematics">Mathematics</option>
						<option value="Mathematics & Computer Science">Mathematics &amp; Computer Science</option>
						<option value="Physics">Physics</option>
						<option value="Quantitative Science">Quantitative Science</option>
						<option value="Sociology">Sociology</option>
						<option value="Undeclared">Undeclared</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["Major"]) || mysqli_real_escape_string($con,$_POST['Major']) == "Select a major") {
							$majorErr = "Major is required";
						}
						else {
							$major = mysqli_real_escape_string($con, $_POST['Major']);
						}	
					}

				}
				else if ($row["questionID"] == "q5") {
					echo $row["question"];
					?>
					<br>
					<select name="ExpectedGrade">
						<option selected="selected">Select a grade</option>
						<option value="A">A</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B">B</option>
						<option value="B-">B-</option>
						<option value="C+">C+</option>
						<option value="C">C</option>
						<option value="C-">C-</option>
						<option value="D+">D+</option>
						<option value="D">D</option>
						<option value="D-">D-</option>
						<option value="F">F</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["ExpectedGrade"]) || mysqli_real_escape_string($con,$_POST['ExpectedGrade']) == "Select a grade") {
							$expectedGradeErr = "Expected grade is required";
						}
						else {
							$expectedGrade = mysqli_real_escape_string($con, $_POST['ExpectedGrade']);
						}	
					}
					
				}
				else if ($row["questionID"] == "q6") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="ReasonTakingCourse" value="Pre-Prof Requirement">Pre-Prof Requirement
					<input type="radio" name="ReasonTakingCourse" value="Prerequisite">Prerequisite
					<input type="radio" name="ReasonTakingCourse" value="College Requirement Major">College Requirement Major
					<input type="radio" name="ReasonTakingCourse" value="Interested">Interested
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["ReasonTakingCourse"])) {
							$reasonErr = "Reason for taking course is required";
						}
						else {
							$reason = mysqli_real_escape_string($con, $_POST['ReasonTakingCourse']);
						}	
					}
					
				}
				else if ($row["questionID"] == "q7") {
					echo $row["question"];
					?>
					<br>
					<select name="Organization">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["Organization"]) || mysqli_real_escape_string($con,$_POST['Organization']) == "Select a number") {
							$organizationErr = "Organization question is required";
						}
						else {
							$organization = mysqli_real_escape_string($con, $_POST["Organization"]);
						}	
					}
					
				}
				else if ($row["questionID"] == "q8") {
					echo $row["question"];
					?>
					<br>
					<select name="Concern">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["Concern"]) || mysqli_real_escape_string($con,$_POST['Concern']) == "Select a number") {
							$concernErr = "Concern question is required";
						}
						else {
							$concern = mysqli_real_escape_string($con, $_POST["Concern"]);
						}	
					}
					
				}
				else if ($row["questionID"] == "q9") {
					echo $row["question"];
					?>
					<br>
					<select name="GradingCriteria">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["GradingCriteria"]) || mysqli_real_escape_string($con,$_POST['GradingCriteria']) == "Select a number") {
							$gradingCriteriaErr = "Grading Criteria question is required";
						}
						else {
							$gradingCriteria = mysqli_real_escape_string($con, $_POST["GradingCriteria"]);
						}	
					}
					
				}
				else if ($row["questionID"] == "q10") {
					echo $row["question"];
					?>
					<br>
					<select name="Enthusiasm">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["Enthusiasm"]) || mysqli_real_escape_string($con,$_POST['Enthusiasm']) == "Select a number") {
							$enthusiasmErr = "Enthusiasm question is required";
						}
						else {
							$enthusiasm = mysqli_real_escape_string($con, $_POST["Enthusiasm"]);
						}	
					}
					
				}
				else if ($row["questionID"] == "q11") {
					echo $row["question"];
					?>
					<br>
					<select name="FactualKnowledge">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["FactualKnowledge"]) || mysqli_real_escape_string($con,$_POST['FactualKnowledge']) == "Select a number") {
								$factualKnowledgeErr = "Factual Knowledge question is required";
							}
							else {
								$factualKnowledge = mysqli_real_escape_string($con, $_POST["FactualKnowledge"]);
							}	
						}
				}
				else if ($row["questionID"] == "q12") {
					echo $row["question"];
					?>
					<br>
					<select name="PrinciplesAndConcepts">
						<option selected="selected">Select a number</option>
						<option value="10">10</option>
						<option value="9">9</option>
						<option value="8">8</option>
						<option value="7">7</option>
						<option value="6">6</option>
						<option value="5">5</option>
						<option value="4">4</option>
						<option value="3">3</option>
						<option value="2">2</option>
						<option value="1">1</option>
					</select>
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["PrinciplesAndConcepts"]) || mysqli_real_escape_string($con,$_POST['PrinciplesAndConcepts']) == "Select a number") {
								$principlesAndConceptsErr = "Principles and concepts question is required";
							}
							else {
								$principlesAndConcepts = mysqli_real_escape_string($con, $_POST["PrinciplesAndConcepts"]);
							}	
						}
						
				}
				else if ($row["questionID"] == "q13") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="RecommendCourse" value="StronglyAgree">Strongly Agree
					<input type="radio" name="RecommendCourse" value="Agree">Agree
					<input type="radio" name="RecommendCourse" value="Neutral">Neutral
					<input type="radio" name="RecommendCourse" value="Disagree">Disagree
					<input type="radio" name="RecommendCourse" value="Strongly Disagree">Strongly Disagree
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["RecommendCourse"])) {
								$recommendCourseErr = "Recommend course question is required";
							}
							else {
								$recommendCourse = mysqli_real_escape_string($con, $_POST["RecommendCourse"]);
							}	
						}
					
				}
				else if ($row["questionID"] == "q14") {
					echo $row["question"];
					?>
					<br>
					<input type="radio" name="RecommendInstructor" value="StronglyAgree">Strongly Agree
					<input type="radio" name="RecommendInstructor" value="Agree">Agree
					<input type="radio" name="RecommendInstructor" value="Neutral">Neutral
					<input type="radio" name="RecommendInstructor" value="Disagree">Disagree
					<input type="radio" name="RecommendInstructor" value="Strongly Disagree">Strongly Disagree
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["RecommendInstructor"])) {
								$recommendInstructorErr = "Recommend instructor question is required";
							}
							else {
								$recommendInstructor = mysqli_real_escape_string($con, $_POST["RecommendInstructor"]);
							}	
						}
						
				}
				else if ($row["questionID"] == "q15") {
					echo $row["question"];
					?>
					<br>
					<input type="text" name="comment">
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["comment"])) {
								$comment = "";
							}
							else {
								$comment = mysqli_real_escape_string($con, $_POST["comment"]);
							}	
						}
						
				}
				else if ($row["questionID"] == "q16") {
					echo $row["question"];
					?>
					<br>
					<input type="text" name="comment1">
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["comment1"])) {
								$comment1 = "";
							}
							else {
								$comment1 = mysqli_real_escape_string($con, $_POST["comment1"]);
							}	
						}
					
				}
				else if ($row["questionID"] == "q17") {
					echo $row["question"];
					?>
					<br>
					<input type="text" name="comment2">
					<br>
					<br>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["comment2"])) {
								$comment2 = "";
							}
							else {
								$comment2 = mysqli_real_escape_string($con, $_POST["comment2"]);
							}	
						}
						
					
				}
				else if ($row["questionID"] == "q18") {
					echo $row["question"];
					?>
					<br>
					<input type="text" name="comment3">
					<br>
					<br>
					
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["comment3"])) {
								$comment3 = "";
							}
							else {
								$comment3 = mysqli_real_escape_string($con, $_POST["comment3"]);
							}	
						}
					
					
				}
				
			}	
		}
		?>
		<input type="submit" value="Submit">
		</form>
		<?php
		$eval = "SELECT evalCheck FROM evaluationCheck WHERE studentID = '$user_id' AND classNo = '$user_class' AND evalCheck = 1";
		$evalResult = mysqli_query($con, $eval);
		if (!($result2 = mysqli_query($con, $eval))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}
		$count10 = mysqli_num_rows($evalResult);
		if ($count10 == 1) {
			printf("You have already filled out an evaluation!! How did you access this page? Any info you fill out here will not be added to the database.");
		}

		else {
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if ($year != "" && $gender != "" && $classMissed != "" && $major != "" && $expectedGrade != "" && $reason != "" && $organization != "" && $concern != "" && $gradingCriteria != "" && $enthusiasm != "" && $factualKnowledge != "" && $principlesAndConcepts != "" && $recommendCourse != "" && $recommendInstructor != "") {

					$yearQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q1', '$year')";
					$genderQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q2', '$gender')";
					$classMissedQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q3', '$classMissed')";
					$majorQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q4', '$major')";
					$expectedGradeQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q5', '$expectedGrade')";
					$organizationQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q7', '$organization')";
					$concernQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q8', '$concern')";
					$gradingCriteriaQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q9', '$gradingCriteria')";
					$reasonQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q6', '$reason')";
					$enthusiasmQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q10', '$enthusiasm')";
					$factualKnowledgeQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q11', '$factualKnowledge')";
					$principlesAndConceptsQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q12', '$principlesAndConcepts')";
					$recommendCourseQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q13', '$recommendCourse')";
					$recommendInstructorQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q14', '$recommendInstructor')";

					if (!(mysqli_query($con, $yearQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $genderQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $classMissedQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $majorQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $expectedGradeQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $reasonQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $organizationQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $concernQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $gradingCriteriaQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $enthusiasmQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $factualKnowledgeQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $principlesAndConceptsQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $recommendCourseQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if (!(mysqli_query($con, $recommendInstructorQuery))) {
						printf("Error: %s\n", mysqli_error($con));
						exit(1);
					}

					if ($comment != "") {
						$commentQuery = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q15', '$comment')";
						if (!(mysqli_query($con, $commentQuery))) {
							printf("Error: %s\n", mysqli_error($con));
							exit(1);
						}
					}
					if ($comment1 != "") {
						$comment1Query = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q16', '$comment1')";
						if (!(mysqli_query($con, $comment1Query))) {
							printf("Error: %s\n", mysqli_error($con));
							exit(1);
						}
					}
					if ($comment2 != "") {
						$comment2Query = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q17', '$comment2')";
						if (!(mysqli_query($con, $comment2Query))) {
							printf("Error: %s\n", mysqli_error($con));
							exit(1);
						}
					}

					if ($comment3 != "") {
						$comment3Query = "INSERT INTO qa VALUES('$user_id', '$user_class', 'q18', '$comment3')";
						if (!(mysqli_query($con, $comment3Query))) {
							printf("Error: %s\n", mysqli_error($con));
							exit(1);
						}
					}

					$evalCheckQuery = "UPDATE evaluationCheck SET evalCheck = 1 WHERE studentID = '$user_id'";
					if (!(mysqli_query($con, $evalCheckQuery))) {
							printf("Error: %s\n", mysqli_error($con));
							exit(1);
						}

					

				}

				else {
					if ($year == "") {
						echo $yearErr;
						echo"<br>";
					}
					if ($gender == "") {
						echo $genderErr;
						echo"<br>";
					}
					if ($classMissed == "") {
						echo $classMissedErr;
						echo"<br>";
					}
					if ($major == "") {
						echo $majorErr;
						echo"<br>";
					}
					if ($expectedGrade == "") {
						echo $expectedGradeErr;
						echo"<br>";
					}
					if ($reason == "") {
						echo $reasonErr;
						echo"<br>";
					}
					if ($organization == "") {
						echo $organizationErr;
						echo"<br>";
					}
					if ($concern == "") {
						echo $concernErr;
						echo"<br>";
					}
					if ($gradingCriteria == "") {
						echo $gradingCriteriaErr;
						echo"<br>";
					}
					if ($enthusiasm == "") {
						echo $enthusiasmErr;
						echo"<br>";
					}
					if ($factualKnowledge == "") {
						echo $factualKnowledgeErr;
						echo"<br>";
					}
					if ($principlesAndConcepts == "") {
						echo $principlesAndConceptsErr;
						echo"<br>";
					}
					if ($recommendCourse == "") {
						echo $recommendCourseErr;
						echo"<br>";
					}
					if ($recommendInstructor == "") {
						echo $recommendInstructorErr;
						echo"<br>";
					}

				}

				

			}

		}

				
		

	?>
