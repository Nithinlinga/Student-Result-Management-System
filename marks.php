<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "student_marks";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$uid = $_POST['uid'];
$course = $_POST['course'];
$exam_type = $_POST['exam_type'];
$marks=$_POST['marks']

$sql = "INSERT INTO marks (uid, course, exam_type,marks) VALUES ('$uid', '$course','$exam_type', '$marks')";

if (mysqli_query($conn, $sql)) {
  echo "Record inserted successfully";
} else {
  echo "Error inserting record: " . mysqli_error($conn);
}


?>
