<?php
            if(isset($_GET['de']))
            {
	            $em = $_GET['de'];

	            $con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
				
	            $qry="delete from registration where email='$em'";
	            $rslt=$con->query($qry);
	            if($rslt)
	            {
                    echo"<script>alert('Deleted succesfully');</script>";
                    echo'<script>window.location.href="viewuser.php";</script>';
	            }
	            else
	            {
	            	die(mysqli_error(($con)));
	            }
				
            }
            ?>