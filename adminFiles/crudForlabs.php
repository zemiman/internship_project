<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$blockId=mysqli_real_escape_string($conn,$input['block_id']);
$labrmId=mysqli_real_escape_string($conn,$input['labrm_id']);
$labName=mysqli_real_escape_string($conn,$input['lab_name']);
 

if ($input["action"]==='edit') {
	$sql1="UPDATE lab_room SET lab_name='".$labName."', block_id='".$blockId."' WHERE labrm_id='".$labrmId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM lab_room WHERE labrm_id='".$labrmId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>