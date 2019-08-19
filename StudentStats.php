# SOME OF THIS CODE IS EXTREMELY WORDY. It's about 600 lines,
# and a lot of this is just if statements checking to see if the column value is something is 0 (in which case we don't print that value)
<!DOCTYPE html>
<html>
<body>

<h2>Here are the statistics for this course.</h2>

<?php
	include("sessionCheckStudentStats.php");

	$con = mysqli_connect("localhost", "cs377", "cs377_s18");
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	mysqli_select_db($con, "evaluationsDB");
	$agreeStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.courseNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = '5AD'";

	$mcStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE b.courseNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = 'MC'";

	$numberStats = "SELECT answer, a.questionID, c.question FROM qa a, class b, questionBank c WHERE courseNo = '$instructor_class' AND instructorID = '$instructor_id' AND a.classNo = b.classNo AND a.questionID = c.questionID AND questionType = '10Scale'";

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

	$count3 = mysqli_num_rows($numberQuery);
	$count4 = mysqli_num_rows($agreeQuery);
	$count5 = mysqli_num_rows($mcQuery);

	$year = $yearFirst = $yearSecond = $yearThird = $yearFourth = $yearFourth1 = $yearGrad = $gender = $genderMale = $genderFemale = $classMissed = $classMissed0 = $classMissed5 = $classMissed10 = $classMissed15 = $classMissed20 = $classMissed25 = $classMissed30 = $classMissed40 = $classMissed50 = $classMissed60 = $classMissed80 = $classMissed99 = $major = $appliedMath = $appliedPhys = $biology = 0;

	$business = $businessAd = $chem = $compsci = $econ = $econmath = $math = $mathcs = $phys = $quant = $sociology = $undeclared = $expectedGrade = $reason = $organization = $concern = $gradingCriteria = $enthusiasm = $factualKnowledge = $principlesAndConcepts = $recommendCourse = $recommendInstructor = 0;

	$A = $Aminus = $Bplus = $B = $Bminus = $Cplus = $C = $Cminus = $Dplus = $D = $Dminus = $F = $preprof = $prereq = $req = $interested = 0;

		$yearCount = $genderCount = $classMissedCount = $majorCount = $expectedGradeCount = $reasonCount = $organizationCount = $concernCount = $gradingCriteriaCount = $enthusiasmCount = $factualKnowledgeCount = $principlesAndConceptsCount = $recommendCourseCount = $recommendInstructorCount = 0;

	for ($x = 0; $x < $count3; $x++) {
		while ($row = $numberQuery->fetch_assoc()) {
			if ($row["questionID"] == "q7") {
				$organizationQ = $row["question"];
				$organization += (int)$row["answer"];
				$organizationCount++;
			}
			else if ($row["questionID"] == "q8") {
				$concernQ = $row["question"];
				$concern += (int)$row["answer"];
				$concernCount++;
			}
			else if ($row["questionID"] == "q9") {
				$gradingCriteriaQ = $row["question"];
				$gradingCriteria += (int)$row["answer"];
				$gradingCriteriaCount++;
			}
			else if ($row["questionID"] == "q10") {
				$enthusiasmQ = $row["question"];
				$enthusiasm += (int)$row["answer"];
				$enthusiasmCount++;
			}
			else if ($row["questionID"] == "q11") {
				$factualKnowledgeQ = $row["question"];
				$factualKnowledge += (int)$row["answer"];
				$factualKnowledgeCount++;
			}
			else if ($row["questionID"] == "q12") {
				$principlesAndConceptsQ = $row["question"];
				$principlesAndConcepts += (int)$row["answer"];
				$principlesAndConceptsCount++;
			}
		}
	}
	?>
	<body>1-10 Question Statistics:</body>
	<br>
	<br>
	<?php
	if ($organization != 0) {
		echo $organizationQ;
		echo "<br>";
		echo $organization/$organizationCount;
	}
	echo "<br>";
	echo "<br>";
	if ($concern != 0) {
		echo $concernQ;
		echo "<br>";
		echo $concern/$concernCount;
	}
	echo "<br>";
	echo "<br>";
	if ($gradingCriteria != 0) {
		echo $gradingCriteriaQ;
		echo "<br>";
		echo $gradingCriteria/$gradingCriteriaCount;
	}
	echo "<br>";
	echo "<br>";
	if ($enthusiasm != 0) {
		echo $enthusiasmQ;
		echo "<br>";
		echo $enthusiasm/$enthusiasmCount;
	}
	echo "<br>";
	echo "<br>";
	if ($factualKnowledge != 0) {
		echo $factualKnowledgeQ;
		echo "<br>";
		echo $factualKnowledge/$factualKnowledgeCount;
	}
	echo "<br>";
	echo "<br>";
	if ($principlesAndConcepts != 0) {
		echo $principlesAndConceptsQ;
		echo "<br>";
		echo $principlesAndConcepts/$principlesAndConceptsCount;
	}

	for ($x = 0; $x < $count4; $x++) {
		while ($row = $agreeQuery->fetch_assoc()) {
			if ($row["questionID"] == "q13") {
				if ($row["answer"] == "Agree" || $row["answer"] == "Strongly Agree") {
					$recommendCourse++;
				}
				$recommendCourseAgreeQ = $row["question"];
				$recommendCourseCount++;
			}
			else if ($row["questionID"] == "q14") {
				if ($row["answer"] == "Agree" || $row["answer"] == "Strongly Agree") {
					$recommendInstructor++;
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
		echo "Number of students who agreed or strongly agreed:";
		echo "<br>";
		echo ($recommendCourse/$recommendCourseCount) * 100;
		echo "%";
	}
	echo "<br>";
	echo "<br>";
	if ($recommendInstructorCount != 0) {
		echo $recommendInstructorAgreeQ;
		echo "<br>";
		echo "Number of students who agreed or strongly agreed:";
		echo "<br>";
		echo ($recommendInstructor/$recommendInstructorCount) * 100;
		echo "%";
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
		echo ($yearFirst/$yearCount) * 100;
		echo "%";
		echo "<br>";
		echo $yearSecondA;
		echo ": ";
		echo ($yearSecond/$yearCount) * 100;
		echo "%";
		echo "<br>";
		echo $yearThirdA;
		echo ": ";
		echo ($yearThird/$yearCount) * 100;
		echo "%";
		echo "<br>";
		echo $yearFourthA;
		echo ": ";
		echo ($yearFourth/$yearCount) * 100;
		echo "%";
		echo "<br>";
		echo $yearFourth1A;
		echo ": ";
		echo ($yearFourth1/$yearCount) * 100;
		echo "%";
		echo "<br>";
		echo $yearGradA;
		echo ": ";
		echo ($yearGrad/$yearCount) * 100;
		echo "%";
		echo "<br>";
	}
	echo "<br>";
	echo "<br>";
	if ($genderCount != 0) {
		echo $genderQ;
		echo "<br>";
		echo $genderMaleA;
		echo ": ";
		echo ($genderMale/$genderCount) * 100;
		echo "%";
		echo "<br>";
		echo $genderFemaleA;
		echo ": ";
		echo ($genderFemale/$genderCount) * 100;
		echo "%";
	}
	echo "<br>";
	echo "<br>";

	if ($classMissedCount != 0) {
		echo $classMissedQ;
		echo "<br>";
		echo $classMissed0A;
		echo ": ";
		echo ($classMissed0/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed5A;
		echo ": ";
		echo ($classMissed5/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed10A;
		echo ": ";
		echo ($classMissed10/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed15A;
		echo ": ";
		echo ($classMissed15/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed20A;
		echo ": ";
		echo ($classMissed20/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed25A;
		echo ": ";
		echo ($classMissed25/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed30A;
		echo ": ";
		echo ($classMissed30/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed40A;
		echo ": ";
		echo ($classMissed40/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed50A;
		echo ": ";
		echo ($classMissed50/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed60A;
		echo ": ";
		echo ($classMissed60/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed80A;
		echo ": ";
		echo ($classMissed80/$classMissedCount) * 100;
		echo "%";
		echo "<br>";
		echo $classMissed99A;
		echo ": ";
		echo ($classMissed99/$classMissedCount) * 100;
		echo "%";
	}
	echo "<br>";
	echo "<br>";

	if ($majorCount != 0) {
		echo $majorQ;
		echo "<br>";
		echo "Applied Mathematics: ";
		echo ($appliedMath/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Applied Physics: ";
		echo ($appliedPhys/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Biology: ";
		echo ($biology/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Business: ";
		echo ($business/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Business Administration: ";
		echo ($businessAd/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Chemistry: ";
		echo ($chem/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Computer Science: ";
		echo ($compsci/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Economics: ";
		echo ($econ/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Economics & Mathematics: ";
		echo ($econmath/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Mathematics: ";
		echo ($math/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Mathematics & Computer Science: ";
		echo ($mathcs/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Physics: ";
		echo ($phys/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Quantitative Science: ";
		echo ($quant/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Sociology: ";
		echo ($sociology/$majorCount) * 100;
		echo "%";
		echo "<br>";
		echo "Undeclared: ";
		echo ($undeclared/$majorCount) * 100;
		echo "%";

	}
	echo "<br>";
	echo "<br>";

	if ($expectedGradeCount != 0) {
		echo $expectedGradeQ;
		echo "<br>";
		echo "A: ";
		echo ($A/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "A-: ";
		echo ($Aminus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "B+: ";
		echo ($Bplus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "B-: ";
		echo ($Bminus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "C+: ";
		echo ($Cplus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "C: ";
		echo ($C/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "C-: ";
		echo ($Cminus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "D+: ";
		echo ($Dplus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "D: ";
		echo ($D/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "D-: ";
		echo ($Dminus/$expectedGradeCount) * 100;
		echo "%";
		echo "<br>";
		echo "F: ";
		echo ($F/$expectedGradeCount) * 100;
		echo "%";
	}
	echo "<br>";
	echo "<br>";

	if ($reasonCount != 0) {
		echo $reasonQ;
		echo "<br>";
		echo "Pre-Prof Requirement: ";
		echo ($preprof/$reasonCount) * 100;
		echo "%";
		echo "<br>";
		echo "Prequisite: ";
		echo ($prereq/$reasonCount) * 100;
		echo "%";
		echo "<br>";
		echo "College Requirement Major: ";
		echo ($req/$reasonCount) * 100;
		echo "%";
		echo "<br>";
		echo "Interested: ";
		echo ($interested/$reasonCount) * 100;
		echo "%";
	}
	
	?>
