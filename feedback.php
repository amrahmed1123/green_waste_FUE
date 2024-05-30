<?php
$rate=$_GET["rate"];
$satisfied=$_GET["satisfied"];
$price=$_GET["prices"];
$timeliness=$_GET["timeliness"];
$name=$_GET["name"];
$recommend=$_GET["recommend"];
$message=$_GET["message"];
$mail=$_GET["mail"];
$conn=mysqli_connect("localhost", "root", "", "grad");
$stmt = "INSERT INTO feedback ( feedb_rate,feedb_satisfied, 
feedb_gift,feedb_time,feedb_custsup,feedb_reco,feedb_msg,email) VALUES
('$rate', 
'$satisfied','$price','$timeliness','$name','$recommend','$message','$mail')";
$result = mysqli_query($conn, $stmt);
header("Location: main.html");
exit; // Make sure to exit after the redirect
?>