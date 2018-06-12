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
        $fr_fa_completed = 1;
      $fr_winter = [];
        $fr_wi_sum   = 0;
        $fr_wi_completed = 1;
      $fr_spring = [];
        $fr_sp_sum   = 0;
        $fr_sp_completed = 1;
      $so_fall = [];
        $so_fa_sum   = 0;
        $so_fa_completed = 1;
      $so_winter = [];
        $so_wi_sum   = 0;
        $so_wi_completed = 1;
      $so_spring = [];
        $so_sp_sum   = 0;
        $so_sp_completed = 1;
      $ju_fall = [];
        $ju_fa_sum   = 0;
        $ju_fa_completed = 1;
      $ju_winter = [];
        $ju_wi_sum   = 0;
        $ju_wi_completed = 1;
      $ju_spring = [];
        $ju_sp_sum   = 0;
        $ju_sp_completed = 1;
      $se_fall = [];
        $se_fa_sum   = 0;
        $se_fa_completed = 1;
      $se_winter = [];
        $se_wi_sum   = 0;
        $se_wi_completed = 1;
      $se_spring = [];
        $se_sp_sum   = 0;
        $se_sp_completed = 1;

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
          break;

        case 'F15':
          $so_fall[] = $course;
          if ($course['course_completed'] == 0) {
            $so_fa_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $so_fa_completed = 2;
            $so_fa_sum += $course['credits'];
          } else {
            $so_fa_sum += $course['credits'];
          }
          break;
        case 'W16':
          $so_winter[] = $course;
          if ($course['course_completed'] == 0) {
            $so_wi_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $so_wi_completed = 2;
            $so_wi_sum += $course['credits'];
          } else {
            $so_wi_sum += $course['credits'];
          }
          break;
        case 'SP16':
          $so_spring[] = $course;
          if ($course['course_completed'] == 0) {
            $so_sp_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $so_sp_completed = 2;
            $so_sp_sum += $course['credits'];
          } else {
            $so_sp_sum += $course['credits'];
          }
          break;

        case 'F16':
          $ju_fall[] = $course;
          if ($course['course_completed'] == 0) {
            $ju_fa_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $ju_fa_completed = 2;
            $ju_fa_sum += $course['credits'];
          } else {
            $ju_fa_sum += $course['credits'];
          }
          break;
        case 'W17':
          $ju_winter[] = $course;
          if ($course['course_completed'] == 0) {
            $ju_wi_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $ju_wi_completed = 2;
            $ju_wi_sum += $course['credits'];
          } else {
            $ju_wi_sum += $course['credits'];
          }
          break;
        case 'SP17':
          $ju_spring[] = $course;
          if ($course['course_completed'] == 0) {
            $ju_sp_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $ju_sp_completed = 2;
            $ju_sp_sum += $course['credits'];
          } else {
            $ju_sp_sum += $course['credits'];
          }
          break;

        case 'F17':
          $se_fall[] = $course;
          if ($course['course_completed'] == 0) {
            $se_fa_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $se_fa_completed = 2;
            $se_fa_sum += $course['credits'];
          } else {
            $se_fa_sum += $course['credits'];
          }
          break;
        case 'W18':
          $se_winter[] = $course;
          if ($course['course_completed'] == 0) {
            $se_wi_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $se_wi_completed = 2;
            $se_wi_sum += $course['credits'];
          } else {
            $se_wi_sum += $course['credits'];
          }
          break;
        case 'SP18':
          $se_spring[] = $course;
          if ($course['course_completed'] == 0) {
            $se_sp_completed = 0;
          } elseif ($course['course_completed'] == 2) {
            $se_sp_completed = 2;
            $se_sp_sum += $course['credits'];
          } else {
            $se_sp_sum += $course['credits'];
          }
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
    <div class="container"> <!-- Four Year View -->
      <div class="row"> <!-- Freshman -->

        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <a href="http://web.engr.oregonstate.edu/~mccallm/CS458/CS458_OSU_Planner/source/freshman.php" button type="button" class="btn btn-info btn-lg">
            2014 - 2015
          </a>
        </div>

        <div class="col-xs-3"> <!-- Freshman Fall -->
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
            echo "<font color=\"black\"><b> Fall 2014 </b></font> </div>";

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
              echo $course['name'];
              echo "</div>";
            }
            echo "</div>";
          ?>
        </div>

        <div class="col-xs-3"> <!-- Freshman Winter -->
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
            echo "<font color=\"black\"><b> Winter 2015 </b></font> </div>";

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

        <div class="col-xs-3"> <!-- Freshman Spring -->
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
            echo "<font color=\"black\"><b> Spring 2015 </b></font> </div>";

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
      <div class="row"> <!-- Sophomore -->
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
            <a href="" button type="button" class="btn btn-lg" style="background-color:#9e9e9e; border-color:#757575; overflow: auto;">
              <font color="white">2015 - 2016</font>
          </a>
        </div>

        <div class="col-xs-3"> <!-- Soph Fall -->
          <?php
            // Term color logic
            if ($so_fa_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($so_fa_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Fall 2015 </b></font> </div>";

            // Courses
            foreach ($so_fall as $course) {
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

        <div class="col-xs-3"> <!-- Soph Winter -->
          <?php
            // Term color logic
            if ($so_wi_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($so_wi_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2016 </b></font> </div>";

            // Courses
            foreach ($so_winter as $course) {
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

        <div class="col-xs-3"> <!-- Soph Spring -->
          <?php
            // Term color logic
            if ($so_sp_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($so_sp_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Spring 2016 </b></font> </div>";

            // Courses
            foreach ($so_spring as $course) {
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
      <div class="row"> <!-- Junior -->
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <a href="" button type="button" class="btn btn-lg" style="background-color:#9e9e9e; border-color:#757575; overflow: auto;">
            <font color="white">2016 - 2017</font>
          </a>
        </div>

        <div class="col-xs-3"> <!-- Junior Fall -->
          <?php
            // Term color logic
            if ($ju_fa_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($ju_fa_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Fall 2016 </b></font> </div>";

            // Courses
            foreach ($ju_fall as $course) {
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

        <div class="col-xs-3"> <!-- Junior Winter -->
          <?php
            // Term color logic
            if ($ju_wi_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($ju_wi_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2017 </b></font> </div>";

            // Courses
            foreach ($ju_winter as $course) {
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

        <div class="col-xs-3"> <!-- Junior Spring -->
          <?php
            // Term color logic
            if ($ju_sp_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($ju_sp_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Spring 2017 </b></font> </div>";

            // Courses
            foreach ($ju_spring as $course) {
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
      <div class="row"> <!-- Senior -->
        <div class="col-xs-3 center-block text-center">
          <p></br></br></p>
          <a href="" button type="button" class="btn btn-lg" style="background-color:#9e9e9e; border-color:#757575; overflow: auto;">
            <font color="white">2017 - 2018</font>
          </a>
        </div>

        <div class="col-xs-3"> <!-- Senior Fall -->
          <?php
            // Term color logic
            if ($se_fa_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($se_fa_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Fall 2017 </b></font> </div>";

            // Courses
            foreach ($se_fall as $course) {
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

        <div class="col-xs-3"> <!-- Senior Winter -->
          <?php
            // Term color logic
            if ($se_wi_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($se_wi_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Winter 2018 </b></font> </div>";

            // Courses
            foreach ($se_winter as $course) {
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

        <div class="col-xs-3"> <!-- Senior Spring -->
          <?php
            // Term color logic
            if ($se_sp_completed == 0) {
              echo "<div class=\"panel panel-danger\"> "; // Red
            } elseif ($se_sp_completed == 2) {
              echo "<div class=\"panel panel-warning\"> "; // Yellow
            } else {
              echo "<div class=\"panel panel-success\"> "; // Green
            }

            // Header
            echo "<div class=\"panel-heading text-center\" style=\"overflow:auto; font-size:16px\">";
            echo "<font color=\"black\"><b> Spring 2018 </b></font> </div>";

            // Courses
            foreach ($se_spring as $course) {
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
