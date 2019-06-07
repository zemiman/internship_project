<?php
 session_start();
if (isset($_POST['submit'])) {
	include'dbConnection.inc.php';
	# code...
	$username=mysqli_real_escape_string($conn,$_POST['user']);
	$psw=mysqli_real_escape_string($conn,$_POST['psw']);
	if ($username==""||$psw=="") {
		$_SESSION['error']=' username or password was not filled';
		header("Location:../index.php");
		 exit();

		# code...
	}else{
		
		$sql="SELECT * FROM users where username='$username'";
		$result=mysqli_query($conn,$sql);
		$checkresult=mysqli_num_rows($result);
		if ($checkresult<1) {
			$_SESSION['error']=' Invalid username or password!';
			header("Location: ../index.php");
	        exit();
	        // $_SESSION['error']=' Invalid username or password!';
			# code...
		}else{
			if ($row=mysqli_fetch_assoc($result)) {
				$hashedpsw=PASSWORD_VERIFY($psw,$row['psw']);
				if ($hashedpsw==false) {
					$_SESSION['error']=' your password did not match!';
					header("Location: ../index.php");
	                      exit();
					# code...
				}elseif ($hashedpsw==true) {

					$_SESSION['ur_id']=$row['id'];
					$_SESSION['ur_name']=$row['username'];
					$_SESSION['ur_psw']=$row['psw'];
					$_SESSION['ur_email']=$row['email'];
					$_SESSION['ur_role']=$row['role'];
					$username2=$row['username'];
					$password2=$row['psw'];
					$role=$row['role'];
					$email=$row['email'];

					if ($role=="admin"||$role=="superAdmin") {
						$sql1="SELECT * FROM admin WHERE username='".$username2."' AND password='".$password2."' AND email='".$email."' AND role='".$role."'";
						$result1=mysqli_query($conn,$sql1);
						$rowcount1=mysqli_num_rows($result1);
						if ($rowcount1>0) {
							while ($row1=mysqli_fetch_assoc($result1)) {
								$collegeId=mysqli_real_escape_string($conn, trim($row1['coll_id']));
								$adminId=mysqli_real_escape_string($conn, trim($row1['admin_id']));
								$_SESSION['coll_id']=$collegeId;
								
								# code...
							}
							if ($role=="admin") {
								$_SESSION['admin_id']=$adminId;
								$_SESSION['success']=' you are signed successfully!';
							    header("Location: ../adminFiles/adminPage.php");
	                             exit();

								# code...
							}
							elseif ($role=="superAdmin") {
								$_SESSION['superAdmin_id']=$adminId;
								$_SESSION['success']=' you are signed successfully!';
								header("Location: ../superAdminFiles/adminPage.php");
	                               exit();
								# code...
							}
						# code...
						}else{
							$_SESSION['error']=' username or password is not set yet!';
							header("Location: ../index.php");
							exit();

						}
						# code...
					}//end of if for role==admin and superadmin:
					elseif ($role=="user") {
						$sql2="SELECT * FROM faculties WHERE username='".$username2."' AND password='".$password2."' AND email='".$email."'";
						$result2=mysqli_query($conn,$sql2);
						$rowcount2=mysqli_num_rows($result2);
						if ($rowcount2>0) {
							while ($row2=mysqli_fetch_assoc($result2)) {
								$lecId=mysqli_real_escape_string($conn, trim($row2['lec_id']));
								$depId=mysqli_real_escape_string($conn, trim($row2['dep_id']));
								$_SESSION['lec_id']=$lecId;
								# code...
							}
						 $sql3="SELECT * FROM department WHERE dep_id='".$depId."'";
						 $result3=mysqli_query($conn, $sql3);
						 if ($result3) {
						 	while ($row3=mysqli_fetch_assoc($result3)) {
						 		$collegeId=mysqli_real_escape_string($conn, trim($row3['coll_id']));
						 		$_SESSION['coll_id']=$collegeId;


						 		# code...
						 	}

                            $_SESSION['success']=' you are signed successfully!';
						 	header("Location: ../userFiles/userPage.php");
	                               exit();



						 	# code...
						 }//end of if for result3==true:


							# code...
						}else{
							header("Location: ../index.php?login=your passwor or username is not set yet!");

						}



					}//End of elseif for 
                    
					# code...
				}
				# code...
			}
		}
	}//End of else for emptiness:


}//End of if for is submit set:
else{
	header("Location: ../index.php");
	               exit();
}
?>