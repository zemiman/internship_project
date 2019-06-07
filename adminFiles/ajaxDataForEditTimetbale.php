<?php
include_once'../includes/dbConnection.inc.php';

if (isset($_POST['endtime_value'])) {
 	$endTimeValue=$_POST['endtime_value'];
 	$starttimeValue=$_POST['start_time'];
 	$stId=$_POST['st_ID'];
 	$courseId=$_POST['course_Id'];
 	$classrmId=$_POST['room_Id'];
 	$lecId=$_POST['lec_Id'];
 	$day=$_POST['days'];
 	$oldStartTime=$_POST['oldStartTime'];
 	$oldEndTime=$_POST['oldEndTime'];
 	$statuschecking=$_POST['statuschecking'];
    $timeDiff1=$_POST['timeDiff1'];

 	 $datetime1 = new DateTime($oldStartTime);
     $datetime2 = new DateTime($oldEndTime);
     $interval = $datetime2->diff($datetime1);
     $timediffold=$interval->format('%H');
 	 $timediffold=(int)($timediffold);
 	 
 	 $datetime1 = new DateTime($starttimeValue);
     $datetime2 = new DateTime($endTimeValue);
     $interval = $datetime2->diff($datetime1);
     $timediff=$interval->format('%H');
 	$timediff=(int)($timediff);
 	// echo "time diff".$timediff;

 	//TO FETCH FACULTIES' ROLE FROM faculties table:
    $sql30="SELECT * FROM faculties   WHERE lec_id='$lecId'";
    $result30=mysqli_query($conn, $sql30);
    while ($row30=mysqli_fetch_assoc($result30)) {
      $Role=mysqli_real_escape_string($conn, $row30['role']);


      
     }

     $sql25="SELECT * FROM groupofstudent WHERE st_id='$stId'";
    $result25=mysqli_query($conn, $sql25);
    $rowcount25=mysqli_num_rows($result25);
     if ($rowcount25>0) {
       while ($row25=mysqli_fetch_assoc($result25)) {
        $depId=mysqli_real_escape_string($conn, ($row25['dep_id']));

     }
 }


    backClassRoom:
    backFromlabRoomGenerator:
    // ============================
    // // checking time difference
    // ============================

   if ($timediff==$timediffold) {
   	        $value=strtotime($starttimeValue);
			$endTime1 = strtotime("+1 hours", $value);
			$endTime1=date('h:i', $endTime1);
			$endTime2 = strtotime("-1 hours", $value);
			$endTime2=date('h:i', $endTime2);
			$endTime3 = strtotime("-2 hours", $value);
			$endTime3=date('h:i', $endTime3);
			$endTime4 = strtotime("-3 hours", $value);
			$endTime4=date('h:i', $endTime4);
			$endTime5 = strtotime("+2 hours", $value);
			$endTime5=date('h:i', $endTime5);

   	 if ($statuschecking=='lecture') {
   	 	# code...
   	 
     
		 if ($timediff==1) {
		 
			$sql1="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND ending_time='$endTime1' AND days='$day'";        
			$sql3="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql4="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime2' AND days='$day'";
			$sql5="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime3' AND days='$day'";
			  
			$result1=mysqli_query($conn, $sql1);
			$rowcount1=mysqli_num_rows($result1);
			$result2=mysqli_query($conn, $sql2);
			$rowcount2=mysqli_num_rows($result2);        
			$result3=mysqli_query($conn, $sql3);
			$rowcount3=mysqli_num_rows($result3);
			$result4=mysqli_query($conn, $sql4);
			$rowcount4=mysqli_num_rows($result4);
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			if ($rowcount1>=1||$rowcount2>=1||$rowcount3>=1||$rowcount4>=1||$rowcount5>=1) {
				$stIdvalue='not_available';
				$lecIdvalue=$lecId;

				# code...
			}else{
				$stIdvalue=$stId;



			if ($Role=='Both') {
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
			    $sql8="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql10="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);
			    $result9=mysqli_query($conn, $sql9);
			    $rowcount9=mysqli_num_rows($result9);
			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1||$rowcount10>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;
			    	
			        // backClassRoom:
			        $classrmId=classRoomGenerator($depId, $conn);

			    	$sql11="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
			        // $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);

			        if ($rowcount11>=1||$rowcount12>=1) {
			        	// $classrmId=classRoomGenerator($depId, $conn);
			             goto backClassRoom;
			    	 
			    	# code...
			       }
			    


			    }//end of else for lecture available:

				 
			}else{
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);

			    if ($rowcount6>=1||$rowcount7>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;

			    	 
			    	$classrmId=classRoomGenerator($depId, $conn);
			    	$sql11="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
			        // $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);

			        if ($rowcount11>=1||$rowcount12>=1) {
			        	// $classrmId=classRoomGenerator($depId, $conn);
			             goto backClassRoom;
			    	 
			    	# code...
			       }


			    }//End of else for lec id available:


			}//end of else for faculty availability:
			}//end fo else for section availability:

         
		  
		  }// End of if for timediff==1:
		 elseif ($timediff==2) {

			$sql1="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND ending_time='$endTime1' AND days='$day'"; 
			$sql3="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";        
			$sql4="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql5="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime2' AND days='$day'";
			$sql16="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime3' AND days='$day'";
			$sql17="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";
			  
			$result1=mysqli_query($conn, $sql1);
			$rowcount1=mysqli_num_rows($result1);
			$result2=mysqli_query($conn, $sql2);
			$rowcount2=mysqli_num_rows($result2);        
			$result3=mysqli_query($conn, $sql3);
			$rowcount3=mysqli_num_rows($result3);
			$result4=mysqli_query($conn, $sql4);
			$rowcount4=mysqli_num_rows($result4);
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			$result16=mysqli_query($conn, $sql16);
			$rowcount16=mysqli_num_rows($result16);
			$result17=mysqli_query($conn, $sql17);
			$rowcount17=mysqli_num_rows($result17);
			if ($rowcount1>=1||$rowcount2>=1||$rowcount3>=1||$rowcount4>=1||$rowcount5>=1||$rowcount16>=1||$rowcount17>=1) {
				$stIdvalue='not_available';
				$lecIdvalue=$lecId;

				# code...
			}else{
				$stIdvalue=$stId;



			if ($Role=='Both') {
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
			    $sql8="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
			    $sql9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql10="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql211="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $sql212="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);
			    $result9=mysqli_query($conn, $sql9);
			    $rowcount9=mysqli_num_rows($result9);
			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    $result211=mysqli_query($conn, $sql211);
			    $rowcount211=mysqli_num_rows($result211);
			    $result212=mysqli_query($conn, $sql212);
			    $rowcount212=mysqli_num_rows($result212);
			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1||$rowcount10>=1||$rowcount211>=1||$rowcount212>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;
			    	
			        // backClassRoom:
			        $classrmId=classRoomGenerator($depId, $conn);

			    	$sql11="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
			        $sql13="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1) {
			        	// $classrmId=classRoomGenerator($depId, $conn);
			             goto backClassRoom;
			    	 
			    	# code...
			       }
			    


			    }//end of else for lecture available:

				 
			}else{
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
			    $sql8="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);


			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;	 
			    	$classrmId=classRoomGenerator($depId, $conn);
			    	$sql11="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
			        $sql13="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1) {            	 
			            goto backClassRoom;
			    	 
			       }


			    }//End of else for lec id available:


			}//end of else for faculty availability:
			}//end fo else for section availability:

			 
			 	 
			 }//End of elseif for timediff==2;
		 elseif ($timediff==3) {
		 	$lecIdvalue='not_available';
			$stIdvalue='not_available';
			 
		 }//End of elseif for timediff==3:




 	 }//End of if for statuschecking==lecture:
 	 elseif ($statuschecking=='lab') {
 	 	//==========================================
 	 	//lab checking part:
 	 	//=========================================
 	 	if ($timediff==1) {
			$sql1="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND ending_time='$endTime1' AND days='$day'";        
			$sql3="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql4="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime2' AND days='$day'";
			$sql5="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime3' AND days='$day'";
			  
			$result1=mysqli_query($conn, $sql1);
			$rowcount1=mysqli_num_rows($result1);
			$result2=mysqli_query($conn, $sql2);
			$rowcount2=mysqli_num_rows($result2);        
			$result3=mysqli_query($conn, $sql3);
			$rowcount3=mysqli_num_rows($result3);
			$result4=mysqli_query($conn, $sql4);
			$rowcount4=mysqli_num_rows($result4);
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			if ($rowcount1>=1||$rowcount2>=1||$rowcount3>=1||$rowcount4>=1||$rowcount5>=1) {
				$stIdvalue='not_available';
				$lecIdvalue=$lecId;

				# code...
			}else{
				$stIdvalue=$stId;

			if ($Role=='Both'){
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
			    $sql8="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql10="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);
			    $result9=mysqli_query($conn, $sql9);
			    $rowcount9=mysqli_num_rows($result9);
			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1||$rowcount10>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;
			        $classrmId=labRoomGenerator($conn, $courseId);

			    	$sql11="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql13="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        // $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1) {
			        	// $labrmId=
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }
		

			    }//end of else for lecture available:

				 
			}else{
			    $sql6="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql18="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);

			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;

			    	$classrmId=labRoomGenerator($conn, $courseId);

			    	$sql11="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql13="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        // $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1) {
			        	// $labrmId=
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }


			    }//End of else for lec id available:


			}//end of else for faculty availability:
			}//end fo else for section availability:

      
		  
		  }// End of if for timediff==1:
		 elseif ($timediff==2) {		 	
			$sql1="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND ending_time='$endTime1' AND days='$day'"; 
			$sql3="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";        
			$sql4="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql5="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime2' AND days='$day'";
			$sql16="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime3' AND days='$day'";
			$sql17="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";
			$result1=mysqli_query($conn, $sql1);
			$rowcount1=mysqli_num_rows($result1);
			$result2=mysqli_query($conn, $sql2);
			$rowcount2=mysqli_num_rows($result2);        
			$result3=mysqli_query($conn, $sql3);
			$rowcount3=mysqli_num_rows($result3);
			$result4=mysqli_query($conn, $sql4);
			$rowcount4=mysqli_num_rows($result4);
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			$result16=mysqli_query($conn, $sql16);
			$rowcount16=mysqli_num_rows($result16);
			$result17=mysqli_query($conn, $sql17);
			$rowcount17=mysqli_num_rows($result17);
			if ($rowcount1>=1||$rowcount2>=1||$rowcount3>=1||$rowcount4>=1||$rowcount5>=1||$rowcount16>=1||$rowcount17>=1) {
				$stIdvalue='not_available';
				$lecIdvalue=$lecId;

				# code...
			}else{
				$stIdvalue=$stId;

			if ($Role=='Both') {
				$sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
			    $sql8="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
			    $sql9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql10="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql211="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $sql212="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);
			    $result9=mysqli_query($conn, $sql9);
			    $rowcount9=mysqli_num_rows($result9);
			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    $result211=mysqli_query($conn, $sql211);
			    $rowcount211=mysqli_num_rows($result211);
			    $result212=mysqli_query($conn, $sql212);
			    $rowcount212=mysqli_num_rows($result212);
			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1||$rowcount10>=1||$rowcount211>=1||$rowcount212>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;
			    	$classrmId=labRoomGenerator($conn, $courseId);
			    	$sql11="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql13="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        $sql14="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);
			        $result14=mysqli_query($conn, $sql14);
			        $rowcount14=mysqli_num_rows($result14);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1||$rowcount14>=1) {
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }
			    


			    }//end of else for lecture available:

				 
			}else{
				$sql6="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql7="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql8="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $sql9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";

			    $result6=mysqli_query($conn, $sql6);
			    $rowcount6=mysqli_num_rows($result6);
			    $result7=mysqli_query($conn, $sql7);
			    $rowcount7=mysqli_num_rows($result7);
			    $result8=mysqli_query($conn, $sql8);
			    $rowcount8=mysqli_num_rows($result8);
			     $result9=mysqli_query($conn, $sql9);
			    $rowcount9=mysqli_num_rows($result9);


			    if ($rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;	 
			    	$classrmId=labRoomGenerator($conn, $courseId);
			    	$sql11="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql12="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql13="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        $sql14="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $result11=mysqli_query($conn, $sql11);
			        $rowcount11=mysqli_num_rows($result11);
			        $result12=mysqli_query($conn, $sql12);
			        $rowcount12=mysqli_num_rows($result12);
			        $result13=mysqli_query($conn, $sql13);
			        $rowcount13=mysqli_num_rows($result13);
			        $result14=mysqli_query($conn, $sql14);
			        $rowcount14=mysqli_num_rows($result14);

			        if ($rowcount11>=1||$rowcount12>=1||$rowcount13>=1||$rowcount14>=1) {
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }


			    }//End of else for lec id available:


			}//end of else for faculty availability:
			}//end fo else for section availability:

		 
			 	 
			 }//End of elseif for timediff==2;
		 elseif ($timediff==3) {
		 	$sql1="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND ending_time='$endTime1' AND days='$day'"; 
			$sql3="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";
			$sql4="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='$endTime5' AND days='$day'";

			$sql5="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$starttimeValue' AND days='$day'";
			$sql6="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime2' AND days='$day'";
			$sql7="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime3' AND days='$day'";
			$sql8="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime1' AND days='$day'";
			$sql9="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='$endTime5' AND days='$day'";
			$result1=mysqli_query($conn, $sql1);
			$rowcount1=mysqli_num_rows($result1);
			$result2=mysqli_query($conn, $sql2);
			$rowcount2=mysqli_num_rows($result2);        
			$result3=mysqli_query($conn, $sql3);
			$rowcount3=mysqli_num_rows($result3);
			$result4=mysqli_query($conn, $sql4);
			$rowcount4=mysqli_num_rows($result4);
			$result5=mysqli_query($conn, $sql5);
			$rowcount5=mysqli_num_rows($result5);
			$result6=mysqli_query($conn, $sql6);
			$rowcount6=mysqli_num_rows($result6);
			$result7=mysqli_query($conn, $sql7);
			$rowcount7=mysqli_num_rows($result7);
			$result8=mysqli_query($conn, $sql8);
			$rowcount8=mysqli_num_rows($result8);
			$result9=mysqli_query($conn, $sql9);
			$rowcount9=mysqli_num_rows($result9);
			if ($rowcount1>=1||$rowcount2>=1||$rowcount3>=1||$rowcount4>=1||$rowcount5>=1||$rowcount6>=1||$rowcount7>=1||$rowcount8>=1||$rowcount9>=1) {
				$stIdvalue='not_available';
				$lecIdvalue=$lecId;

				# code...
			}else{
				$stIdvalue=$stId;

			if ($Role=='Both') {
				$sql10="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
				$sql11="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'"; 
				$sql12="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
				$sql13="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime5' AND days='$day'";

			    $sql14="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql15="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql16="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $sql17="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
			    $sql18="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime5' AND days='$day'";

			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    $result11=mysqli_query($conn, $sql11);
			    $rowcount11=mysqli_num_rows($result11);
			    $result12=mysqli_query($conn, $sql12);
			    $rowcount12=mysqli_num_rows($result12);
			     $result13=mysqli_query($conn, $sql13);
			    $rowcount13=mysqli_num_rows($result13);
			    $result14=mysqli_query($conn, $sql14);
			    $rowcount14=mysqli_num_rows($result14);
			    $result15=mysqli_query($conn, $sql15);
			    $rowcount15=mysqli_num_rows($result15);
			    $result16=mysqli_query($conn, $sql16);
			    $rowcount16=mysqli_num_rows($result16);
			    $result17=mysqli_query($conn, $sql17);
			    $rowcount17=mysqli_num_rows($result17);
			    $result18=mysqli_query($conn, $sql18);
			    $rowcount18=mysqli_num_rows($result18);


			    if ($rowcount10>=1||$rowcount11>=1||$rowcount12>=1||$rowcount13>=1||$rowcount14>=1||$rowcount15>=1||$rowcount16>=1||$rowcount17>=1||$rowcount18>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;	 
			    	$classrmId=labRoomGenerator($conn, $courseId);
			    	$sql15="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql16="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime5' AND days='$day'";
			        $result15=mysqli_query($conn, $sql15);
			        $rowcount15=mysqli_num_rows($result15);
			        $result16=mysqli_query($conn, $sql16);
			        $rowcount16=mysqli_num_rows($result16);
			        $result17=mysqli_query($conn, $sql17);
			        $rowcount17=mysqli_num_rows($result17);
			        $result18=mysqli_query($conn, $sql18);
			        $rowcount18=mysqli_num_rows($result18);
			        $result19=mysqli_query($conn, $sql19);
			        $rowcount19=mysqli_num_rows($result19);

			        if ($rowcount15>=1||$rowcount16>=1||$rowcount17>=1||$rowcount18>=1||$rowcount19>=1) {
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }

			    


			    }//end of else for lecture available:

				 
			}else{
				$sql10="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$starttimeValue' AND days='$day'";
			    $sql11="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
			    $sql12="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
			    $sql13="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
			    $sql14="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime5' AND days='$day'";

			    $result10=mysqli_query($conn, $sql10);
			    $rowcount10=mysqli_num_rows($result10);
			    $result11=mysqli_query($conn, $sql11);
			    $rowcount11=mysqli_num_rows($result11);
			    $result12=mysqli_query($conn, $sql12);
			    $rowcount12=mysqli_num_rows($result12);
			     $result13=mysqli_query($conn, $sql13);
			    $rowcount13=mysqli_num_rows($result13);
			    $result14=mysqli_query($conn, $sql14);
			    $rowcount14=mysqli_num_rows($result14);


			    if ($rowcount10>=1||$rowcount11>=1||$rowcount12>=1||$rowcount13>=1||$rowcount14>=1) {
			    	$lecIdvalue='not_available';
			    	# code...
			    }else{
			    	$lecIdvalue=$lecId;	 
			    	$classrmId=labRoomGenerator($conn, $courseId);
			    	$sql15="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$starttimeValue' AND days='$day'";
			        $sql16="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime2' AND days='$day'";
			        $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime3' AND days='$day'";
			        $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
			        $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$classrmId' AND beginning_time='$endTime5' AND days='$day'";
			        $result15=mysqli_query($conn, $sql15);
			        $rowcount15=mysqli_num_rows($result15);
			        $result16=mysqli_query($conn, $sql16);
			        $rowcount16=mysqli_num_rows($result16);
			        $result17=mysqli_query($conn, $sql17);
			        $rowcount17=mysqli_num_rows($result17);
			        $result18=mysqli_query($conn, $sql18);
			        $rowcount18=mysqli_num_rows($result18);
			        $result19=mysqli_query($conn, $sql19);
			        $rowcount19=mysqli_num_rows($result19);

			        if ($rowcount15>=1||$rowcount16>=1||$rowcount17>=1||$rowcount18>=1||$rowcount19>=1) {
                         goto backFromlabRoomGenerator;
			    	 
			    	# code...
			       }


			    }//End of else for lec id available:


			}//end of else for faculty availability:
			}//end fo else for section availability:

		 	// $lecIdvalue='lab';
	   //      $stIdvalue='lab';
	 	 	 

		 }//End of elseif for timediff==3:


        

 	 	# code...
 	 }//End of elseif for statuschecking==lab:


 	}//End of if for checking timediff==timediff==========================
 	else{
 		$lecIdvalue='not_available';
        $stIdvalue='not_available';
 	 	 

 	}

 	$availableResult = array('lecturerIds' => $lecIdvalue,  'endTimeValue' => $endTimeValue,  'starttimeValue' => $starttimeValue,  'sectionIds' => $stIdvalue,  'courseIds' => $courseId, 'roomIds' => $classrmId, 'day' => $day);
	echo json_encode($availableResult);
 	 
 }//End of if for endtime is set condition:

 function labRoomGenerator($conn, $courseId){
     //TO GENERATE LAB ROOM:
        $labrmId=mt_rand(1,20);
        $sql4="SELECT * FROM courses_lab WHERE course_id='$courseId' ORDER BY RAND() LIMIT  1";
        $result4=mysqli_query($conn, $sql4);

        while ($row4=mysqli_fetch_assoc($result4)) {
           
                $labrmid=$row4['labrm_id'];

           $sql5="SELECT * FROM lab_room WHERE labrm_id='$labrmid' ORDER BY RAND() LIMIT 1";
           $result5=mysqli_query($conn, $sql5);
           while ($row5=mysqli_fetch_array($result5)) {
              $labrmId=$row5['labrm_id'];
           
           

                      }//End of query 5

                 } //End of query 4

           return $labrmId;
          }//End of labRoomGenerator:
          // ================================
          // End of labRoomGenerator function


 // =========================================
 // Class room id generator:
 // ==========================================
 function classRoomGenerator($depId, $conn){
       $classrmId=mt_rand(1,20);

     $sql3="SELECT * FROM class_room WHERE block_id=(SELECT block_id FROM block WHERE loc_id=(SELECT loc_id FROM location WHERE loc_id=(SELECT loc_id FROM departmentlocation WHERE dep_id='$depId') ORDER BY RAND() LIMIT 1) ORDER BY RAND() LIMIT 1) ORDER BY RAND() LIMIT 1";

      $result3=mysqli_query($conn, $sql3);


      while ($row3=mysqli_fetch_assoc($result3)) {
        $classrmId=$row3['classrm_id'];

        
               } //End of query 3 for 
      return $classrmId;         

    } //End of classRoomGenerator function 
    // ===========================
    // End of classRoomGenerator
    // ==========================


?>