
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
 		 background-color: blue;
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
<th>Id</th>
<th>User</th>
<th>Form</th>
<th>Roomcode</th>
<th>Delete</th>
</tr>
</thead>
<?php
$con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
	            $qry="select * from feedforms";
	            $result=$con->query($qry);

while($r=$result->fetch_assoc())
{ 
$usr=$r['id'];
echo "<tr>";
echo "<td>".$r['id']."</td>";
echo "<td>".$r['user']."</td>";
echo "<td style='cursor:default;'>".$r['form']."</td>";
echo "<td>".$r['roomcode']."</td>";
echo '<td><a href="delfeed.php?del='.$usr.'" class="b2">Delete</a></td>
</tr>';
}
echo "</table>";
?>
</div>
<br><h4><a href="admindash.php">BACK</a></h4>
</div>

</body>
</html>  