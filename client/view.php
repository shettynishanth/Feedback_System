<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback";

// Create a connection to the database
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the user session value
$user = $_SESSION['user'];

// Fetch the roomcodes belonging to the user from the feedforms table
$query = "SELECT roomcode FROM feedforms WHERE user = :user";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user', $user);
$stmt->execute();
$roomcodes = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch the records from the feeds table for the user's roomcodes
$query = "SELECT * FROM feeds WHERE room IN (".implode(',', array_fill(0, count($roomcodes), '?')).")";
$stmt = $pdo->prepare($query);
$stmt->execute($roomcodes);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feeds</title>
    <style>
        table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  border: 1px solid black;
}
th{
    background-color: green;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:nth-child(odd) {
  background-color: #ffffff;
}

tr:hover {
  background-color: #ddd;
}
        </style>
</head>
<body>
    <h1>User Feeds</h1>
    <a  href="dash.html">back</a>

    <?php if (!empty($records)): ?>
        <table>
            <tr>
        
                <th>Room Code</th>
                <th>Feed Content</th>
            </tr>
            <?php foreach ($records as $record): ?>
                <tr>
                
                    <td><?php echo $record['room']; ?></td>
                    <td><?php echo $record['forms']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No feeds found.</p>
    <?php endif; ?>

</body>
</html>
