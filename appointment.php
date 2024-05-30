<?php
$phone = $_POST["phone"];
$email = $_POST["email"];
$date = $_POST["date"];
$time = $_POST["time"];
$area = $_POST["area"];
$city = $_POST["city"];
$state = $_POST["state"];
$cpost = $_POST["cpost"];
$conn = mysqli_connect("localhost", "root", "", "grad");
$updateStmt = "UPDATE customer SET area='$area', city='$city', 
state='$state', cpost='$cpost' WHERE email='$email'";
$insertStmt = "INSERT INTO appointment (date, time, email) VALUES
('$date', '$time', '$email')";
$updateResult = mysqli_query($conn, $updateStmt);
$insertResult = mysqli_query($conn, $insertStmt);
if ($updateResult && $insertResult) {
// Both update and insert statements were successful
header("Location: donate.html");
exit();
} else {
// Error occurred during database operation
// Handle the error appropriately
}
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve the email from the form
$email = $_POST['email'];
// Store the email in a session variable
$_SESSION['email'] = $email;
// Redirect to the "donate.html" page
header("Location: donate.html");
exit();
}
?>