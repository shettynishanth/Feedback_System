<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

// Create a connection to the database
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $room = $_POST['room'];

    $formData = $_POST; // All form data
    
    unset($formData['submit'], $formData['room']); // Remove submit and room fields

    // Prepare the INSERT statement
    $stmt = $pdo->prepare("INSERT INTO feeds (room, forms) VALUES (:room, :forms)");
    $forms = '';
    $i = 1;

    // Loop through the form data and build the string
    foreach ($formData as $label => $value) {
        $label = str_replace('_', ' ', $label); 
        $forms .= $i . ":-" . $label . "- " . $value . "\n<br>"; // Combine label and input value
        $i++;
    }

    // Bind values to the prepared statement
    $stmt->bindParam(':room', $room);
    $stmt->bindParam(':forms', $forms);

    // Execute the statement
    $stmt->execute();

    
}
echo'<script>alert( "Form data inserted successfully!")</script>';
    echo'<script>window.location.href="room.html";</script>';
?>
