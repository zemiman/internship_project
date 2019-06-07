<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$semInId=mysqli_real_escape_string($conn,$input['semIn_id']);
$collegeId=mysqli_real_escape_string($conn,$input['coll_id']);
$startDatev=mysqli_real_escape_string($conn,$input['startDate']);
$endtDate=mysqli_real_escape_string($conn,$input['endDate']);

if ($input["action"]==='edit') {
	$sql1="UPDATE semesterinterval SET startDate='".$startDatev."', endDate='".$endtDate."' WHERE semIn_id='".$semInId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM semesterinterval WHERE semIn_id='".$semInId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>