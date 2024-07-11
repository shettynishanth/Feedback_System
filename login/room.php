<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    
    </style>
</head>
<body>
    <h1>Please provide your valuable feedback</h1>
    <form action="submit.php" method="POST">
        <?php
        $room = $_POST['room'] ?? '';

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "feedback";

        // Create a connection to the database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT form FROM feedforms WHERE roomcode = :room";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':room', $room);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo $row['form'];
            // echo $decodedContent;
            echo '<input type="hidden" name="room" value="' . htmlspecialchars($room) . '">';
        } else {
            echo '<script>alert("No such room found");</script>';
            echo '<script>window.location.href = "room.html";</script>';
        }
        ?>

        <input type="submit" name="submit" value="Submit Feedback">
    </form>
</body>
</html>
