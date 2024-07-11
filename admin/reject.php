<?php
            if(isset($_GET['rej']))
            {
	            $em = $_GET['rej'];
				
	            $con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
				$ry="select status from registration where email='$em' and status='Rejected'";
				$rslt=$con->query($ry);
	            if($rslt->num_rows!=0)
	            {
                    echo"<script>alert('Already Rejected');</script>";
                    echo'<script>window.location.href="acceptuser.php";</script>';
	            }
				else
				{
	            $qry="update registration set status='Rejected' where email='$em'";
	            $rsl=$con->query($qry);
	            if($rsl)
	            {
                    echo"<script>alert('Rejected succesfully');</script>";
                    echo'<script>window.location.href="acceptuser.php";</script>';
	            }
	            else
	            {
	            	die(mysqli_error(($con)));
	            }
				}
				
            }
            ?>