<?php
// Get form data
$Uid = $_POST['Uid'];
$course = $_POST['course'];
$exam_type = $_POST['exam_type'];
$marks = $_POST['marks'];

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert data into marks table
$sql = "INSERT INTO student_marks (Uid,course,exam_type,marks) VALUES ('$Uid', '$course','$exam_type','$marks')";

if ($conn->query($sql) === TRUE) {
  echo "Marks added successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close MySQL connection
$conn->close();
?>