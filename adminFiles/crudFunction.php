<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$locationnmae=mysqli_real_escape_string($conn,$input['location_name']);
$collegeId=mysqli_real_escape_string($conn,$input['coll_id']);
$locId=mysqli_real_escape_string($conn,$input['loc_id']);

if ($input["action"]==='edit') {
	$sql1="UPDATE location SET location_name='".$locationnmae."', coll_id='".$collegeId."' WHERE loc_id='".$input["loc_id"]."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM location WHERE loc_id='".$input["loc_id"]."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>