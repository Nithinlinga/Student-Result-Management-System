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

$sql = "UPDATE student_marks SET marks='$marks' WHERE Uid='$Uid' AND course='$course' AND exam_type='$exam_type'";
if ($conn->query($sql) === TRUE) {
  if ($conn->affected_rows > 0) {
    echo "Marks updated successfully!";
  } else {
    echo "No matching record found for update.";
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close MySQL connection
$conn->close();
?>
