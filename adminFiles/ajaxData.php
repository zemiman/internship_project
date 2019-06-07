<?php

// <i class="fas fa-chevron-up"></i>
// <i class="fas fa-angle-up"></i>
// <i class="fas fa-arrow-up"></i>


 include_once'../includes/dbConnection.inc.php';
 

  if (isset($_POST['college_Id'])&&!empty($_POST['college_Id'])) {
 	  $collegeId=$_POST['college_Id'];
 	$sql="SELECT * FROM department where coll_id='$collegeId' ORDER BY dep_name ASC";
 	$result=mysqli_query($conn, $sql);
 	$rowcount=mysqli_num_rows($result);
 	if ($rowcount>0) {
 		echo '<option value="">select department</option>';
 		while ($row=mysqli_fetch_assoc($result)) {
 		echo '<option value="'.$row['dep_id'].'" style="font-style: italic; font-size: 12px; display: inline-block; font-weight: bold; padding-top: 12px; overflow-y: scroll;">'.$row['dep_name'].'</option>';

 		# code...
 	}
 		# code...
 	}else{
 		echo '<option value="" style="font-style: italic; font-size: 12px; display: inline-block; font-weight: bold; padding-top: 12px; overflow-y: scroll;">department value not available</option>';
 	}
 	
 	# code...
 }

  if (isset($_POST['user_departmentId'])&&!empty($_POST['user_departmentId'])) {
 	  $departmentId=$_POST['user_departmentId'];
 	$sql="SELECT * FROM groupofstudent where dep_id='$departmentId' ORDER BY batch_name, section_name";
 	$result=mysqli_query($conn, $sql);
 	$rowcount=mysqli_num_rows($result);
 	if ($rowcount>0) {
 		echo '<option value="">select section</option>';
 		while ($row=mysqli_fetch_assoc($result)) {

 		echo '<option value="'.$row['st_id'].'" style="font-style: italic; font-size: 12px; display: inline-block; font-weight: bold; padding-top: 12px; overflow-y: scroll;">'.$row['batch_name'].' '.$row['section_name'].'</option>';

 		# code...
 	}
 		# code...
 	}else{
 		echo '<option value="" style="font-style: italic; font-size: 12px; display: inline-block; font-weight: bold; padding-top: 12px; overflow-y: scroll;">section value not available</option>';
 	}
 	
 	# code...
 }
 
 if (isset($_POST['semester'])&&!empty($_POST['semester'])) {
 	  $semester=$_POST['semester'];
 	$sql="SELECT * FROM courses where semester='$semester' ORDER BY course_name ASC";
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
 	$sql1="SELECT * FROM studentscourses where course_id='$courseid'";
 	$result1=mysqli_query($conn, $sql1);
 	$rowcount1=mysqli_num_rows($result1);
 	if ($rowcount1>0) {
 		while ($row1=mysqli_fetch_assoc($result1)) {

 			$sql11="SELECT * FROM groupofstudent where st_id='".$row1['st_id']."' ORDER BY batch_name, section_name";
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
	$sql2="SELECT * FROM faculties where dep_id='$department' AND role IN('Instructor','Both') ORDER BY fname,lname";
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
	$locId=$_POST['loc_id'];
	$sql2="SELECT * FROM block where loc_id='$locId' ORDER BY block_name";
	$result2=mysqli_query($conn, $sql2);
	$rowcount2=mysqli_num_rows($result2);
	if ($rowcount2>0) {
            while ($row=mysqli_fetch_assoc($result2)) {

            	echo '<option value="'.$row['block_id'].'">'.$row['block_name'].'</option>';

            
            }

		# code...
	}else{


		echo '<option value="">lecturer value not available</option>';
	}
	# code...
}


 



if (isset($_POST['lab_requirement'])&&!empty($_POST['lab_requirement'])) {
	$labRequirement=$_POST['lab_requirement'];
	 
	if ($labRequirement=='Yes') {
        echo '<option value="">Required one</option>';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option>';
		echo '<option value="3">3</option>';
		echo '<option value="4">4</option>';
		// echo '<option value="5">5</option>';
		 
		# code...
	}elseif ($labRequirement=='No') {
		// echo '<option value="">Required one</option>';
		echo '<option value="0">0</option>';
		# code...
	}else{
		echo '<option value="">lab hour value not available</option>';
	}

 

 	# code...
}


 

 
?>