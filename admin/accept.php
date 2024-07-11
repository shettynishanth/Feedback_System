<?php
            if(isset($_GET['acc']))
            {
	            $em = $_GET['acc'];
				
	            $con=mysqli_connect("localhost","root","","feedback");
	            if(mysqli_connect_errno())
	            {
	            	echo"could not connect";
	            	exit;
	            }
				$ry="select status from registration where email='$em' and status='Accepted'";
				$rslt=$con->query($ry);
	            if($rslt->num_rows!=0)
	            {
                    echo"<script>alert('Already Accepted');</script>";
                    echo'<script>window.location.href="acceptuser.php";</script>';
	            }
				else
				{
	            $qry="update registration set status='Accepted' where email='$em'";
	            $rsl=$con->query($qry);
	            if($rsl)
	            {
                    echo"<script>alert('Accepted succesfully');</script>";
                    echo'<script>window.location.href="acceptuser.php";</script>';
	            }
	            else
	            {
	            	die(mysqli_error(($con)));
	            }
				}
				
            }
            ?>