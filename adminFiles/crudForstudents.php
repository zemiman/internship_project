<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$batchName=mysqli_real_escape_string($conn,$input['batch_name']);
$secName=mysqli_real_escape_string($conn,$input['section_name']);
$stId=mysqli_real_escape_string($conn,$input['st_id']);
$depId=mysqli_real_escape_string($conn,$input['dep_id']);

if ($input["action"]==='edit') {
	$sql1="UPDATE groupofstudent SET batch_name='".$batchName."', section_name='".$secName."', dep_id='".$depId."' WHERE st_id='".$stId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM groupofstudent WHERE st_id='".$stId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>