<?php



 include_once'../includes/dbConnection.inc.php';
 if (isset($_POST['semester'])&&!empty($_POST['semester'])) {
 	  $semester=$_POST['semester'];
 	$sql="SELECT * FROM courses where semester='$semester' AND lab_requirement='Yes' ORDER BY course_name";
 	$result=mysqli_query($conn, $sql);
 	$rowcount=mysqli_num_rows($result);
 	if ($rowcount>0) {
 		echo '<option value="">select course</option>';
 		while ($row=mysqli_fetch_assoc($result)) {
 		echo '<option value="'.$row['course_id'].'">'.$row['course_name'].'</option>';

 		# code...
 	}
 		# code...
 	}else{
 		echo '<option value="">course value not available</option>';
 	}
 	
 	# code...
 }


 if (isset($_POST['course_id'])&&!empty($_POST['course_id'])) {
 	  $courseid=$_POST['course_id'];
 	$sql1="SELECT * FROM studentscourses where course_id='$courseid' ORDER BY st_id";
 	$result1=mysqli_query($conn, $sql1);
 	$rowcount1=mysqli_num_rows($result1);
 	if ($rowcount1) {
 		while ($row1=mysqli_fetch_assoc($result1)) {

 			$sql11="SELECT * FROM groupofstudent where st_id='".$row1['st_id']."' ORDER BY batch_name and section_name";
 			$result11=mysqli_query($conn, $sql11);
 	       $rowcount11=mysqli_num_rows($result11);
 	       if ($rowcount11>0) {
 	       	while ($row=mysqli_fetch_assoc($result11)) {
 	       		$sql3="SELECT * FROM department where dep_id='".$row['dep_id']."'";
 	       		$result3=mysqli_query($conn, $sql3);
 	       		while ($row3=mysqli_fetch_assoc($result3)) {
 	       			$depName=mysqli_real_escape_string($conn, $row3['dep_name']);
 	       			# code...
 	       		}

 	       		echo '<option value="'.$row['st_id'].'">'.$depName.": ".$row['batch_name']." ".$row['section_name'].'</option>';

 	       		# code...
 	       	}

 	       	
 	       	# code...
 	       }
 	       else{
 	       		echo '<option value="">students value not available</option>';

 	       	}

 		# code...
 	}
 		# code...
 	}else{
 		echo '<option value="">students value not available</option>';
 	}
 	
 	# code...
 }


 if (isset($_POST['dep_id'])&&!empty($_POST['dep_id'])) {
	$department=$_POST['dep_id'];
	$sql2="SELECT * FROM faculties where dep_id='$department' AND role IN('Assistant','Both') ORDER BY fname,lname";
	$result2=mysqli_query($conn, $sql2);
	$rowcount2=mysqli_num_rows($result2);
	if ($rowcount2>0) {
            while ($row=mysqli_fetch_assoc($result2)) {

            	echo '<option value="'.$row['lec_id'].'">'.$row['fname']." ".$row['lname'].'</option>';

            	# code...
            }
		# code...
	}else{


		echo '<option value="">lecturer value not available</option>';
	}
	# code...
}



if (isset($_POST['loc_id'])&&!empty($_POST['loc_id'])) {
	$locationid=$_POST['loc_id'];
	 

	$sql4="SELECT * FROM departmentlocation where loc_id='$locationid' ORDER BY dep_id";
	$result4=mysqli_query($conn, $sql4);
	$rowcount4=mysqli_num_rows($result4);
	if ($rowcount4>0) {
		while ($row1=mysqli_fetch_assoc($result4)) {
               

			$sql5="SELECT * FROM department WHERE dep_id='".$row1['dep_id']."' ORDER BY dep_name";
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			if ($rowcount5) {
				while ($row=mysqli_fetch_assoc($result5)) {
					echo '<option value="'.$row['dep_id'].'">'.$row['dep_name'].'</option>';

					# code...
				}
				# code...
			}
			// echo '<option value="'.$row['dep_id'].'">'.$row['loc_id'].'</option>';

			# code...
		}
		# code...
	}else{
		echo '<option value="">department value not available</option>';
	}
	# code...
}







 

?>