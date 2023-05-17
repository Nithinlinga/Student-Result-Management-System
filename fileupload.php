<?php
require 'connection.php';
if(isset($_POST["submit"])){
  $Uid = $_POST["Uid"];
  $Course=$_POST["Course"];
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $query = "INSERT INTO ans_sheet VALUES('$Uid', '$Course', '$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'data.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Image File</title>
  </head>
  <body>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <!-- <form method="post" enctype="multipart/form-data" action="uploadimage.php"> -->
            <label for="Uid">Uid:</label>
            <input type="text" id="Uid" name="Uid" required>
            <label for="Course">Course:</label>
            <input type="text" id="Course" name="Course" required>
            <label for="image_url">Select File:</label>
            <input type="file" id="image_url" name="image_url" required>
            <button type="submit">Upload</button>
            </form>
    <br>
    <a href="data.php">Data</a>
  </body>
</html>