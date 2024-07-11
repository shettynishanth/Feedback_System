<!DOCTYPE html>
<html>
<head>
  <title>Display Generated HTML</title>
</head>
<body>
  <h2>Generated HTML</h2>

  <?php
  session_start();
    if (isset($_GET['html'])) {
      $form = $_GET['html'];

      // Generate a unique PIN code
      $pinCode = generateUniquePinCode();

      // Insert the user, form, and generated PIN code into the feedforms table
      insertFormData($_SESSION['user'], $form, $pinCode);
    }

    function generateUniquePinCode() {
      // Connect to your database
      $conn = new mysqli('localhost', 'root', '', 'feedback');

      // Check if the connection was successful
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Generate a PIN code inside a loop until it is unique
      do {
        $pinCode = mt_rand(100000, 999999);
      } while (!isPinCodeAvailable($conn, $pinCode));

      // Close the database connection
      $conn->close();

      return $pinCode;
    }

    function isPinCodeAvailable($conn, $pinCode) {
      // Check if the PIN code exists in the feedforms table
      $sql = "SELECT * FROM feedforms WHERE roomcode = '$pinCode'";
      $result = $conn->query($sql);

      // If any row is returned, the PIN code is already taken
      if ($result->num_rows > 0) {
        return false;
      }

      return true;
    }

    function insertFormData($user, $form, $pinCode) {
      // Connect to your database
      $conn = new mysqli('localhost', 'root', '', 'feedback');

      // Check if the connection was successful
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Insert the user, form, and PIN code into the feedforms table
      $sql = "INSERT INTO feedforms (user, form, roomcode) VALUES ('$user', '$form', '$pinCode')";
      if ($conn->query($sql) === TRUE) {
        echo "<script>alert('room created successfully with pin as $pinCode');</script>";
        echo "<script>window.location.href = 'dash.html';</script>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Close the database connection
      $conn->close();
    }
  ?>
</body>
</html>
