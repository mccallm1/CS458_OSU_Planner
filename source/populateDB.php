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

		// Courses
			// Freshman
				// Fall
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 160', 'F14', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'COMM 111','F14', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'BI 211', 'F14', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'WR 121', 'F14', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
				// Winter
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 161', 'W15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'MTH 251', 'W15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'BI 212', 'W15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
				// Spring
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'WR 222', 'SP15', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 162', 'SP15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'MTH 252', 'SP15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'BI 213', 'SP15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}

			// Sophomore
				// Fall
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 261', 'F15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'BI 332','F15', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 211', 'F15', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'ZO 111', 'F15', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
				// Winter
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 299', 'W16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'ECE 175', 'W16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'BI 354', 'W16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'HST 213', 'W16', '3')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
				// Spring
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'CS 312', 'SP16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'MTH 301', 'SP16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}
					$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
						VALUES (NULL, 'WR 281', 'SP16', '4')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					}

		// Junior
			// Fall
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ECE 256', 'F16', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 282','F16', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 325', 'F16', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'WR 301', 'F16', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
			// Winter
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ECE 257', 'W17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 283', 'W17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'BI 342', 'W17', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ENGR 218', 'W17', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
			// Spring
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ENSC 264', 'SP17', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 284', 'SP17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ECE 257', 'SP17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'HHS 213', 'SP17', '2')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
		// Senior
			// Fall
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'BI 412', 'F17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 388','F17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 409', 'F17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ECE 401', 'F17', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'PAC 239', 'F17', '1')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
			// Winter
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 458', 'W18', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 419', 'W18', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'BI 404', 'W18', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
			// Spring
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'PH 305', 'SP18', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'CS 481', 'SP18', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ROB 401', 'SP18', '4')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}
				$sql = "INSERT INTO Course (`id`, `name`, `term`, `credits`)
					VALUES (NULL, 'ECE 400', 'SP18', '3')";
				if ($conn->query($sql) === TRUE) {
						echo "New record created successfully"."<br>";
				}



		// Schedule
			// Freshman
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
						VALUES ('1', '6', '1')";
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
						VALUES ('1', '8', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '9', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '10', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '11', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}

			// Sophomore
				// FALL
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '12', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '13', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '14', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '15', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					echo "<br>";
				// WINTER
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '16', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '17', '0')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '18', '0')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					echo "<br>";
				// SPRING
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '19', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '20', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '21', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '22', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}

			// Junior
				// FALL
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '23', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '24', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '25', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '26', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					echo "<br>";
				// WINTER
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '27', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '28', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '29', '1')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '30', '0')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
				// Spring
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '31', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '32', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '33', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '34', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}

			// Senior
				// FALL
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '35', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '36', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '37', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '38', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
				// WINTER
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '39', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '40', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '41', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '42', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
				// Spring
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '43', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '44', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '45', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}
					$sql = "INSERT INTO Schedule (`student_id`, `course_id`, `course_completed`)
						VALUES ('1', '46', '2')";
					if ($conn->query($sql) === TRUE) {
							echo "New record created successfully"."<br>";
					} else {
							echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
					}


			echo "<br>";

	// Close Connection
		$conn->close();
?>
