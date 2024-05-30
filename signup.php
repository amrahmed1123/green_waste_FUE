<?php
$fname=$_GET["fname"];
$lname=$_GET["lname"];
$phone=$_GET["phone"];
$email=$_GET["email"];
$password=$_GET["password"];
print("hello");
$conn=mysqli_connect("localhost", "root", "", "grad");
$stmt = "INSERT INTO customer (fname, lname, email, passward, phone) VALUES ('$fname', '$lname',
'$email', '$password','$phone')";
$result = mysqli_query($conn, $stmt);
header("Location: login.html");
exit();

?>