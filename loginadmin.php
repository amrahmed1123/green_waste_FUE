<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Get the email and password from the request
$email = $_POST['username'];
$password = $_POST['password'];
// Connect to your database
$conn = mysqli_connect("localhost", "root", "", "grad");
// Check the connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
// Prepare the SQL statement to retrieve the user with the given email and password
$stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
// Execute the statement
$stmt->execute();
// Get the result
$result = $stmt->get_result();
// Check if a row was found
if ($result->num_rows === 1) {
// Login successful
$response = array(
'status' => 'success',
'message' => 'Login successful'
);
} else {
// Login failed
$response = array(
'status' => 'error',
'message' => 'Invalid email or password',
'debug' => mysqli_error($conn) // Add this line for debugging purposes
);
}
// Close the statement and the database connection
$stmt->close();
mysqli_close($conn);
// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
}
?>