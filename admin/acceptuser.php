
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<style>
	h3{
		margin-left: 650px;
		font-size: 30px;
		color:blue;
	}
      table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        font-family: Arial, sans-serif;
        font-size: 14px;
		
      }
	  .form{
		overflow: auto;
		display:flex;
		flex-direction :column;
		align-items: center;
		max-height:400px;
	  }
	   .head{
		position:sticky;
		z-index: 1;
		top:0;
	  }
      
      th, td {
        text-align: left;
        padding: 10px;
        border-bottom: 1px solid #ddd;
		text-align: center;
      }
      
      th {
        background-color: green;
        color: white;
      }
      
      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      
      tr:hover {
        background-color: #ddd;
      }
	  .txt{
		padding-top: 10px;
    	border-top-width: 2px;
		font-size: large;
	  }
	  .b1 {
  		display: inline-block;
 		 padding: 10px 20px;
 		 background-color: green;
 		 color: white;
 		 text-decoration: none;
  		border-radius: 5px;
  		transition: background-color 0.2s ease-in-out;
		}

		.b2 {
  		display: inline-block;
 		 padding: 10px 20px;
 		 background-color: red;
 		 color: white;
 		 text-decoration: none;
  		border-radius: 5px;
  		transition: background-color 0.2s ease-in-out;
		}

    </style>
    <div class="container"><br><br>
<div class="form">
<table id="myTable" border="3">
<thead class="head">
<tr>
<th>Fisrt name</th>
<th>Last Name</th>
<th>Email</th>
<th>Password</th>
<th>Phone no</th>
<th>Occupation</th>
<th>Open Document</th>
<th>Status</th>
<th>ACCEPT</th>
<th>REJECT</th>
</tr>
</thead>
<?php
$con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
	            $qry="select * from registration";
	            $result=$con->query($qry);

while($r=$result->fetch_assoc())
{ 
$usr=$r['email'];
echo "<tr>";
echo "<td>".$r['firstname']."</td>";
echo "<td>".$r['lastname']."</td>";
echo "<td>".$r['email']."</td>";
echo "<td>".$r['pass']."</td>";
echo "<td>".$r['phonenumber']."</td>";
echo "<td>".$r['occupation']."</td>";
$folder="../doc/".$r['doc'];
echo "<td><a href='".$folder."' target='_blank'><img src='../image/analysis.png' alt='Document' width='100' height='100'></a></td>";

echo "<td>".$r['status']."</td>";
echo '<td><a href="accept.php?acc='.$usr.'" class="b1">Accept</a></td>';
echo '<td><a href="reject.php?rej='.$usr.'" class="b2">Reject</a></td>
</tr>';
}
echo "</table>";
?>
</div>
<br><h4><a href="admindash.php">BACK</a></h4>
</div>

</body>
</html>  