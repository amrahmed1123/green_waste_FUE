<!DOCTYPE html>
<html>
<head>
<title> Reports</title>
<style>
body {
margin: 0;
padding: 0;
font-family: Arial, sans-serif;
}
.navbar {
background-color: #333;
overflow: hidden;
}
.navbar a {
float: left;
display: block;
color: white;
text-align: center;
padding: 14px 20px;
text-decoration: none;
font-size: 16px;
}
.navbar a:hover {
background-color: #111;
}
.active {
background-color: #4CAF50;
}
</style>
</head>
<body>
<div class="navbar">
<a class="active" href="report.php">Home</a>
<a href="custapp.php">Customer's Appointments</a>
<a href="custfeed.php">Customer's Feedback</a>
<a href="appmat.php">Appointments & Materials</a>
<a href="loginadmin.html">Logout</a>
</div>
<style>
h1 {
margin-top: 30px;
} 
.figure-container {
display: flex;
flex-wrap: wrap;
justify-content: space-between;
margin-top: 10px;
}
.figure {
flex-basis: 35%;
padding: 30px;
text-align: center;
border: 1px solid #ccc;
border-radius: 4px;
background-color: #f9f9f9;
margin-bottom: 20px;
}
.figure img {
width: 100px;
height: 100px;
margin-bottom: 10px;
}
.figure p {
margin: 0;
font-weight: bold;
color: #333;
}
</style>
</body>
<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "grad");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Query to retrieve results from Table 1 and Table 2 based on a condition
$sql = "SELECT appointment.email, appointment.date, 
appointment.time, mater.oil, mater.plastic, mater.paper, 
mater.metal
FROM appointment
JOIN mater ON appointment.email = mater.email";
$result = $conn->query($sql);
// Additional options and figures based on the results from the database
$sqlFigures = "SELECT SUM(oil) AS total_oil, SUM(paper) AS
total_paper, SUM(plastic) AS total_plastic, SUM(metal) AS total_metal
FROM mater";
$resultFigures = $conn->query($sqlFigures);
$rowFigures = $resultFigures->fetch_assoc();
$totalOil = $rowFigures["total_oil"];
$totalPaper = $rowFigures["total_paper"];
$totalPlastic = $rowFigures["total_plastic"];
$totalMetal = $rowFigures["total_metal"];
?>
<!-- Total Amount of Materials -->
<h1 id="table">Total Amount of Materials:</h1>
<div class="figure-container">
<div class="figure figure-top-left">
<img src="Recycle008.png" alt="Oil">
<p>Total Oil:</p>
<p><?php echo $totalOil; ?></p>
</div>
<div class="figure figure-top-right">
<img src="Recycle007.png" alt="Paper">
<p>Total Paper:</p>
<p><?php echo $totalPaper; ?></p>
</div>
<div class="figure figure-bottom-left">
<img src="Recycle005.png" alt="Plastic">
<p>Total Plastic:</p>
<p><?php echo $totalPlastic; ?></p>
</div>
<div class="figure figure-bottom-right">
<img src="Recycle009.png" alt="Metal">
<p>Total Metal:</p>
<p><?php echo $totalMetal; ?></p>
</div>
</div>
<style>
.report-figure {
margin-top: 30px;
background-color: #f9f9f9;
padding: 20px;
border-radius: 4px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.figure-container {
display: flex;
justify-content: space-between;
align-items: center;
margin-top: 20px;
}
.figure {
flex-basis: 30%;
text-align: center;
}
.figure img {
width: 100px;
height: 100px;
margin: 0 auto;
}
.figure p {
margin-top: 10px;
}
</style>
<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "grad");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Get the total number of appointments
$sqlTotal = "SELECT COUNT(*) AS total_appointments FROM appointment";
$resultTotal = $conn->query($sqlTotal);
$rowTotal = $resultTotal->fetch_assoc();
$totalAppointments = $rowTotal['total_appointments'];
// Get the number of upcoming appointments
$sqlUpcoming = "SELECT COUNT(*) AS upcoming_appointments FROM appointment WHERE
date > CURDATE()";
$resultUpcoming = $conn->query($sqlUpcoming);
$rowUpcoming = $resultUpcoming->fetch_assoc();
$upcomingAppointments = $rowUpcoming['upcoming_appointments'];
// Get the number of completed appointments
$sqlCompleted = "SELECT COUNT(*) AS completed_appointments FROM appointment WHERE
date < CURDATE()";
$resultCompleted = $conn->query($sqlCompleted);
$rowCompleted = $resultCompleted->fetch_assoc();
$completedAppointments = $rowCompleted['completed_appointments'];
// Close the connection
$conn->close();
?>
<div class="report-figure">
<h2>Appointments Summary :</h2>
<div class="figure-container">
<div class="figure">
<img src="Recycle019.png" alt="Chart 1">
<p>Total Appointments</p>
<p><?php echo $totalAppointments; ?></p>
</div>
<div class="figure">
<img src="Recycle018.png" alt="Chart 2">
<p>Upcoming Appointments</p>
<p><?php echo $upcomingAppointments; ?></p>
</div>
<div class="figure">
<img src="Recycle017.png" alt="Chart 3">
<p>Completed Appointments</p>
<p><?php echo $completedAppointments; ?></p>
</div>
</div>
</div>
