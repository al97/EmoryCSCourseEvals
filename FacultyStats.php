<!DOCTYPE html>
<html>
<body>

<h2>Here are the statistics for this course.</h2>

<?php
	include("sessionCheckFacultyStats.php");

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	mysqli_select_db($con, "evaluationsDB");
	$agreeStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.classNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = '5AD'";

	$mcStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.classNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = 'MC'";

	$numberStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.classNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = '10Scale'";

	$textResponses = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.classNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = 'text'";

	$agreeQuery = mysqli_query($con, $agreeStats);
	if (!($agreeQuery = mysqli_query($con, $agreeStats))) {
			printf("Agree Error: %s\n", mysqli_error($con));
			exit(1);
		}

	$mcQuery = mysqli_query($con, $mcStats);
	if (!($mcQuery = mysqli_query($con, $mcStats))) {
			printf("MC Error: %s\n", mysqli_error($con));
			exit(1);
		}

	$numberQuery = mysqli_query($con, $numberStats);
	if (!($numberQuery = mysqli_query($con, $numberStats))) {
			printf("Error: %s\n", mysqli_error($con));
			exit(1);
		}

	$textQuery = mysqli_query($con, $textResponses);
	if (!($textQuery = mysqli_query($con, $textResponses))) {
		printf("Error: %s\n", mysqli_error($con));
		exit(1);
	}

	$count3 = mysqli_num_rows($numberQuery);
	$count4 = mysqli_num_rows($agreeQuery);
	$count5 = mysqli_num_rows($mcQuery);
	$count6 = mysqli_num_rows($textQuery);

	$year = $yearFirst = $yearSecond = $yearThird = $yearFourth = $yearFourth1 = $yearGrad = $gender = $genderMale = $genderFemale = $classMissed = $classMissed0 = $classMissed5 = $classMissed10 = $classMissed15 = $classMissed20 = $classMissed25 = $classMissed30 = $classMissed40 = $classMissed50 = $classMissed60 = $classMissed80 = $classMissed99 = $major = $appliedMath = $appliedPhys = $biology = 0;

	$business = $businessAd = $chem = $compsci = $econ = $econmath = $math = $mathcs = $phys = $quant = $sociology = $undeclared = $expectedGrade = $reason = $organization = $concern = $gradingCriteria = $enthusiasm = $factualKnowledge = $principlesAndConcepts = $recommendCourse = $recommendInstructor = 0;

	$A = $Aminus = $Bplus = $B = $Bminus = $Cplus = $C = $Cminus = $Dplus = $D = $Dminus = $F = $preprof = $prereq = $req = $interested = 0;

	$one1 = $one2 = $one3 = $one4 = $one5 = $one6 = $one7 = $one8 = $one9 = $one10 = 0;
	$two1 = $two2 = $two3 = $two4 = $two5 = $two6 = $two7 = $two8 = $two9 = $two10 = 0;
	$three1 = $three2 = $three3 = $three4 = $three5 = $three6 = $three7 = $three8 = $three9 = $three10 = 0;
	$four1 = $four2 = $four3 = $four4 = $four5 = $four6 = $four7 = $four8 = $four9 = $four10 = 0;
	$five1 = $five2 = $five3 = $five4 = $five5 = $five6 = $five7 = $five8 = $five9 = $five10 = 0;
	$six1 = $six2 = $six3 = $six4 = $six5 = $six6 = $six7 = $six8 = $six9 = $six10 = 0;

	$recommendCourseAgree = $recommendCourseSAgree = $recommendCourseNeutral = $recommendCourseDisagree = $recommendcourseSDisagree = 0;
	$recommendInstructorAgree = $recommendInstructorSAgree = $recommendInstructorNeutral = $recommendInstructorDisagree = $recommendInstructorSDisagree = 0;

		$yearCount = $genderCount = $classMissedCount = $majorCount = $expectedGradeCount = $reasonCount = $organizationCount = $concernCount = $gradingCriteriaCount = $enthusiasmCount = $factualKnowledgeCount = $principlesAndConceptsCount = $recommendCourseCount = $recommendInstructorCount = 0;

	for ($x = 0; $x < $count3; $x++) {
		while ($row = $numberQuery->fetch_assoc()) {
			if ($row["questionID"] == "q7") {
				$organizationQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$one1++;
				}
				else if ((int)$row["answer"] == 2) {
					$one2++;
				}
				else if ((int)$row["answer"] == 3) {
					$one3++;
				}
				else if ((int)$row["answer"] == 4) {
					$one4++;
				}
				else if ((int)$row["answer"] == 5) {
					$one5++;
				}
				else if ((int)$row["answer"] == 6) {
					$one6++;
				}
				else if ((int)$row["answer"] == 7) {
					$one7++;
				}
				else if ((int)$row["answer"] == 8) {
					$one8++;
				}
				else if ((int)$row["answer"] == 9) {
					$one9++;
				}
				else if ((int)$row["answer"] == 10) {
					$one10++;
				}
				$oneArray = array($one1, $one2, $one3, $one4, $one5, $one6, $one7, $one8, $one9, $one10);
				$onemax = (max($oneArray));
				for ($i = 0; $i < 10; $i++) {
					if ($oneArray[$i] == $onemax) {
						$onemedian = $i + 1;
					}
				}
				$organizationCount++;
			}
			else if ($row["questionID"] == "q8") {
				$concernQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$two1++;
				}
				else if ((int)$row["answer"] == 2) {
					$two2++;
				}
				else if ((int)$row["answer"] == 3) {
					$two3++;
				}
				else if ((int)$row["answer"] == 4) {
					$two4++;
				}
				else if ((int)$row["answer"] == 5) {
					$two5++;
				}
				else if ((int)$row["answer"] == 6) {
					$two6++;
				}
				else if ((int)$row["answer"] == 7) {
					$two7++;
				}
				else if ((int)$row["answer"] == 8) {
					$two8++;
				}
				else if ((int)$row["answer"] == 9) {
					$two9++;
				}
				else if ((int)$row["answer"] == 10) {
					$two10++;
				}
				$twoArray = array($two1, $two2, $two3, $two4, $two5, $two6, $two7, $two8, $two9, $two10);
				$twomax = (max($twoArray));
				for ($i = 0; $i < 10; $i++) {
					if ($twoArray[$i] == $twomax) {
						$twomedian = $i + 1;
					}
				}
				$concernCount++;
			}
			else if ($row["questionID"] == "q9") {
				$gradingCriteriaQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$three1++;
				}
				else if ((int)$row["answer"] == 2) {
					$three2++;
				}
				else if ((int)$row["answer"] == 3) {
					$three3++;
				}
				else if ((int)$row["answer"] == 4) {
					$three4++;
				}
				else if ((int)$row["answer"] == 5) {
					$three5++;
				}
				else if ((int)$row["answer"] == 6) {
					$three6++;
				}
				else if ((int)$row["answer"] == 7) {
					$three7++;
				}
				else if ((int)$row["answer"] == 8) {
					$three8++;
				}
				else if ((int)$row["answer"] == 9) {
					$three9++;
				}
				else if ((int)$row["answer"] == 10) {
					$three10++;
				}
				$threeArray = array($three1, $three2, $three3, $three4, $three5, $three6, $three7, $three8, $three9, $three10);
				$threemax = (max($threeArray));
				for ($i = 0; $i < 10; $i++) {
					if ($threeArray[$i] == $threemax) {
						$threemedian = $i + 1;
					}
				}
				$gradingCriteriaCount++;
			}
			else if ($row["questionID"] == "q10") {
				$enthusiasmQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$four1++;
				}
				else if ((int)$row["answer"] == 2) {
					$four2++;
				}
				else if ((int)$row["answer"] == 3) {
					$four3++;
				}
				else if ((int)$row["answer"] == 4) {
					$four4++;
				}
				else if ((int)$row["answer"] == 5) {
					$four5++;
				}
				else if ((int)$row["answer"] == 6) {
					$four6++;
				}
				else if ((int)$row["answer"] == 7) {
					$four7++;
				}
				else if ((int)$row["answer"] == 8) {
					$four8++;
				}
				else if ((int)$row["answer"] == 9) {
					$four9++;
				}
				else if ((int)$row["answer"] == 10) {
					$four10++;
				}
				$fourArray = array($four1, $four2, $four3, $four4, $four5, $four6, $four7, $four8, $four9, $four10);
				$fourmax = (max($fourArray));
				for ($i = 0; $i < 10; $i++) {
					if ($fourArray[$i] == $fourmax) {
						$fourmedian = $i + 1;
					}
				}
				$enthusiasmCount++;
			}
			else if ($row["questionID"] == "q11") {
				$factualKnowledgeQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$five1++;
				}
				else if ((int)$row["answer"] == 2) {
					$five2++;
				}
				else if ((int)$row["answer"] == 3) {
					$five3++;
				}
				else if ((int)$row["answer"] == 4) {
					$five4++;
				}
				else if ((int)$row["answer"] == 5) {
					$five5++;
				}
				else if ((int)$row["answer"] == 6) {
					$five6++;
				}
				else if ((int)$row["answer"] == 7) {
					$five7++;
				}
				else if ((int)$row["answer"] == 8) {
					$five8++;
				}
				else if ((int)$row["answer"] == 9) {
					$five9++;
				}
				else if ((int)$row["answer"] == 10) {
					$five10++;
				}
				$fiveArray = array($five1, $five2, $five3, $five4, $five5, $five6, $five7, $five8, $five9, $five10);
				$fivemax = (max($fiveArray));
				for ($i = 0; $i < 10; $i++) {
					if ($fiveArray[$i] == $fivemax) {
						$fivemedian = $i + 1;
					}
				}
				$factualKnowledgeCount++;
			}
			else if ($row["questionID"] == "q12") {
				$principlesAndConceptsQ = $row["question"];
				if ((int)$row["answer"] == 1) {
					$six1++;
				}
				else if ((int)$row["answer"] == 2) {
					$six2++;
				}
				else if ((int)$row["answer"] == 3) {
					$six3++;
				}
				else if ((int)$row["answer"] == 4) {
					$six4++;
				}
				else if ((int)$row["answer"] == 5) {
					$six5++;
				}
				else if ((int)$row["answer"] == 6) {
					$six6++;
				}
				else if ((int)$row["answer"] == 7) {
					$six7++;
				}
				else if ((int)$row["answer"] == 8) {
					$six8++;
				}
				else if ((int)$row["answer"] == 9) {
					$six9++;
				}
				else if ((int)$row["answer"] == 10) {
					$six10++;
				}
				$sixArray = array($six1, $six2, $six3, $six4, $six5, $six6, $six7, $six8, $six9, $six10);
				$sixmax = (max($sixArray));
				for ($i = 0; $i < 10; $i++) {
					if ($sixArray[$i] == $sixmax) {
						$sixmedian = $i + 1;
					}
				}
				$principlesAndConceptsCount++;
			}
		}
	}
	?>
	<body>1-10 Question Statistics:</body>
	<br>
	<br>
	<?php
	if ($organizationCount != 0) {
		echo $organizationQ;
		echo "<br>";
		echo "1: ";
		echo $one1;
		echo "<br>";
		echo "2: ";
		echo $one2;
		echo "<br>";
		echo "3: ";
		echo $one3;
		echo "<br>";
		echo "4: ";
		echo $one4;
		echo "<br>";
		echo "5: ";
		echo $one5;
		echo "<br>";
		echo "6: "; 
		echo $one6;
		echo "<br>";
		echo "7: "; 
		echo $one7;
		echo "<br>";
		echo "8: ";
		echo $one8;
		echo "<br>";
		echo "9: ";
		echo $one9;
		echo "<br>";
		echo "10: ";
		echo $one10;
		echo "<br>";
		echo "Median: ";
		echo $onemedian;
		echo "<br>";
		echo "Median count: ";
		echo $onemax;

	}
	echo "<br>";
	echo "<br>";
	if ($concernCount != 0) {
		echo $concernQ;
		echo "<br>";
		echo "1: ";
		echo $two1;
		echo "<br>";
		echo "2: ";
		echo $two2;
		echo "<br>";
		echo "3: ";
		echo $two3;
		echo "<br>";
		echo "4: ";
		echo $two4;
		echo "<br>";
		echo "5: ";
		echo $two5;
		echo "<br>";
		echo "6: "; 
		echo $two6;
		echo "<br>";
		echo "7: "; 
		echo $two7;
		echo "<br>";
		echo "8: ";
		echo $two8;
		echo "<br>";
		echo "9: ";
		echo $two9;
		echo "<br>";
		echo "10: ";
		echo $two10;
		echo "<br>";
		echo "Median: ";
		echo $twomedian;
		echo "<br>";
		echo "Median count: ";
		echo $twomax;
	}
	echo "<br>";
	echo "<br>";
	if ($gradingCriteriaCount != 0) {
		echo $gradingCriteriaQ;
		echo "<br>";
		echo "1: ";
		echo $three1;
		echo "<br>";
		echo "2: ";
		echo $three2;
		echo "<br>";
		echo "3: ";
		echo $three3;
		echo "<br>";
		echo "4: ";
		echo $three4;
		echo "<br>";
		echo "5: ";
		echo $three5;
		echo "<br>";
		echo "6: "; 
		echo $three6;
		echo "<br>";
		echo "7: "; 
		echo $three7;
		echo "<br>";
		echo "8: ";
		echo $three8;
		echo "<br>";
		echo "9: ";
		echo $three9;
		echo "<br>";
		echo "10: ";
		echo $three10;
		echo "<br>";
		echo "Median: ";
		echo $threemedian;
		echo "<br>";
		echo "Median count: ";
		echo $threemax;
	}
	echo "<br>";
	echo "<br>";
	if ($enthusiasmCount != 0) {
		echo $enthusiasmQ;
		echo "<br>";
		echo "1: ";
		echo $four1;
		echo "<br>";
		echo "2: ";
		echo $four2;
		echo "<br>";
		echo "3: ";
		echo $four3;
		echo "<br>";
		echo "4: ";
		echo $four4;
		echo "<br>";
		echo "5: ";
		echo $four5;
		echo "<br>";
		echo "6: "; 
		echo $four6;
		echo "<br>";
		echo "7: "; 
		echo $four7;
		echo "<br>";
		echo "8: ";
		echo $four8;
		echo "<br>";
		echo "9: ";
		echo $four9;
		echo "<br>";
		echo "10: ";
		echo $four10;
		echo "<br>";
		echo "Median: ";
		echo $fourmedian;
		echo "<br>";
		echo "Median count: ";
		echo $fourmax;
	}
	echo "<br>";
	echo "<br>";
	if ($factualKnowledgeCount != 0) {
		echo $factualKnowledgeQ;
		echo "<br>";
		echo "1: ";
		echo $five1;
		echo "<br>";
		echo "2: ";
		echo $five2;
		echo "<br>";
		echo "3: ";
		echo $five3;
		echo "<br>";
		echo "4: ";
		echo $five4;
		echo "<br>";
		echo "5: ";
		echo $five5;
		echo "<br>";
		echo "6: "; 
		echo $five6;
		echo "<br>";
		echo "7: "; 
		echo $five7;
		echo "<br>";
		echo "8: ";
		echo $five8;
		echo "<br>";
		echo "9: ";
		echo $five9;
		echo "<br>";
		echo "10: ";
		echo $five10;
		echo "<br>";
		echo "Median: ";
		echo $fivemedian;
		echo "<br>";
		echo "Median count: ";
		echo $fivemax;
	}
	echo "<br>";
	echo "<br>";
	if ($principlesAndConceptsCount != 0) {
		echo $principlesAndConceptsQ;
		echo "<br>";
		echo "1: ";
		echo $six1;
		echo "<br>";
		echo "2: ";
		echo $six2;
		echo "<br>";
		echo "3: ";
		echo $six3;
		echo "<br>";
		echo "4: ";
		echo $six4;
		echo "<br>";
		echo "5: ";
		echo $six5;
		echo "<br>";
		echo "6: "; 
		echo $six6;
		echo "<br>";
		echo "7: "; 
		echo $six7;
		echo "<br>";
		echo "8: ";
		echo $six8;
		echo "<br>";
		echo "9: ";
		echo $six9;
		echo "<br>";
		echo "10: ";
		echo $six10;
		echo "<br>";
		echo "Median: ";
		echo $sixmedian;
		echo "<br>";
		echo "Median count: ";
		echo $sixmax;
	}

	echo "<br>";
	echo "<br>";

	for ($x = 0; $x < $count4; $x++) {
		while ($row = $agreeQuery->fetch_assoc()) {
			if ($row["questionID"] == "q13") {
				if ($row["answer"] == "Agree") {
					$recommendCourseAgree++;
				}
				else if	($row["answer"] == "Strongly Agree") {
					$recommendCourseSAgree++;
				}
				else if ($row["answer"] == "Neutral") {
					$recommendCourseNeutral++;
				}
				else if ($row["answer"] == "Disagree") {
					$recommendCourseDisagree++;
				}
				else if ($row["answer"] == "Disagree") {
					$recommendcourseSDisagree++;
				}
				$recommendCourseAgreeQ = $row["question"];
				$recommendCourseCount++;
			}
			else if ($row["questionID"] == "q14") {
				if ($row["answer"] == "Agree") {
					$recommendInstructorAgree++;
				}
				else if	($row["answer"] == "Strongly Agree") {
					$recommendInstructorSAgree++;
				}
				else if ($row["answer"] == "Neutral") {
					$recommendInstructorNeutral++;
				}
				else if ($row["answer"] == "Disagree") {
					$recommendInstructorDisagree++;
				}
				else if ($row["answer"] == "Disagree") {
					$recommendInstructorSDisagree++;
				}
				$recommendInstructorAgreeQ = $row["question"];
				$recommendInstructorCount++;
			}
		}
	}
	?>
	<body>Agree/Disagree Question Statistics:</body>
	<br>
	<br>
	<?php
	if ($recommendCourseCount != 0) {
		echo $recommendCourseAgreeQ;
		echo "<br>";
		echo "Strongly Agree: ";
		echo $recommendCourseSAgree;
		echo "<br>";
		echo "Agree: ";
		echo $recommendCourseAgree;
		echo "<br>";
		echo "Neutral: ";
		echo $recommendCourseNeutral;
		echo "<br>";
		echo "Disagree: ";
		echo $recommendCourseDisagree;
		echo "<br>";
		echo "Strongly Disagree: ";
		echo $recommendcourseSDisagree;
		echo "<br>";
	}
	echo "<br>";
	echo "<br>";
	if ($recommendInstructorCount != 0) {
		echo $recommendInstructorAgreeQ;
		echo "<br>";
		echo "Strongly Agree: ";
		echo $recommendInstructorSAgree;
		echo "<br>";
		echo "Agree: ";
		echo $recommendInstructorAgree;
		echo "<br>";
		echo "Neutral: ";
		echo $recommendInstructorNeutral;
		echo "<br>";
		echo "Disagree: ";
		echo $recommendInstructorDisagree;
		echo "<br>";
		echo "Strongly Disagree: ";
		echo $recommendInstructorSDisagree;
		echo "<br>";
	}
	echo "<br>";
	echo "<br>";

	for ($x = 0; $x < $count5; $x++) {
		while ($row = $mcQuery->fetch_assoc()) {
			if ($row["questionID"] == "q1") {
				$yearFirstA = "First";
				$yearSecondA = "Second";
				$yearThirdA = "Third";
				$yearFourthA = "Fourth";
				$yearFourth1A = "Fourth+";
				$yearGradA = "Graduate";
				if ($row["answer"] == "First") {
					$yearFirst++;
				}
				else if ($row["answer"] == "Second" || $row["answer"] == "Sophomore") {
					$yearSecond++;
				}
				else if ($row["answer"] == "Third") {
					$yearThird++;
				}
				else if ($row["answer"] == "Fourth") {
					$yearFourth++;
				}
				else if ($row["answer"] == "Fourth+") {
					$yearFourth1++;
				}
				else if ($row["answer"] == "Graduate") {
					$yearGrad++;
				}
				$yearQ = $row["question"];
				$yearCount++;
			}
			else if ($row["questionID"] == "q2") {
				$genderMaleA = "Male";
				$genderFemaleA = "Female";
				if ($row["answer"] == "Male") {
					$genderMale++;
				}
				if ($row["answer"] == "Female") {
					$genderFemale++;
				}
				$genderQ = $row["question"];
				$genderCount++;
			}
			else if ($row["questionID"] == "q3") {
				$classMissed0A = "0%";
				$classMissed5A = "1-5%";
				$classMissed10A = "6-10%";
				$classMissed15A = "11-15%";
				$classMissed20A = "16-20%";
				$classMissed25A = "21-25%";
				$classMissed30A = "26-30%";
				$classMissed40A = "31-40%";
				$classMissed50A = "41-50%";
				$classMissed60A = "51-60%";
				$classMissed80A = "61-80%";
				$classMissed99A = "81-99%";


				if ($row["answer"] == "0%") {
					$classMissed0++;
				}
				else if ($row["answer"] == "1-5%") {
					$classMissed5++;
				}
				else if ($row["answer"] == "6-10%") {
					$classMissed10++;
				}
				else if ($row["answer"] == "11-15%") {
					$classMissed15++;
				}
				else if ($row["answer"] == "16-20%") {
					$classMissed20++;
				}
				else if ($row["answer"] == "21-25%") {
					$classMissed25++;
				}
				else if ($row["answer"] == "26-30%") {
					$classMissed30++;
				}
				else if ($row["answer"] == "31-40%") {
					$classMissed40++;
				}
				else if ($row["answer"] == "41-50%") {
					$classMissed50++;
				}
				else if ($row["answer"] == "51-60%") {
					$classMissed60++;
				}
				else if ($row["answer"] == "61-80%") {
					$classMissed80++;
				}
				else if ($row["answer"] == "81-99%") {
					$classMissed99++;
				}
				$classMissedQ = $row["question"];
				$classMissedCount++;
			}
			else if ($row["questionID"] == "q4") {
				if ($row["answer"] == "Applied Mathematics") {
					$appliedMath++;
				}
				else if ($row["answer"] == "Applied Physics") {
					$appliedPhys++;
				}
				else if ($row["answer"] == "Biology") {
					$biology++;
				}
				else if ($row["answer"] == "Business") {
					$business++;
				}
				else if ($row["answer"] == "Business Administration") {
					$businessAd++;
				}
				else if ($row["answer"] == "Chemistry") {
					$chem++;
				}
				else if ($row["answer"] == "Computer Science") {
					$compsci++;
				}
				else if ($row["answer"] == "Economics") {
					$econ++;
				}
				else if ($row["answer"] == "Economics & Mathematics") {
					$econmath++;
				}
				else if ($row["answer"] == "Mathematics") {
					$math++;
				}
				else if ($row["answer"] == "Mathematics & Computer Science") {
					$mathcs++;
				}
				else if ($row["answer"] == "Physics") {
					$phys++;
				}
				else if ($row["answer"] == "Quantitative Science") {
					$quant++;
				}
				else if ($row["answer"] == "Sociology") {
					$sociology++;
				}
				else if ($row["answer"] == "Undeclared") {
					$undeclared++;
				}
				$majorQ = $row["question"];
				$majorCount++;

			}
			else if ($row["questionID"] == "q5") {
				if ($row["answer"] == "A") {
					$A++;
				}
				else if ($row["answer"] == "A-") {
					$Aminus++;
				}
				else if ($row["answer"] == "B+") {
					$Bplus++;
				}
				else if ($row["answer"] == "B") {
					$B++;
				}
				else if ($row["answer"] == "B-") {
					$Bminus++;
				}
				else if ($row["answer"] == "C+") {
					$Cplus++;
				}
				else if ($row["answer"] == "C") {
					$C++;
				}
				else if ($row["answer"] == "C-") {
					$Cminus++;
				}
				else if ($row["answer"] == "D+") {
					$Dplus++;
				}
				else if ($row["answer"] == "D") {
					$D++;
				}
				else if ($row["answer"] == "D-") {
					$Dminus++;
				}
				else if ($row["answer"] == "F") {
					$F++;
				}

				$expectedGradeQ = $row["question"];
				$expectedGradeCount++;
			}
			else if ($row["questionID"] == "q6") {
				if ($row["answer"] == "Pre-Prof Requirement") {
					$preprof++;
				}
				else if ($row["answer"] == "Prerequisite") {
					$prereq++;
				}
				else if ($row["answer"] == "College Requirement Major") {
					$req++;
				}
				else if ($row["answer"] == "Interested") {
					$interested++;
				}
				$reasonQ = $row["question"];
				$reasonCount++;
			}
		}
	}
	echo "<br>";
	echo "<br>";
	?>

	<body>MC Question Statistics:</body>
	<br>
	<br>
	<?php
	if ($yearCount != 0) {
		echo $yearQ;
		echo "<br>";
		echo $yearFirstA;
		echo ": ";
		echo $yearFirst;
		
		echo "<br>";
		echo $yearSecondA;
		echo ": ";
		echo $yearSecond;
		
		echo "<br>";
		echo $yearThirdA;
		echo ": ";
		echo $yearThird;
		
		echo "<br>";
		echo $yearFourthA;
		echo ": ";
		echo $yearFourth;
		
		echo "<br>";
		echo $yearFourth1A;
		echo ": ";
		echo $yearFourth1;
		
		echo "<br>";
		echo $yearGradA;
		echo ": ";
		echo $yearGrad;
		
		echo "<br>";
	}
	echo "<br>";
	echo "<br>";
	if ($genderCount != 0) {
		echo $genderQ;
		echo "<br>";
		echo $genderMaleA;
		echo ": ";
		echo $genderMale;
		
		echo "<br>";
		echo $genderFemaleA;
		echo ": ";
		echo $genderFemale;
		
	}
	echo "<br>";
	echo "<br>";

	if ($classMissedCount != 0) {
		echo $classMissedQ;
		echo "<br>";
		echo $classMissed0A;
		echo ": ";
		echo $classMissed0;
		
		echo "<br>";
		echo $classMissed5A;
		echo ": ";
		echo $classMissed5;
		
		echo "<br>";
		echo $classMissed10A;
		echo ": ";
		echo $classMissed10;
		
		echo "<br>";
		echo $classMissed15A;
		echo ": ";
		echo $classMissed15;
		
		echo "<br>";
		echo $classMissed20A;
		echo ": ";
		echo $classMissed20;
		
		echo "<br>";
		echo $classMissed25A;
		echo ": ";
		echo $classMissed25;
		
		echo "<br>";
		echo $classMissed30A;
		echo ": ";
		echo $classMissed30;
		
		echo "<br>";
		echo $classMissed40A;
		echo ": ";
		echo $classMissed40;
		
		echo "<br>";
		echo $classMissed50A;
		echo ": ";
		echo $classMissed50;
		
		echo "<br>";
		echo $classMissed60A;
		echo ": ";
		echo $classMissed60;
		
		echo "<br>";
		echo $classMissed80A;
		echo ": ";
		echo $classMissed80;
		
		echo "<br>";
		echo $classMissed99A;
		echo ": ";
		echo $classMissed99;
		
	}
	echo "<br>";
	echo "<br>";

	if ($majorCount != 0) {
		echo $majorQ;
		echo "<br>";
		echo "Applied Mathematics: ";
		echo $appliedMath;
		
		echo "<br>";
		echo "Applied Physics: ";
		echo $appliedPhys;
		
		echo "<br>";
		echo "Biology: ";
		echo $biology;
		
		echo "<br>";
		echo "Business: ";
		echo $business;
		
		echo "<br>";
		echo "Business Administration: ";
		echo $businessAd;
		
		echo "<br>";
		echo "Chemistry: ";
		echo $chem;
		
		echo "<br>";
		echo "Computer Science: ";
		echo $compsci;
		
		echo "<br>";
		echo "Economics: ";
		echo $econ;
		
		echo "<br>";
		echo "Economics & Mathematics: ";
		echo $econmath;
		
		echo "<br>";
		echo "Mathematics: ";
		echo $math;
		
		echo "<br>";
		echo "Mathematics & Computer Science: ";
		echo $mathcs;
		
		echo "<br>";
		echo "Physics: ";
		echo $phys;
		
		echo "<br>";
		echo "Quantitative Science: ";
		echo $quant;
		
		echo "<br>";
		echo "Sociology: ";
		echo $sociology;
		
		echo "<br>";
		echo "Undeclared: ";
		echo $undeclared;
		

	}
	echo "<br>";
	echo "<br>";

	if ($expectedGradeCount != 0) {
		echo $expectedGradeQ;
		echo "<br>";
		echo "A: ";
		echo $A;
		
		echo "<br>";
		echo "A-: ";
		echo $A;
		
		echo "<br>";
		echo "B+: ";
		echo $Bplus;
		
		echo "<br>";
		echo "B-: ";
		echo $Bminus;
		
		echo "<br>";
		echo "C+: ";
		echo $Cplus;
		
		echo "<br>";
		echo "C: ";
		echo $C;
		
		echo "<br>";
		echo "C-: ";
		echo $Cminus;
		
		echo "<br>";
		echo "D+: ";
		echo $Dplus;
		
		echo "<br>";
		echo "D: ";
		echo $D;
		
		echo "<br>";
		echo "D-: ";
		echo $Dminus;
		
		echo "<br>";
		echo "F: ";
		echo $F;
		
	}
	echo "<br>";
	echo "<br>";

	if ($reasonCount != 0) {
		echo $reasonQ;
		echo "<br>";
		echo "Pre-Prof Requirement: ";
		echo $preprof;
		
		echo "<br>";
		echo "Prequisite: ";
		echo $prereq;
		
		echo "<br>";
		echo "College Requirement Major: ";
		echo $req;
		
		echo "<br>";
		echo "Interested: ";
		echo $interested;
		
	}

	echo "<br>";
	echo "<br>";

	?>
	<body>All text responses: </body>
	<br>
	<br>
	<?php

	for ($x = 0; $x < $count6; $x++) {
		while ($row = $textQuery->fetch_assoc()) {
			if ($row["questionID"] == "q15") {
				echo $row["question"];
				echo "<br>";
				echo $row["answer"];
				echo "<br>";
			}
			else if ($row["questionID"] == "q16") {
				echo $row["question"];
				echo "<br>";
				echo $row["answer"];
				echo "<br>";
			}
			else if ($row["questionID"] == "q17") {
				echo $row["question"];
				echo "<br>";
				echo $row["answer"];
				echo "<br>";
			}
			if ($row["questionID"] == "q18") {
				echo $row["question"];
				echo "<br>";
				echo $row["answer"];
				echo "<br>";
			}
		}
	}


	
	?>
