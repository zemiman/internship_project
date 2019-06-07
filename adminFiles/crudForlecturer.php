<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);

$lecId=mysqli_real_escape_string($conn,$input['lec_id']);
$fname=mysqli_real_escape_string($conn,$input['fname']);
$lname=mysqli_real_escape_string($conn,$input['lname']);
$email=mysqli_real_escape_string($conn,$input['email']);
$role=mysqli_real_escape_string($conn,$input['role']);
$depId=mysqli_real_escape_string($conn,$input['dep_id']);
$username=mysqli_real_escape_string($conn,$input['username']);

if ($input["action"]==='edit') {
	$sql1="UPDATE faculties SET fname='".$fname."', lname='".$lname."', dep_id='".$depId."', email='".$email."', role='".$role."', username='".$username."' WHERE lec_id='".$input["lec_id"]."'";
	mysqli_query($conn,$sql1);
	$sql2="SELECT * FROM faculties WHERE lec_id='".$lecId."'";
        $result2=mysqli_query($conn,$sql2);
        $rowcount=mysqli_num_rows($result2);
        if ($rowcount>0) {
        	while ($row=mysqli_fetch_assoc($result2)) {
        		$psw=mysqli_real_escape_string($conn, $row['password']);

        		# code...
        	}
       $sql3="UPDATE users SET username='".$username."', email='".$email."' WHERE psw='".$psw."'";
	    mysqli_query($conn,$sql3);

        	
        }
	# code...
}//End of if condition for edit:

if ($input["action"]==='delete') {
	$sql3="SELECT * FROM faculties WHERE lec_id='".$lecId."'";
        $result3=mysqli_query($conn,$sql3);
        $rowcount=mysqli_num_rows($result3);
        if ($rowcount>0) {
        	while ($row=mysqli_fetch_assoc($result3)) {
        		$username=mysqli_real_escape_string($conn, $row['username']);

        		# code...
        	}
       $sql4="DELETE FROM users WHERE username='".$username."'";
	    mysqli_query($conn,$sql4);

        	
        }
	$sql2="DELETE FROM faculties WHERE lec_id='".$input["lec_id"]."'";

	mysqli_query($conn,$sql2);
	

	# code...
}//End of if condition for delete:
echo json_encode($input);

?>