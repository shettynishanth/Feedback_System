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

// Fetch the fields from the feedforms table for the user session
$query = "SELECT * FROM feedforms WHERE user = :user";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user', $user);
$stmt->execute();
$fields = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the roomcode from the submitted form
    $roomcode = $_POST['roomcode'];

    // Delete the field from the feedforms table based on the roomcode
    $deleteQuery = "DELETE FROM feedforms WHERE roomcode = :roomcode";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->bindParam(':roomcode', $roomcode);
    $deleteStmt->execute();

    // Redirect back to the user fields page after deletion
    echo '<script>alert("Room deleted successfully");</script>';
    echo '<script>window.location.href = "delete.php";</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Fields</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-image: url("../images/deleteimg.jpg");
            background-size: cover;
    background-position: center;
    background-repeat: no-repeat; */
        }

        h1 {
            text-align: center;
            text-decoration:underline;
            font-size:45px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border:4px solid black;
            text-align:center;
            font-size:20px;
            background-color:rgb(201, 245, 201);
           
        }


        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 2px solid black;
            border-right: 3px solid black;
            text-align:center;
            min-width:350px;
        }
       

        th {
            background-color:rgb(80, 132, 80);
            font-weight: bold;
            font-size:30px;
            border-bottom: 3px solid black;
            text-align:center;
        }

        td button {
            background-color:rgb(209, 21, 21);
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            text-align:center;
            height:60px;
            width:150px;
            font-size:25px;
            border:2px solid black;
        }
        td button:hover{
            background-color:red;
            font-size:30px;
            color: black;
           border:3px solid black;
        }
       

        tr:hover {
            background-color: #e9e9e9;
        }

        p.no-fields {
            text-align: center;
            margin-top: 20px;
        }
        table #roomcode{
            font-weight:bold;
            font-size:30px;
        }
    </style>
</head>
<body>
    <h1>Your Feedback Rooms</h1>

    <?php if (!empty($fields)): ?>
        <table>
            <tr>
                <th>Feeds</th>
                <th>Room Code</th>
                <th>Action</th>
            </tr>
            <?php foreach ($fields as $field): ?>
                <tr>
                    <td><?php echo $field['form']; ?></td>
                    <td id="roomcode"  ><?php echo $field['roomcode']; ?></td>
                    <td>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="roomcode" value="<?php echo $field['roomcode']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p class="no-fields">No fields found.</p>
    <?php endif; ?>

    <?php if (isset($_GET['update'])): ?>
        <h2>Update Field</h2>
        <form action="update.php" method="POST">
            <label for="form">Form:</label>
            <input type="text" name="form" id="form">
            <label for="roomcode">Room Code:</label>
            <input type="text" name="roomcode" id="roomcode">
            <button type="submit">Update</button>
        </form>
    <?php endif; ?>
</body>
</html>