<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>OSU Planner</title>
    <meta name="description" content="The HTML5 Herald">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css"/>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  </head>

  <?php
    // Connection
    $dbhost = 'oniddb.cws.oregonstate.edu';
    $dbname = 'mccallm-db';
    $dbuser = 'mccallm-db';
    $dbpass = 'JTOkIJcZBATl1x1X';

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
      if ($conn->connect_errno) {
        echo "Failed to connect to MySQL <br/>";
        exit;
      }

    // Variables
      $courses = [];
      $credits_taken = 0;
      $credits_earned = 0;

      $fr_fall = [];
        $fr_fa_sum   = 0;
        $fr_fa_possible = 0;
        $fr_fa_completed = 1;
      $fr_winter = [];
        $fr_wi_sum   = 0;
        $fr_wi_possible = 0;
        $fr_wi_completed = 1;
      $fr_spring = [];
        $fr_sp_sum   = 0;
        $fr_sp_possible = 0;
        $fr_sp_completed = 1;

    // Student
    $sql = "SELECT firstname,lastname,standing FROM Student WHERE id = '1' ";
    if (!$result = $conn->query($sql)) {
      echo "Error: Query failed to execute: <br/>";
      exit;
    }
    if ($result->num_rows === 0) {
      echo "Query empty. <br/>";
      exit;
    }
    $student = $result->fetch_assoc();

    // Fetch ALL classes student has associated with ID
    $sql = "SELECT name,term,credits,course_completed FROM Course,Schedule WHERE Schedule.student_id = '1' AND Course.id = Schedule.course_id ";
    if (!$result = $conn->query($sql)) {
      echo "Error: Query failed to execute: <br/>";
      exit;
    }
    if ($result->num_rows === 0) {
      echo "Query empty. <br/>";
      exit;
    }
    while ($course = $result->fetch_assoc()) {
      // Calculate cumulative credit values
      if ($course['course_completed'] == 1) {
        $credits_earned += $course['credits'];
      }
      $credits_taken += $course['credits'];

      // Populate year and term info
      switch ($course['term']) {
        case 'F14':
          $fr_fall[] = $course;
          if ($course['course_completed'] == 0) {
            $fr_fa_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $fr_fa_completed = 2;
            $fr_fa_sum += $course['credits'];
          } else {
            $fr_fa_sum += $course['credits'];
          }
          $fr_fa_possible += $course['credits'];
        break;
        case 'W15':
          $fr_winter[] = $course;
          if ($course['course_completed'] == 0) {
            $fr_wi_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $fr_wi_completed = 2;
            $fr_wi_sum += $course['credits'];
          } else {
            $fr_wi_sum += $course['credits'];
          }
          $fr_wi_possible += $course['credits'];
        break;
        case 'SP15':
          $fr_spring[] = $course;
          if ($course['course_completed'] == 0) {
            $fr_sp_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $fr_sp_completed = 2;
            $fr_sp_sum += $course['credits'];
          } else {
            $fr_sp_sum += $course['credits'];
          }
          $fr_sp_possible += $course['credits'];
        break;
      }
    }
  ?>

  <body>
    <div class="row"> <!-- Heading Info & Nav Button -->
      <div class="col-xs-3">
        <div class="page-header text-center font-size:18px">
          <b>
            <?php echo $student['firstname'] . ' ' .
                  $student['lastname'] . "<br/>" .
                  $student['standing'];
            ?>
          </b>
        </div>
      </div>
      <div class="col-xs-3"></div>
      <div class="col-xs-3"></div>
      <div class="col-xs-3 center-block text-center">
        <p></br></p>
        <a href="http://web.engr.oregonstate.edu/~mccallm/CS458/CS458_OSU_Planner/source/graphPage.php" button type="button" class="btn btn-info btn-lg">
          Graph Page
        </a>
      </div>
    </div>
    <div class="container"> <!-- One Year View -->
      <div class="row"> <!-- Freshman -->
        <div class="col-xs-4"> <!-- Freshman Fall -->
          <?php
            // Term color logic
            if ($fr_fa_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($fr_fa_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"> <h1><b> Fall 2014 </b></h1>   </font> </div>";

            // Courses
            foreach ($fr_fall as $course) {
              if ($course['course_completed'] == 0) { // Red
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) { // Yellow
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
              }
              else { // Green
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
              }
              echo $course['name'] . ' - ' .
                  $course['credits'] . " credits";
              echo "</div>";
            }
            #echo "<div class=\"panel panel-success text-center col-sm-offset-3 \"> "; // Green
            echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d9edf7;\">";
            echo $fr_fa_possible . " Term Credits" . "<br/>";
            echo $fr_fa_sum . " Credits Completed"  . "<br/>";
          ?>
            </div>
          </div>
        </div>

        <div class="col-xs-4"> <!-- Freshman Winter -->
          <?php
            // Term color logic
            if ($fr_wi_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($fr_wi_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><h1><b> Winter 2015 </b></h1></font> </div>";

            // Courses
            foreach ($fr_winter as $course) {
              if ($course['course_completed'] == 0) { // Red
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) { // Yellow
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
              }
              else { // Green
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
              }
              echo $course['name'];
              echo "</div>";
            }
            echo "</div>";
          ?>
        </div>

        <div class="col-xs-4"> <!-- Freshman Spring -->
          <?php
            // Term color logic
            if ($fr_sp_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($fr_sp_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><h1><b> Spring 2015 </b></h1></font> </div>";

            // Courses
            foreach ($fr_spring as $course) {
              if ($course['course_completed'] == 0) { // Red
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) { // Yellow
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
              }
              else { // Green
                echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
              }
              echo $course['name'];
              echo "</div>";
            }
            echo "</div>";
          ?>
        </div>

      </div>
  </body>

</html>
