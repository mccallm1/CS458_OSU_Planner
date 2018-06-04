<!DOCTYPE HTML>
<html>
  <head>
    <title>OSU Credit Plotter</title>

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
      			{ label: "Fresh Fall", y: <?php echo $fall_credits; ?> },
      			{ label: "Fresh Winter", y: <?php echo $winter_credits; ?> },
      			{ label: "Fresh Spring", y: <?php echo $spring_credits; ?> },
      			{ label: "Soph Fall", y: 148.77 },
      			{ label: "Soph Winter", y: 101.50 },
      			{ label: "Soph Spring", y: 97.8 },
            { label: "Junior Fall", y: 148.77 },
      			{ label: "Junior Winter", y: 101.50 },
      			{ label: "Junior Spring", y: 97.8 },
            { label: "Senior Fall", y: 148.77 },
      			{ label: "Senior Winter", y: 101.50 },
      			{ label: "Senior Spring", y: 97.8 }
      		]
      	},
      	{
      		type: "column",
      		name: "Credits Taken",
      		legendText: "Credits Taken",
      		showInLegend: true,
      		dataPoints:[
            { label: "Fresh Fall", y: <?php echo $fall_comp_sum; ?> },
      			{ label: "Fresh Winter", y: <?php echo $winter_comp_sum; ?> },
      			{ label: "Fresh Spring", y: <?php echo $spring_comp_sum; ?> },
      			{ label: "Soph Fall", y: 148.77 },
      			{ label: "Soph Winter", y: 101.50 },
      			{ label: "Soph Spring", y: 97.8 },
            { label: "Junior Fall", y: 148.77 },
      			{ label: "Junior Winter", y: 101.50 },
      			{ label: "Junior Spring", y: 97.8 },
            { label: "Senior Fall", y: 148.77 },
      			{ label: "Senior Winter", y: 101.50 },
      			{ label: "Senior Spring", y: 97.8 }
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
  
    <div id="chartContainer" style="height: 600px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </body>
</html>
