<!DOCTYPE HTML>
<html>
  <head>
    <title>OSU Credit Plotter</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css"/>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

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
          $so_fall = [];
            $so_fa_sum   = 0;
            $so_fa_possible = 0;
            $so_fa_completed = 1;
          $so_winter = [];
            $so_wi_sum   = 0;
            $so_wi_possible = 0;
            $so_wi_completed = 1;
          $so_spring = [];
            $so_sp_sum   = 0;
            $so_sp_possible = 0;
            $so_sp_completed = 1;
          $ju_fall = [];
            $ju_fa_sum   = 0;
            $ju_fa_possible = 0;
            $ju_fa_completed = 1;
          $ju_winter = [];
            $ju_wi_sum   = 0;
            $ju_wi_possible = 0;
            $ju_wi_completed = 1;
          $ju_spring = [];
            $ju_sp_sum   = 0;
            $ju_sp_possible = 0;
            $ju_sp_completed = 1;
          $se_fall = [];
            $se_fa_sum   = 0;
            $se_fa_possible = 0;
            $se_fa_completed = 1;
          $se_winter = [];
            $se_wi_sum   = 0;
            $se_wi_possible = 0;
            $se_wi_completed = 1;
          $se_spring = [];
            $se_sp_sum   = 0;
            $se_sp_possible = 0;
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
            $so_fa_possible += $course['credits'];
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
            $so_wi_possible += $course['credits'];
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
            $so_sp_possible += $course['credits'];
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
            $ju_fa_possible += $course['credits'];
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
            $ju_wi_possible += $course['credits'];
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
            $ju_sp_possible += $course['credits'];
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
            $se_fa_possible += $course['credits'];
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
            $se_wi_possible += $course['credits'];
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
            $se_sp_possible += $course['credits'];
            break;
        }
      }
    ?>

    <script>
    window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer", {
      	animationEnabled: true,
      	axisY: {
      		title: "Number of Credits",
      		titleFontColor: "#4F81BC",
      		lineColor: "#4F81BC",
      		labelFontColor: "#4F81BC",
      		tickColor: "#4F81BC"
      	},
      	toolTip: {
      		shared: true
      	},
      	legend: {
      		cursor:"pointer",
      		itemclick: toggleDataSeries
      	},

      	data: [{
      		type: "column",
      		name: "Credits Earned",
      		legendText: "Credits Earned",
      		showInLegend: true,
      		dataPoints:[
      			{ label: "Fresh Fall", y: <?php echo $fr_fa_sum; ?> },
      			{ label: "Fresh Winter", y: <?php echo $fr_wi_sum; ?> },
      			{ label: "Fresh Spring", y: <?php echo $fr_sp_sum; ?> },

      			{ label: "Soph Fall", y: <?php echo $so_fa_sum; ?> },
      			{ label: "Soph Winter", y: <?php echo $so_wi_sum; ?> },
      			{ label: "Soph Spring", y: <?php echo $so_sp_sum; ?> },

            { label: "Junior Fall", y: <?php echo $ju_fa_sum; ?> },
      			{ label: "Junior Winter", y: <?php echo $ju_wi_sum; ?> },
      			{ label: "Junior Spring", y: <?php echo $ju_sp_sum; ?> },

            { label: "Senior Fall", y: <?php echo $se_fa_sum; ?> },
      			{ label: "Senior Winter", y: <?php echo $se_wi_sum; ?> },
      			{ label: "Senior Spring", y: <?php echo $se_sp_sum; ?> }
      		]
      	},
      	{
      		type: "column",
      		name: "Credits Taken",
      		legendText: "Credits Taken",
      		showInLegend: true,
      		dataPoints:[
            { label: "Fresh Fall", y: <?php echo $fr_fa_possible; ?> },
      			{ label: "Fresh Winter", y: <?php echo $fr_wi_possible; ?> },
      			{ label: "Fresh Spring", y: <?php echo $fr_sp_possible; ?> },

      			{ label: "Soph Fall", y: <?php echo $so_fa_possible; ?> },
      			{ label: "Soph Winter", y: <?php echo $so_wi_possible; ?> },
      			{ label: "Soph Spring", y: <?php echo $so_sp_possible; ?> },

            { label: "Junior Fall", y: <?php echo $ju_fa_possible; ?> },
      			{ label: "Junior Winter", y: <?php echo $ju_wi_possible; ?> },
      			{ label: "Junior Spring", y: <?php echo $ju_sp_possible; ?> },

            { label: "Senior Fall", y: <?php echo $se_fa_possible; ?> },
      			{ label: "Senior Winter", y: <?php echo $se_wi_possible; ?> },
      			{ label: "Senior Spring", y: <?php echo $se_sp_possible; ?> }
      		]
      	}]
      });
      chart.render();
      function toggleDataSeries(e) {
      	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      		e.dataSeries.visible = false;
      	}
      	else {
      		e.dataSeries.visible = true;
      	}
      	chart.render();
      }
    }
    </script>

  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-3">
          <div class="page-header text-center font-size:32px">
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
        <div class="col-xs-3 center-block text-right">
          <p></br></p>
          <a href="http://web.engr.oregonstate.edu/~mccallm/CS458/CS458_OSU_Planner/source/mainPage.php" button type="button" class="btn btn-info btn-lg">
            Career Page
          </a>
        </div>
      </div> <!-- Header Row -->

      <div class="row"> <!-- Progress Bar -->
        <div class="panel-heading text-center" style="overflow:auto; font-size:16px"
          <font color="black"><h3>Career Progress</h3></font>
        </div>

        <div class="progress">
          <?php $percent_complete = $credits_earned; ?>
          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $percent_complete ?>%" aria-valuenow="<?php echo $credits_earned ?>" aria-valuemin="0" aria-valuemax="<?php echo $credits_taken ?>">
            <?php echo $percent_complete ?>%
          </div>
        </div>

        </br>
      </div>

      <div class="row"> <!-- Graph -->
          <div id="chartContainer" style="height: 50vh; width: 100%;"></div>
          <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
      </div>

    </div>
  </body>
</html>
