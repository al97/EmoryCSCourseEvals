CREATE DATABASE evaluationsDB;

USE evaluationsDB;

CREATE TABLE instructor 
(
	instructorID CHAR(5) NOT NULL,
	instructorFNAME VARCHAR(20) NOT NULL,
	instructorLNAME VARCHAR(20) NOT NULL,
	CONSTRAINT instructorPK PRIMARY KEY (instructorID),
	CONSTRAINT instructorIDPK UNIQUE (instructorID)
);

CREATE TABLE class
(
	classNo INT(4) NOT NULL,
	courseNo VARCHAR(10) NOT NULL,
	sectionNo INT NOT NULL,
	semester VARCHAR(6) NOT NULL,
	year CHAR(4) NOT NULL,
	instructorID CHAR(5) NOT NULL,
	CONSTRAINT classPK PRIMARY KEY (classNo),
	CONSTRAINT classIDPK UNIQUE (classNo),
	CONSTRAINT instructorID FOREIGN KEY (instructorID) REFERENCES instructor(instructorID)
);

CREATE TABLE student
(
	studentID CHAR(16) NOT NULL,
	CONSTRAINT studentPK PRIMARY KEY (studentID),
	CONSTRAINT studentIDPK UNIQUE (studentID)
);

CREATE TABLE evaluationCheck
(
	studentID CHAR(16) NOT NULL,
	classNo INT NOT NULL,
	evalCheck INT NOT NULL,
	CONSTRAINT evalstudentPK FOREIGN KEY (studentID) REFERENCES student(studentID),
	CONSTRAINT evalclassNo FOREIGN KEY (classNo) REFERENCES class(classNo)
);

CREATE TABLE questionBank
(
	questionID VARCHAR(4) NOT NULL,
	question VARCHAR(120) NOT NULL,
	questionType VARCHAR(8) NOT NULL,
	CONSTRAINT questionBankPK PRIMARY KEY (questionID),
	CONSTRAINT questionBANKPKID UNIQUE (questionID)
);

CREATE TABLE questionLog
(
	classNo INT(4) NOT NULL,
	questionID VARCHAR(4) NOT NULL,
	CONSTRAINT classNoFK FOREIGN KEY (classNo) REFERENCES class(classNo),
	CONSTRAINT qIDFK FOREIGN KEY (questionID) REFERENCES questionBank(questionID)
);

CREATE TABLE qa
(
	studentID CHAR(16) NOT NULL,
	classNo INT(4) NOT NULL,
	questionID VARCHAR(4) NOT NULL,
	answer VARCHAR(100) NOT NULL,
	CONSTRAINT qastudentFK FOREIGN KEY (studentID) REFERENCES student(studentID),
	CONSTRAINT qaclassNoFK FOREIGN KEY (classNo) REFERENCES class(classNo),
	CONSTRAINT qaIDFK FOREIGN KEY (questionID) REFERENCES questionBank(questionID)
);