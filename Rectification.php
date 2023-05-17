<?php
  $conn = mysqli_connect("localhost", "root", "", "admin_cre");
  $Uid=$_POST['Uid'];
  $course=$_POST['course'];
  $reason=$_POST['reason'];

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO rectification (Uid, course, reason) VALUES ('$Uid', '$course', '$reason')";


  if ($conn->query($sql) === TRUE) {
    echo "Request made successfully";
    
  
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  
  $conn->close();
  

?>