<?php
include_once'../includes/dbConnection.inc.php';
$input=filter_input_array(INPUT_POST);
$courseId=mysqli_real_escape_string($conn,$input['course_id']);
$courseName=mysqli_real_escape_string($conn,$input['course_name']);
$credit=mysqli_real_escape_string($conn,$input['credit']);
$lecHour=mysqli_real_escape_string($conn,$input['lectureHour']);
$labHour=mysqli_real_escape_string($conn,$input['labHour']);
$labReq=mysqli_real_escape_string($conn,$input['lab_requirement']);
$semester=mysqli_real_escape_string($conn,$input['semester']);
$depId=mysqli_real_escape_string($conn,$input['dep_id']);

if ($input["action"]==='edit') {
	$sql1="UPDATE courses SET course_name='".$courseName."', credit='".$credit."', lectureHour='".$lecHour."', labHour='".$labHour."', lab_requirement='".$labReq."', dep_id='".$depId."', semester='".$semester."' WHERE course_id='".$courseId."'";
	mysqli_query($conn,$sql1);
	# code...
}

if ($input["action"]==='delete') {
	$sql2="DELETE FROM courses WHERE course_id='".$courseId."'";

	mysqli_query($conn,$sql2);

	# code...
}
echo json_encode($input);

?>