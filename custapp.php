<!DOCTYPE html>
<html>
<head>
<title>Customers Appointment</title>
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
table {
border-collapse: collapse;
width: 100%;
}
th, td {
padding: 10px;
text-align: left;
border-bottom: 2px solid;
color: black;
}
th {
background-color: lightgreen;
}
h1 {
margin-top: 30px;
}
.no-records {
margin-top: 20px;
font-style: italic;
color: gray;
}
.search-container {
text-align: right;
margin-bottom: 20px;
}
.search-container input[type=text] {
padding: 8px;
font-size: 14px;
width: 300px;
border: 1px solid #ddd;
border-radius: 4px;
box-sizing: border-box;
}
.search-container input[type=text]:focus {
outline: none;
border-color: #4CAF50;
}
.highlight {
background-color: yellow;
}
</style>
</head>
<body>
<div class="navbar">
<a href="report.php">Home</a>
<a class="active" href="custapp.php">Customer's Appointments</a>
<a href="custfeed.php">Customer's Feedback</a>
<a href="appmat.php">Appointments & Materials</a>
<a href="loginadmin.html">Logout</a>
</div>
<h1>Customer's Appointments</h1>
<div class="search-container">
<input type="text" id="search-input" placeholder="Search...">
</div>
<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "grad");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Query to retrieve results from Table 1 and Table 2 based on a condition
$sql = "SELECT customer.email, customer.phone, 
appointment.date, appointment.time
FROM customer
JOIN appointment ON customer.email = appointment.email";
$result = $conn->query($sql);
// Display results
if ($result->num_rows > 0) {
echo "<table id='appointment-table'>";
echo "<tr>";
echo "<th>Email</th>";
echo "<th>Number</th>";
echo "<th>Appointment Date</th>";
echo "<th>Appointment Time</th>";
echo "</tr>";
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . highlightSearchTerm($row["email"]) . "</td>";
echo "<td>" . highlightSearchTerm($row["phone"]) . "</td>";
echo "<td>" . highlightSearchTerm($row["date"]) . "</td>";
echo "<td>" . highlightSearchTerm($row["time"]) . "</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "<p class='no-records'>No records found.</p>";
}
// Close the connection
$conn->close();
function highlightSearchTerm($text)
{
if (!isset($_GET['search']) || empty($_GET['search'])) {
return $text;
}
$searchTerm = $_GET['search'];
$highlightedText = str_ireplace($searchTerm, "<span 
class='highlight'>$searchTerm</span>", $text);
return $highlightedText;
}
?>
<script>
document.getElementById("search-input").addEventListener("keyup", 
function() {
var input, filter, table, tr, td, i, txtValue, shouldDisplay;
input = document.getElementById("search-input");
filter = input.value.toUpperCase();
table = document.getElementById("appointment-table");
tr = table.getElementsByTagName("tr");
for (i = 1; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td");
shouldDisplay = false;
for (var j = 0; j < td.length; j++) {
var cell = td[j];
txtValue = cell.textContent || cell.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
cell.innerHTML = txtValue.replace(new RegExp(filter, 
"gi"), function(match) {
return "<span class='highlight'>" + match + 
"</span>";
});
shouldDisplay = true;
} else {
cell.innerHTML = txtValue;
}
}
tr[i].style.display = shouldDisplay ? "" : "none";
}
});
</script>
</body>
</html>