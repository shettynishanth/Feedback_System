<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="udprof.css">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    $user = $_SESSION['user'];
    include 'dash.html';
    $con = mysqli_connect("localhost", "root", "", "feedback");
    if (mysqli_connect_errno()) {
        echo "Could not connect";
        exit;
    }
    
    // Fetching data from the database
    $qry = "SELECT * FROM registration WHERE email='$user'";
    $result = $con->query($qry);
    $row = $result->fetch_assoc();
    $n = $row['firstname'];
    $m = $row['lastname'];
    $b = $row['phonenumber'];
    $d = $row['pass'];
    $s = $row['occupation'];
    
    // Updating profile
    if (isset($_POST['dupdate'])) {
        $dname = $_POST['na'];
        $dmob = $_POST['mb'];
        $dadd = $_POST['ad'];
        $ddob = $_POST['db'];
        $dst = $_POST['st'];
        
        if ($n == $dname && $m == $dmob && $b == $dadd && $d == $ddob && $s == $dst) {
            echo "<script>alert('No changes were made');</script>";
            echo '<script>window.location.href="udprofile.php";</script>';
        } else {
            $uqry = "UPDATE registration SET firstname='$dname', lastname='$dmob', phonenumber='$dadd', pass='$ddob', occupation='$dst' WHERE email='$user'";
            $rlt = $con->query($uqry);
            if ($rlt) {
                echo "<script>alert('Updated successfully');</script>";
                echo '<script>window.location.href="dash.html";</script>';
            } else {
                die(mysqli_error($con));
            }
        }
    }
    ?>

    <div class="container">
        <header><b>Update profile</b></header>
        <form action="" method="POST" class="form">
            <div class="column">
                <div class="inputbox">
                    <label>First Name:</label>
                    <input type="text" name="na" value="<?php echo $n; ?>" required>
                </div>
                <div class="inputbox">
                    <label>Last Name:</label>
                    <input type="text" name="mb" value="<?php echo $m; ?>" required>
                </div>
            </div>
            <div class="column">
                <div class="inputbox">
                    <label>Mobile number:</label>
                    <input type="number" name="ad" value="<?php echo $b; ?>">
                </div>
                <div class="inputbox">
                    <label>Password:</label>
                    <input type="text" name="db" id="myDate" value="<?php echo $d; ?>">
                </div>
            </div>
            <div class="column">
                <div class="inputbox">
                    <label>Occupation:</label>
                    <select name="st" class="drp">
                        <option value="student" <?php if ($s == 'student') echo 'selected'; ?>>Student</option>
                        <option value="Business" <?php if ($s == 'Business') echo 'selected'; ?>>Business</option>
                        <option value="Other" <?php if ($s == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="dupdate" class="b1">Update</button>
            <a style="color:white;text-decoration:white;" href="dash.html"><button class="b1">back</a>

        </form>
    </div>
</body>
</html>