<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$depName=mysqli_real_escape_string($conn,$input['dep_name']);
$collegeId=mysqli_real_escape_string($conn,$input['coll_id']);
$depId=mysqli_real_escape_string($conn,$input['dep_id']);

if ($input["action"]==='edit') {
	$sql1="UPDATE department SET dep_name='".$depName."', coll_id='".$collegeId."' WHERE dep_id='".$input["dep_id"]."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM department WHERE dep_id='".$input["dep_id"]."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>