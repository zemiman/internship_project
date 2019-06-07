<?php
session_start();
 include_once'../includes/dbConnection.inc.php';

 if (isset($_POST['semester'])&&!empty($_POST['semester'])) {
 	  $semester=$_POST['semester'];
 	  $college_id=$_SESSION['coll_id'];


 	  $sql1="SELECT * FROM department where coll_id='$college_id'";
 	  $result1=mysqli_query($conn, $sql1);
 	  $rowcount1=mysqli_num_rows($result1);
 	  if ($rowcount1>0) {
 	  	while ($row1=mysqli_fetch_assoc($result1)) {
 	  		$depId=$row1['dep_id'];


 	$sql="SELECT * FROM courses where semester='$semester' AND dep_id='$depId' AND lab_requirement='Yes' ORDER BY course_name ASC";
 	$result=mysqli_query($conn, $sql);
 	$rowcount=mysqli_num_rows($result);
 	if ($rowcount>0) {
 		// echo '<option value="">select course</option>';
 		while ($row=mysqli_fetch_assoc($result)) {
 		echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';

 		# code...
 	}//End of 2nd while loop:
 		# code...
 	}

 	// else{
 	// 	echo '<option value="">course value not available</option>';
 	//             }
 	  		# code...
 	  	}//end of first while loop
 	  	# code...
 	  }else{
 		echo '<option value="">course value not available</option>';
 	            }



 	
 	# code...
 }

?>