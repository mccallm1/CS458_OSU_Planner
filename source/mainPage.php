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
      $fall_credits   = 0;
      $winter_credits = 0;
      $spring_credits = 0;

      $fall_comp_sum   = 0;
      $winter_comp_sum = 0;
      $spring_comp_sum = 0;
  ?>

  <?php
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
  ?>

  <?php
    // Fall
    $sql = "SELECT name,credits,course_time,course_completed FROM Course,Schedule WHERE Schedule.course_id = Course.id AND term = 'F14' LIMIT 4";

    if (!$result = $conn->query($sql)) {
      echo "Error: Query failed to execute: <br/>";
      exit;
    }
    if ($result->num_rows === 0) {
      echo "Query empty. <br/>";
      exit;
    }

    $i = 0;
    while ($course = $result->fetch_assoc()) {
      $fall_term[$i] = $course;
      if ($course['course_completed'] > 0) {
        $fall_credits += $course['credits'];
      }
      $fall_comp_sum += $course['course_completed'];
      $i++;
    }
  ?>
  <?php
    // Winter
    $sql = "SELECT name,credits,course_time,course_completed FROM Course,Schedule WHERE Schedule.course_id = Course.id AND term = 'W15' LIMIT 3";

    if (!$result = $conn->query($sql)) {
      echo "Error: Query failed to execute: <br/>";
      exit;
    }
    if ($result->num_rows === 0) {
      echo "Query empty. <br/>";
      exit;
    }

    $i = 0;
    while ($course = $result->fetch_assoc()) {
      $winter_term[$i] = $course;
      if ($course['course_completed'] > 0) {
        $winter_credits += $course['credits'];
      }
      $winter_comp_sum += $course['course_completed'];
      $i++;
    }
  ?>
  <?php
    // Spring
    $sql = "SELECT name,credits,course_time,course_completed FROM Course,Schedule WHERE Schedule.course_id = Course.id AND  term = 'SP15' LIMIT 4";

    if (!$result = $conn->query($sql)) {
      echo "Error: Query failed to execute: <br/>";
      exit;
    }
    if ($result->num_rows === 0) {
      echo "Query empty. <br/>";
      exit;
    }

    $i = 0;
    while ($course = $result->fetch_assoc()) {
      $spring_term[$i] = $course;
      if ($course['course_completed'] > 0) {
        $spring_credits += $course['credits'];
      }
      $spring_comp_sum += $course['course_completed'];
      $i++;
    }
  ?>

  <body>
    <div class="row">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-4">
        <div class="well well-lg text-center" style="background-color:#d9edf7; overflow: auto;"><h1>
          <?php echo '*******' . $student['firstname'] . ' ' .
                $student['lastname'] . "<br/>" .
                $student['standing'];
          ?>
        </h1></div>
      </div>
      <div class="col-sm-4">
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-success">
          <?php
            if ($fall_comp_sum == sizeof($fall_term)) {
              echo "<div class=\"panel-heading text-center\" style=\"background-color:#d6e9c6; overflow: auto;\">"; // Green
            } else {
              echo "<div class=\"panel-heading text-center\" style=\"background-color:#fcf8e3; overflow: auto;\">"; // Yellow
            }
            echo "<font color=\"black\"> <h2>Fall 2014</h2> </font></div>";
          ?> <p><br></p>

          <?php
            foreach ($fall_term as $course) {
              if ($course['course_completed'] == 0) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; overflow: auto;\">";
              }
              else {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; overflow: auto;\">";
              }

                echo $course['name'] . ' - ' .
                  $course['credits'] . " credits <br/>";

              echo "</div>";
            }
          ?>

          <div class="well well-xs text-left col-sm-offset-3" style="background-color:#d9edf7; overflow: auto;">
            <?php
              echo $fall_credits . " Term Credits" . "<br/>";
              echo $fall_credits . " Credits Completed"  . "<br/>";
            ?>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-success" border-color="black">
          <?php
          if ($winter_comp_sum == sizeof($winter_term)) {
            echo "<div class=\"panel-heading text-center\" style=\"background-color:#d6e9c6; overflow: auto;\">"; // Green
          } else {
            echo "<div class=\"panel-heading text-center\" style=\"background-color:#fcf8e3; overflow: auto;\">"; // Yellow
          }
            echo "<font color=\"black\"> <h2>Winter 2015</h2> </font> </div>";
          ?> <p><br></p>

          <?php
            foreach ($winter_term as $course) {
              if ($course['course_completed'] == 0) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; overflow: auto;\">";
              }
              else {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; overflow: auto;\">";
              }

                echo $course['name'] . ' - ' .
                  $course['credits'] . " credits <br/>";

              echo "</div>";
            }
          ?>

          <div class="well well-xs text-left col-sm-offset-3" style="background-color:#d9edf7; overflow: auto;">
            <?php
              echo $winter_credits . " Term Credits" . "<br/>";
              echo $fall_credits + $winter_credits . " Credits Completed"  . "<br/>";
            ?>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="panel panel-success">
          <?php
          if ($spring_comp_sum == sizeof($spring_term)) {
            echo "<div class=\"panel-heading text-center\" style=\"background-color:#d6e9c6; overflow: auto;\">"; // Green
          } else {
            echo "<div class=\"panel-heading text-center\" style=\"background-color:#fcf8e3; overflow: auto;\">"; // Yellow
          }
            echo "<font color=\"black\"> <h2>Spring 2015</h2> </font> </div>";
          ?> <p><br></p>

          <?php
            foreach ($spring_term as $course) {
              if ($course['course_completed'] == 0) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; overflow: auto;\">";
              }
              elseif ($course['course_completed'] == 2) {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; overflow: auto;\">";
              }
              else {
                echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; overflow: auto;\">";
              }

                echo $course['name'] . ' - ' .
                  $course['credits'] . " credits <br/>";

              echo "</div>";
            }
          ?>


          <div class="well well-xs text-left col-sm-offset-3"  style="background-color:#d9edf7; overflow: auto;">
            <?php
              echo $spring_credits . " Term Credits" . "<br/>";
              echo $fall_credits + $winter_credits + $spring_credits . " Credits Completed"  . "<br/>";
            ?>
          </div>
        </div>
      </div>



  </body>

</html>
