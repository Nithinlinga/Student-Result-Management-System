<?php
session_start(); // Start the session
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_cre";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION["uid"]) || !isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
    // Redirect the user to the login page if they're not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the user's information from the session
$uid = $_SESSION["uid"];
$email = $_SESSION["email"];
$password = $_SESSION["password"];

// Prepare the SQL statement to retrieve the image name
$sql = "SELECT Name, Uid, Profile_pic FROM student_details WHERE Uid = ? AND Email = ? AND Password = ?";

// Create a prepared statement
$stmt = mysqli_prepare($conn, $sql);

// Bind the parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "sss", $uid, $email, $password);

// Execute the prepared statement
mysqli_stmt_execute($stmt);

// Bind the result to variables
mysqli_stmt_bind_result($stmt, $name, $uid, $profile_pic);

// Fetch the result
mysqli_stmt_fetch($stmt);

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

// Output the image name
$_SESSION['Profile_pic'] = $profile_pic;
?>

<!-- Display the image
<html>
<body>
    <img src="Profile/<?php echo $_SESSION['Profile_pic']; ?>" alt="Image">
</body>
</html> -->





<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    Your home page content here -->
    <!-- <h1>Welcome to the Student Profile</h1>
    <p>Student Name: </p> 
    <p>UID: </p>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: darkblue;
            margin: 0;
            padding: 0;
        }
        
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px;
            background-color: skyblue;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .details {
            flex-grow: 1;
            margin-right: 20px;
            padding: 30px;
            margin-top: 30px;
            background-color: #fff;
            border-radius: 10px;
            margin-left: 150px;
            background-color: lightgreen;
        }
        
        .details h2 {
            margin-top: 0;
            color: #333;
        }
        
        .profile-photo {
            width: 450px;
            height: 200px;
            border-radius: 20px;
            margin-right: 150px;
            background-size: 30%;
            background-position: center;
            background-repeat: no-repeat ;
            background-image: url("Profile/pro.jpeg");
        }
        
        .footer {
            background-color: #393e46;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 200px;
        }
        
        .header {
            text-align: center;
            margin-top: 50px;
            color: #fff;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 2px;

        }
        
        .courses-list {
            margin-top: 20px;
            padding-left: 20px;
            list-style-type: square;
        }
        
        .courses-list li {
            color: #555;
            font-size: 16px;
            line-height: 24px;
        }
    </style>
</head>
<body>
    <h1 class="header">Student Profile</h1>
    <div class="container">
        <div class="details">
            <h2>Name: <?php echo $name; ?></h2>
            <p>Class: 716-A</p>
            <p>UID: <?php echo $uid; ?></p>
            <h3>Courses Opted:</h3>
            <ul class="courses-list">
                <li>DBMS</li>
                <li>Java</li>
                <li>Python</li>
                <li>C++</li>
            </ul>
        </div>
        <!-- <div class="profile-photo"></div> -->
        <div class="profile-photo">

        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2023 Chandigarh University. All rights reserved.</p>
    </footer>
</body>
</html>