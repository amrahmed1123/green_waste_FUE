<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['email'])) {
$email = $_SESSION['email'];
// Use the email as needed
echo "Email: " . $email;
} else {
// Email not found in the session, handle accordingly
}
$plastic = isset($_POST['plastic-quantity']) ? $_POST['plastic-quantity'] : "";
$oil = isset($_POST['oil-quantity']) ? $_POST['oil-quantity'] : "";
$paper = isset($_POST['paper-quantity']) ? $_POST['paper-quantity'] : "";
$metal = isset($_POST['metal-quantity']) ? $_POST['metal-quantity'] : "";
$conn = mysqli_connect("localhost", "root", "", "grad");
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$stmt = "INSERT INTO mater (plastic, paper, metal, 
oil,email) VALUES ('$plastic', '$paper', '$metal', '$oil','$email')";
$result = mysqli_query($conn, $stmt);
header("Location: appointment.html");
exit();
?>