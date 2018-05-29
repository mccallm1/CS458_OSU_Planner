<?php
	// Databse Parameters
		$dbhost = 'oniddb.cws.oregonstate.edu';
		$dbname = 'mccallm-db';
		$dbuser = 'mccallm-db';
		$dbpass = 'JTOkIJcZBATl1x1X';

	// Try/catch connect to DB
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_errno) {
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error."<br>";
		}
		echo "Successfully connected to database!"."<br>";
		echo "<br>";

	// Drop Tables
		$sql = "DROP TABLE IF EXISTS Student";
			if ($conn->query($sql) === TRUE) {
					echo "Table Student dropped successfully"."<br>";
			} else {
					echo "Error creating table: " . $conn->error."<br>";
			}

		$sql = "DROP TABLE IF EXISTS Schedule";
			if ($conn->query($sql) === TRUE) {
					echo "Table Schedule dropped successfully"."<br>";
			} else {
					echo "Error creating table: " . $conn->error."<br>";
			}

		$sql = "DROP TABLE IF EXISTS Course";
			if ($conn->query($sql) === TRUE) {
					echo "Table Course dropped successfully"."<br>";
			} else {
					echo "Error creating table: " . $conn->error."<br>";
			}
		echo "<br>";

	// Create Tables
		$sql = "CREATE TABLE IF NOT EXISTS Student (
			id INT AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			standing VARCHAR(10)
		)";
			if ($conn->query($sql) === TRUE) {
			    echo "Table Student created successfully"."<br>";
			} else {
			    echo "Error creating table: " . $conn->error."<br>";
			}

		$sql = "CREATE TABLE IF NOT EXISTS Schedule (
			student_id INT,
			course_id VARCHAR(30),
			course_completed INT(1),
			PRIMARY KEY (student_id, course_id)
		)";
			if ($conn->query($sql) === TRUE) {
			    echo "Table Schedule created successfully"."<br>";
			} else {
			    echo "Error creating table: " . $conn->error."<br>";
			}

		$sql = "CREATE TABLE IF NOT EXISTS Course (
			id INT AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			course_time VARCHAR(30) NOT NULL,
			weekly VARCHAR(30) NOT NULL,
			room_num VARCHAR(30),
			term VARCHAR(30) NOT NULL,
			credits INT
		)";
			if ($conn->query($sql) === TRUE) {
			    echo "Table Course created successfully"."<br>";
			} else {
			    echo "Error creating table: " . $conn->error . "<br>";
			}
		echo "<br>";

	// Populate Tables
		// Student
			$sql = "INSERT INTO Student (`id`, `firstname`, `lastname`, `standing`)
				VALUES (NULL, 'Jason', 'Harris', 'Freshman')";
			if ($conn->query($sql) === TRUE) {
					echo "New record created successfully"."<br>";
			} else {
					echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
			}
			echo "<br>";
		// Course
			// FALL 2014
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'CS 160', '10:00am-10:50am', 'MWF', 'KEL 1005', 'F14', '3')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'COMM 111', '09:00am-10:20am', 'TR', 'COV 204', 'F14', '3')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'BI 211', '02:00pm-02:50pm', 'MWF', 'LPSC 103', 'F14', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'WR 121', '09:00am-09:50am', 'MWF', 'MORE 202', 'F14', '3')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

			// WINTER 2015
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'CS 161', '12:00pm-12:50pm', 'MWF', 'KEL 1011', 'W15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'MTH 251', '03:00pm-04:20pm', 'TR', 'KIDD 204', 'W15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'BI 212', '01:00pm-01:50pm', 'MWF', 'LPSC 107', 'W15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

			// SPRING 2015
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'WR 222', '11:00am-12:20pm', 'TR', 'MORE 202', 'SP15', '3')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'CS 162', '08:00am-08:50am', 'MWF', 'KEL 1001', 'SP15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'MTH 252', '01:00pm-01:50pm', 'MWF', 'KIDD 204', 'SP15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `course_time`, `weekly`, `room_num`, `term`, `credits`)
					VALUES (NULL, 'BI 213', '09:00am-09:50am', 'MWF', 'NASH 250', 'SP15', '4')";
				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully"."<br>";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

		// Schedule
			// FALL
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '1', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '2', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '3', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '4', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

			// WINTER
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '5', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '6', '0')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '7', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

			// SPRING
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '8', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '9', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '10', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
					VALUES ('1', '11', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				} else {
						echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
				}
				echo "<br>";

	// Close Connection
		$conn->close();
?>
