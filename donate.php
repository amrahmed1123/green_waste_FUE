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
$imageType = isset($_GET['image']) ? $_GET['image'] : "";
$selectedItem = isset($_GET['name']) ? $_GET['name'] : "";
if (isset($_GET['image'])) {
$imageType = "";
$selectedItem = "";
$image = $_GET['image'];
if (strpos($image, 'Gift') !== false) {
$imageType = "Gift";
$itemNumber = substr($image, -1);
$selectedItem = "package" . $itemNumber;
} elseif (strpos($image, 'Donation') !== false) {
$imageType = "Donation";
$itemNumber = substr($image, -1);
$selectedItem = "Organization" . $itemNumber;
}
}
$conn=mysqli_connect("localhost", "root", "", "grad");
$stmt = "INSERT INTO gift (gift ,type,email) VALUES
('$imageType', '$selectedItem','$email')"; 
$result = mysqli_query($conn, $stmt);
header("Location: thankyou.html");
exit();
// Make sure to exit after the redirect
?>
