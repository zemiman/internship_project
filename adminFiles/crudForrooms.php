<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$blockId=mysqli_real_escape_string($conn,$input['block_id']);
$classrmId=mysqli_real_escape_string($conn,$input['classrm_id']);
$className=mysqli_real_escape_string($conn,$input['class_name']);
 

if ($input["action"]==='edit') {
	$sql1="UPDATE class_room SET class_name='".$className."', block_id='".$blockId."' WHERE classrm_id='".$classrmId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM class_room WHERE classrm_id='".$classrmId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>