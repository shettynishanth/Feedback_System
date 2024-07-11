<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    
    #sidebar {
      background-color: #333;
      color: #fff;
      width: 200px;
      height: 100vh;
      padding: 20px;
      box-sizing: border-box;
      float: left;
    }
    
    #content {
      padding: 20px;
      box-sizing: border-box;
      margin-left: 200px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      gap: 20px;
    }
    
    .module {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      flex-basis: calc(33.33% - 20px);
      box-sizing: border-box;
      margin-bottom: 20px;
    }
    
    .module h2 {
      color: #333;
      font-size: 20px;
      margin-top: 0;
      margin-bottom: 10px;
    }
    
    .module p {
      color: #777;
      line-height: 1.4;
    }
    
    #sidebar ul {
      list-style: none;
      padding: 0;
    }
    
    #sidebar ul li {
      margin-bottom: 10px;
    }
    
    #sidebar ul li a {
      color: #fff;
      text-decoration: none;
      padding: 10px;
      display: block;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .module h2 {
      color: #777;
      line-height: 1.4;
      font-size: 20px;
      font-weight: bold;
      text-align: center;
    }
    .module p {
      color: #777;
      line-height: 1.4;
      font-size: 30px;
      font-weight: bold;
      text-align: center;
    }
    
    #sidebar ul li a:hover {
      background-color: #555;
    }
    
    #sidebar ul li a.active {
      background-color: #555;
      font-weight: bold;
    }
    #content {
      gap: 20px;
    }
    
    #admin-heading {
      position: absolute;
      top: 20px;
      left: 270px;
      font-size: 30px;
      color:  rgba(0, 0, 0, 0.5);;
    }

    /* Dropdown Menu Styles */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #555;
      min-width: 120px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: #fff;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #444;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
    ul{
      padding:50px;
    }
  </style>
</head>
<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "feedback";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $qr = "select * from registration";
    $re = $conn->query($qr);
    $usr = $re->num_rows;

    $q = "select * from feedforms";
    $r = $conn->query($q);
    $fd = $r->num_rows;
  ?>
  <div id="sidebar">
    <h1>Dashboard</h1>
    <ul>
      <li><a href="admindash.php" style="margin-bottom:50px;">Dashboard</a></li>
      <li class="dropdown">
        <a href="#" class="dropbtn" >User</a>
        <div class="dropdown-content">
          <a href="acceptuser.php">Manage User</a>
          <a href="viewuser.php">View User</a>
        </div>
      </li>
      <li><a href="viewfeed.php" style="margin-top:60px;">View feedback</a></li>
    </ul>
  </div>
  
  <div id="content">
    <div class="module">
      <h2>No of User</h2>
      <p><?php echo $usr; ?></p>
    </div>
  
    <div class="module">
      <h2>No of feedback created</h2>
      <p><?php echo $fd; ?></p>
    </div>
  </div>

  <h1 id="admin-heading">Admin</h1>
</body>
</html>
