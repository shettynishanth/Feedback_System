<?php
// Assuming you have a database with the following configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $occupation = $_POST['occupation'];

    $targetDirectory = 'doc/';
    $targetFile = $targetDirectory . $_FILES['image']['name'];
    $doc=$_FILES['image']['name'];

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        echo 'Image uploaded successfully!';
      } else {
        echo 'Failed to upload image.';
      }

    // Insert the data into the database table
    $sql = "INSERT INTO registration (firstname, lastname, email, phonenumber, occupation, doc, status) 
            VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$occupation', '$doc','pending')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
