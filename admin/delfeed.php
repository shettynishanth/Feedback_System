<?php
            if(isset($_GET['del']))
            {
	            $em = $_GET['del'];

	            $con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
				
	            $qry="delete from feedforms where id='$em'";
	            $rslt=$con->query($qry);
	            if($rslt)
	            {
                    echo"<script>alert('Deleted succesfully');</script>";
                    echo'<script>window.location.href="viewfeed.php";</script>';
	            }
	            else
	            {
	            	die(mysqli_error(($con)));
	            }
				
            }
            ?>