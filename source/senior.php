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

    $credits_taken = 0;
    $credits_earned = 0;

    $fr_fall = [];
    $fr_winter = [];
    $fr_spring = [];

    $so_fall = [];
    $so_winter = [];
    $so_spring = [];

    $ju_fall = [];
    $ju_winter = [];
    $ju_spring = [];

    $se_fall = [];
    $se_winter = [];
    $se_spring = [];

    $courses = [];
    while ($course = $result->fetch_assoc()) {
      $courses[] = $course;
      if ($course['course_completed'] == 1) {
        $credits_earned += $course['credits'];
      }
      $credits_taken += $course['credits'];

      switch ($course['term']) {
        case 'F14':
          $fr_fall = $course;
          break;
        case 'W15':
          $fr_winter = $course;
          break;
        case 'SP15':
          $fr_spring = $course;
          break;

        case 'F15':
          $so_fall = $course;
          break;
        case 'W16':
          $so_winter = $course;
          break;
        case 'SP16':
          $so_spring = $course;
          break;

        case 'F16':
          $ju_fall = $course;
          break;
        case 'W17':
          $ju_winter = $course;
          break;
        case 'SP17':
          $ju_spring = $course;
          break;

        case 'F17':
          $se_fall = $course;
          break;
        case 'W18':
          $se_winter = $course;
          break;
        case 'SP18':
          $se_spring = $course;
          break;
      }
    }



  ?>

  <body>
    <div class="row">
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

    <div class="container">
      <div class="row">
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <button type="button" class="btn btn-info btn-lg">
            2014 - 2015
          </button>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-success">
            <?php
              echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
              echo "<font color=\"black\"><b> Fall 2014 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_fall as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2015 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_winter as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"> <b> Spring 2015 </b> </font> </div>";
            ?>

            <?php
              foreach ($fr_spring as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <button type="button" class="btn btn-info btn-lg">
            2014 - 2015
          </button>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-success">
            <?php
              echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
              echo "<font color=\"black\"><b> Fall 2014 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_fall as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2015 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_winter as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"> <b> Spring 2015 </b> </font> </div>";
            ?>

            <?php
              foreach ($fr_spring as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <button type="button" class="btn btn-info btn-lg">
            2014 - 2015
          </button>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-success">
            <?php
              echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
              echo "<font color=\"black\"><b> Fall 2014 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_fall as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2015 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_winter as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"> <b> Spring 2015 </b> </font> </div>";
            ?>

            <?php
              foreach ($fr_spring as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <button type="button" class="btn btn-info btn-lg">
            2014 - 2015
          </button>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-success">
            <?php
              echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
              echo "<font color=\"black\"><b> Fall 2014 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_fall as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2015 </b></font> </div>";
            ?>

            <?php
              foreach ($fr_winter as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>

        <div class="col-xs-3">
          <div class="panel panel-warning">
            <?php
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"> <b> Spring 2015 </b> </font> </div>";
            ?>

            <?php
              foreach ($fr_spring as $course) {
                if ($course['course_completed'] == 0) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#f2dede; border-color:#f2dede; overflow: auto;\">";
                }
                elseif ($course['course_completed'] == 2) {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#fcf8e3; border-color:#fcf8e3; overflow: auto;\">";
                }
                else {
                  echo "<div class=\"well well-xs text-center col-sm-offset-3\" style=\"background-color:#d6e9c6; border-color:#d6e9c6; overflow: auto;\">";
                }

                echo $course['name'] . "<br/>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
  </body>

</html>
