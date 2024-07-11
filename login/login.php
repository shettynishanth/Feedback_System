<?php
session_start();
// Get the username and password from the form
$username = $_POST['mail'];

$password = $_POST['password'];

// Database connection details
$servername = "localhost";
$database = "feedback";
$username_db = "root";
$password_db = "";

// Create a database connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to fetch the admin details
$sqlAdmin = "SELECT * FROM admin WHERE email = '$username' AND password = '$password' ";

// Execute the query for admin
$resultAdmin = $conn->query($sqlAdmin);

// Prepare the SQL statement to fetch the user details
$sqlUser = "SELECT * FROM registration WHERE email = '$username' AND pass = '$password' AND status='Accepted'";

// Execute the query for user
$resultUser = $conn->query($sqlUser);

// Check if admin login was successful
if ($resultAdmin->num_rows > 0) {
    // Admin login successful
    header("Location:../admin/admindash.php");
} 
// Check if user login was successful
elseif ($resultUser->num_rows > 0) {
    // User login successful
    $_SESSION['user']=$username;
    echo "<script>alert('user login successfull');</script>";
    echo "<script>window.location.href ='../client/dash.html';</script>";
} 
else {
    echo "<script>alert('user login failed');</script>";
    // Login failed for both admin and user
    echo "<script>window.location.href ='../signin.html';</script>";
}

// Close the database connection
$conn->close();
?>
