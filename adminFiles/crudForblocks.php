<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$blockId=mysqli_real_escape_string($conn,$input['block_id']);
$locId=mysqli_real_escape_string($conn,$input['loc_id']);
$blockName=mysqli_real_escape_string($conn,$input['block_name']);
 

if ($input["action"]==='edit') {
	$sql1="UPDATE block SET loc_id='".$locId."', block_name='".$blockName."' WHERE block_id='".$blockId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM block WHERE block_id='".$blockId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>