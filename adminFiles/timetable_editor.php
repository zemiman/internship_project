<?php
include_once'../includes/dbConnection.inc.php';
 

//if(isset($_POST['submit'])){
	$old_stId=$_POST['old_stId'];
	$old_courseId=$_POST['old_courseId'];
	$old_day=$_POST['old_day'];
	$old_roomId=$_POST['old_roomId'];
	$old_startingtime=$_POST['old_startingtime'];
	$old_endingTime=$_POST['old_endingTime'];
	$old_lecId=$_POST['old_lecId'];
	$statuschecking=$_POST['statuschecking'];
    $timeDiff1=$_POST['timeDiff1'];

	 
  
    $new_day=$_POST['new_day']; 
	// $new_courseId=$_POST['new_courseId'];
	$new_lecId=$_POST['new_lecId'];
	$new_stId=$_POST['new_stId'];
	$new_classrmId=$_POST['new_roomId'];
	$new_startingtime=$_POST['new_startingtime'];
	$new_endTime=$_POST['new_endingTime'];
    $statuschecking=$_POST['statuschecking'];
    $timeDiff1=$_POST['timeDiff1'];

	
   
     if ($statuschecking=='lecture') {

    $sql="SELECT * FROM lecture_timetable WHERE st_id='$new_stId' AND course_id='$old_courseId' AND lec_id='$new_lecId' AND classrm_id='$new_classrmId' AND beginning_time='$new_startingtime' AND ending_time='$new_endTime' AND days='$new_day'";
    $result=mysqli_query($conn, $sql);
    $rowcount=mysqli_num_rows($result);
    if ($rowcount>0) {
    	$sqlupdate="UPDATE lecture_timetable set st_id='".$new_stId."', course_id='".$old_courseId.", lec_id='".$new_lecId.", classrm_id='".$new_classrmId.", beginning_time='".$new_startingtime.", ending_time='".$new_endTime.", days='".$new_day." WHERE st_id='$new_stId' AND course_id='$old_courseId' AND lec_id='$new_lecId' AND classrm_id='$new_classrmId' AND beginning_time='$new_startingtime' AND ending_time='$new_endTime' AND days='$new_day'";
    	$result1=mysqli_query($conn, $result1);
    	if ($result1) {
            $position=0;
            archivetimetableFunction($conn,$position,$new_stId,$old_courseId,$new_lecId,$new_classrmId,$new_startingtime,$new_endTime,$new_day,$timeDiff1,$statuschecking);

    		$sql20="SELECT * FROM lecture_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND classrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
            $result20=mysqli_query($conn, $sql20);
            $rowcount20=mysqli_num_rows($result20);
            if ($rowcount20>0) {
             $query2="DELETE FROM lecture_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND classrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
               mysqli_query($conn, $query2);
               $position=1;
            archivetimetableFunction($conn,$position,$old_stId,$old_courseId,$old_lecId,$old_roomId,$old_startingtime,$old_endingTime,$old_day,$timeDiff1,$statuschecking);
               
               // echo "Deleted";
            }
            // else{
            // 	echo "error ".$rowcount20;
            // }

    		# code...
    	}//end of if for result1:
    	# code...
    }else{
        $query2="INSERT INTO lecture_timetable(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days) VALUES('".$new_stId."', '".$old_courseId."', '".$new_lecId."', '".$new_classrmId."', '".$new_startingtime."', '".$new_endTime."', '".$new_day."')";
        $result2 = mysqli_query($conn, $query2);
        if ($result2) {
            $position=2;
            archivetimetableFunction($conn,$position,$new_stId,$old_courseId,$new_lecId,$new_classrmId,$new_startingtime,$new_endTime,$new_day,$timeDiff1,$statuschecking);
        	$sql20="SELECT * FROM lecture_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND classrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
            $result20=mysqli_query($conn, $sql20);
            $rowcount20=mysqli_num_rows($result20);
            if ($rowcount20>0) {
             $query2="DELETE FROM lecture_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND classrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
               mysqli_query($conn, $query2);
               $position=1;
            archivetimetableFunction($conn,$position,$old_stId,$old_courseId,$old_lecId,$old_roomId,$old_startingtime,$old_endingTime,$old_day,$timeDiff1,$statuschecking);
               
               // echo "Deleted";
            }
            // else{
            // 	echo "error ".$rowcount20;
            // }
        	# code...
        }//end of if for result2:


    }//End of else for rowcount:
    }//End of if for statuschecking ==lecture:
    elseif ($statuschecking=='lab') {
    	
    $sql="SELECT * FROM lab_timetable WHERE st_id='$new_stId' AND course_id='$old_courseId' AND lec_id='$new_lecId' AND labrm_id='$new_classrmId' AND beginning_time='$new_startingtime' AND ending_time='$new_endTime' AND days='$new_day'";
    $result=mysqli_query($conn, $sql);
    $rowcount=mysqli_num_rows($result);
    if ($rowcount>0) {
        $sqlupdate="UPDATE lab_timetable set st_id='".$new_stId."', course_id='".$old_courseId.", lec_id='".$new_lecId.", labrm_id='".$new_classrmId.", beginning_time='".$new_startingtime.", ending_time='".$new_endTime.", days='".$new_day." WHERE st_id='$new_stId' AND course_id='$old_courseId' AND lec_id='$new_lecId' AND labrm_id='$new_classrmId' AND beginning_time='$new_startingtime' AND ending_time='$new_endTime' AND days='$new_day'";
        $result1=mysqli_query($conn, $result1);
        if ($result1) {
            $position=0;
            archivetimetableFunction($conn,$position,$new_stId,$old_courseId,$new_lecId,$new_classrmId,$new_startingtime,$new_endTime,$new_day,$timeDiff1,$statuschecking);

            $sql20="SELECT * FROM lab_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND labrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
            $result20=mysqli_query($conn, $sql20);
            $rowcount20=mysqli_num_rows($result20);
            if ($rowcount20>0) {
             $query2="DELETE FROM lab_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND labrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
               mysqli_query($conn, $query2);
               $position=1;
            archivetimetableFunction($conn,$position,$old_stId,$old_courseId,$old_lecId,$old_roomId,$old_startingtime,$old_endingTime,$old_day,$timeDiff1,$statuschecking);
               
               // echo "Deleted";
            }
             
            # code...
        }//end of if for result1:
        # code...
    }else{
        $query2="INSERT INTO lab_timetable(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days) VALUES('".$new_stId."', '".$old_courseId."', '".$new_lecId."', '".$new_classrmId."', '".$new_startingtime."', '".$new_endTime."', '".$new_day."')";
        $result2 = mysqli_query($conn, $query2);
        if ($result2) {
            $position=2;
            archivetimetableFunction($conn,$position,$new_stId,$old_courseId,$new_lecId,$new_classrmId,$new_startingtime,$new_endTime,$new_day,$timeDiff1,$statuschecking);
            $sql20="SELECT * FROM lab_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND labrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
            $result20=mysqli_query($conn, $sql20);
            $rowcount20=mysqli_num_rows($result20);
            if ($rowcount20>0) {
             $query2="DELETE FROM lab_timetable WHERE st_id='$old_stId' AND course_id='$old_courseId' AND lec_id='$old_lecId' AND labrm_id='$old_roomId' AND beginning_time='$old_startingtime' AND ending_time='$old_endingTime' AND days='$old_day'";
               mysqli_query($conn, $query2);
               $position=1;
            archivetimetableFunction($conn,$position,$old_stId,$old_courseId,$old_lecId,$old_roomId,$old_startingtime,$old_endingTime,$old_day,$timeDiff1,$statuschecking);
               
               // echo "Deleted";
            }
             
            # code...
        }//end of if for result2:


    }//End of else for rowcount:
    	# code...
    }//End of elseif for $statuschecking==lab:

    // function archivetimetablelabFunction($conn,$position,$stid,$courseId,$new_lecId,$labrmId,$startingtime,$endTime,$day,$timediff){
    //   $currentDate=date("Y-m-d");
    //     $year='';
       
    //   $sql="SELECT * FROM semesterinterval WHERE coll_id='$college_id' AND startDate<='$currentDate' AND endDate>='$currentDate'";
    //   $result=mysqli_query($conn, $sql);
    //   $rowcount=mysqli_num_rows($result);
    //   if ($rowcount>0) {
    //     while ($row=mysqli_fetch_assoc($result)) {
    //       $startDate=mysqli_real_escape_string($conn,$row['startDate']);
    //       $endDate=mysqli_real_escape_string($conn,$row['endDate']);

           
    //     }
    //     $startDate1string = strtotime("+1 months", strtotime($startDate));
    //     $datewithformat = date("Y-m-d", $startDate1string);

    //     $startDate1=date_create($datewithformat);
    //     $startDate1=date_format($startDate1, "d F Y");
    //     $month = date('F', strtotime($startDate1));

    //     $endDate1=$endDate;
    //     $endDate1=date_create($endDate1);
    //     $endDate1=date_format($endDate1, "d F y");
    //     $endDate1 = date('y', strtotime($endDate1));

    //     $startDate1=$startDate;
    //     $startDate1=date_create($startDate1);
    //     $startDate1=date_format($startDate1, "d F Y");
    //     $startDate1 = date('Y', strtotime($startDate1));
   
    //     if (($month=='November'||$month=='October')&&($semester=='Semester_1')) {
    //       $year.=$startDate1;
    //       $year.='/';
    //       $year.=$endDate1;
           
    //     }else{
    //       $year.=$startDate1;
    //     }
    //     $sql1="SELECT * FROM archive_timetablelab WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND startDate='$startDate' AND endDate='$endDate' AND timediff='$timediff'";
    //     $result1=mysqli_query($conn,$sql1);
    //     $rowcount1=mysqli_num_rows($result1);
    //     if ($rowcount1==1) {
    //       $sql2="UPDATE archive_timetablelab SET st_id='".$stid."', course_id='".$courseId."', lec_id='".$labAssId."', labrm_id='".$labrmId."', beginning_time='".$startingtime."', ending_time='".$endTime."', days='".$day."', startDate='".$startDate."', endDate='".$endDate."', year='".$year."', semester='".$semester."', timediff='".$timediff."' WHERE st_id='".$stid."' AND course_id='".$courseId."' AND lec_id='".$labAssId."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timediff."'";
    //       mysqli_query($conn,$sql2);
    //       # code...
    //     }else{
    //       $sql3=" INSERT INTO archive_timetablelab(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days, startDate, endDate, year, semester, timediff) VALUES('".$stid."', '".$courseId."', '".$labAssId."', '".$labrmId."', '".$startingtime."', '".$endTime."', '".$day."', '".$startDate."', '".$endDate."', '".$year."', '".$semester."', '".$timediff."')";
    //       mysqli_query($conn,$sql3);

    //     }

    //     # code...
    //   }else{
    //     echo "semester have not set yet!pls set firts, before anything you do.";
    //   }


    //  }//End of archivetimetablelabFunction:

function archivetimetableFunction($conn,$position,$new_stId,$old_courseId,$new_lecId,$new_classrmId,$new_startingtime,$new_endTime,$new_day,$timeDiff1,$statuschecking){
      $currentDate=date("Y-m-d");
        $year='';

        $sql6="SELECT * from courses where course_id='$old_courseId'";
        $result6=mysqli_query($conn, $sql6);
        while ($row6=mysqli_fetch_assoc($result6)) {
           $hours= mysqli_real_escape_string($conn,$row6['lectureHour']);
           $labrequirement=mysqli_real_escape_string($conn,$row6['lab_requirement']);
           $semester=mysqli_real_escape_string($conn,$row6['semester']);

        }
        $sql7="SELECT * FROM groupofstudent WHERE st_id='$new_stId'";
        $result7=mysqli_query($conn, $sql7);
        while ($row7=mysqli_fetch_assoc($result7)) {

              
           $depId=$row7['dep_id'];
        }
        $sql8="SELECT * FROM department WHERE dep_id='$depId'";
        $result8=mysqli_query($conn, $sql8);
        while ($row8=mysqli_fetch_assoc($result8)) {

              
          $collegeId=$row8['coll_id'];
        }
       
      $sql="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$currentDate' AND endDate>='$currentDate'";
      $result=mysqli_query($conn, $sql);
      $rowcount=mysqli_num_rows($result);
      if ($rowcount>0) {
        while ($row=mysqli_fetch_assoc($result)) {
          $startDate=mysqli_real_escape_string($conn,$row['startDate']);
          $endDate=mysqli_real_escape_string($conn,$row['endDate']);

           
        }
        $startDate1string = strtotime("+1 months", strtotime($startDate));
        $datewithformat = date("Y-m-d", $startDate1string);

        $startDate1=date_create($datewithformat);
        $startDate1=date_format($startDate1, "d F Y");
        $month = date('F', strtotime($startDate1));

        $endDate1=$endDate;
        $endDate1=date_create($endDate1);
        $endDate1=date_format($endDate1, "d F y");
        $endDate1 = date('y', strtotime($endDate1));

        $startDate1=$startDate;
        $startDate1=date_create($startDate1);
        $startDate1=date_format($startDate1, "d F Y");
        $startDate1 = date('Y', strtotime($startDate1));
   
        if (($month=='November'||$month=='October')&&($semester=='Semester_1')) {
          $year.=$startDate1;
          $year.='/';
          $year.=$endDate1;
           
        }else{
          $year.=$startDate1;
        }

    if ($statuschecking=='lecture') {
         if ($position==0) {
            $sql2="UPDATE archive_timetablelecture SET st_id='".$new_stId."', course_id='".$old_courseId."', lec_id='".$new_lecId."', classrm_id='".$new_classrmId."', beginning_time='".$new_startingtime."', ending_time='".$new_endTime."', days='".$new_day."', startDate='".$startDate."', endDate='".$endDate."', year='".$year."', semester='".$semester."', timediff='".$timeDiff1."' WHERE st_id='".$new_stId."' AND course_id='".$old_courseId."' AND lec_id='".$new_lecId."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timeDiff1."'";
           mysqli_query($conn,$sql2);
            # code...
          
        }//End of if for position:
        elseif ($position==1) {
            $sql3="DELETE FROM archive_timetablelecture WHERE st_id='".$new_stId."' AND course_id='".$old_courseId."' AND lec_id='".$new_lecId."' AND classrm_id='".$new_classrmId."' AND beginning_time='".$new_startingtime."' AND ending_time='".$new_endTime."' AND days='".$new_day."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timeDiff1."'";
           mysqli_query($conn,$sql3);

             
        }elseif ($position==2) {
            # code...
          $sql3=" INSERT INTO archive_timetablelecture(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days, startDate, endDate, year, semester, timediff) VALUES('".$new_stId."', '".$old_courseId."', '".$new_lecId."', '".$new_classrmId."', '".$new_startingtime."', '".$new_endTime."', '".$new_day."', '".$startDate."', '".$endDate."', '".$year."', '".$semester."', '".$timeDiff1."')";
          mysqli_query($conn,$sql3);

        }
        # code...
    }//End of if for statuschecking==lecture
    elseif ($statuschecking=='lab') {
        if ($position==0) {
           $sql2="UPDATE archive_timetablelab SET st_id='".$new_stId."', course_id='".$old_courseId."', lec_id='".$new_lecId."', labrm_id='".$new_classrmId."', beginning_time='".$new_startingtime."', ending_time='".$new_endTime."', days='".$new_day."', startDate='".$startDate."', endDate='".$endDate."', year='".$year."', semester='".$semester."', timediff='".$timeDiff1."' WHERE st_id='".$new_stId."' AND course_id='".$old_courseId."' AND lec_id='".$new_lecId."' AND labrm_id='".$new_classrmId."' AND beginning_time='".$new_startingtime."' AND ending_time='".$new_endTime."' AND days='".$new_day."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timeDiff1."'";
           mysqli_query($conn,$sql2);

            # code...
        }elseif ($position==1) {
            $sql3="DELETE FROM archive_timetablelab WHERE st_id='".$new_stId."' AND course_id='".$old_courseId."' AND lec_id='".$new_lecId."' AND labrm_id='".$new_classrmId."' AND beginning_time='".$new_startingtime."' AND ending_time='".$new_endTime."' AND days='".$new_day."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timeDiff1."'";
           mysqli_query($conn,$sql3);

            # code...
        }elseif ($position==2) {
            $sql3=" INSERT INTO archive_timetablelab(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days, startDate, endDate, year, semester, timediff) VALUES('".$new_stId."', '".$old_courseId."', '".$new_lecId."', '".$new_classrmId."', '".$new_startingtime."', '".$new_endTime."', '".$new_day."', '".$startDate."', '".$endDate."', '".$year."', '".$semester."', '".$timeDiff1."')";
          mysqli_query($conn,$sql3);
            
        
        }
        # code...
    }//end of elseif for statuschecking==lab:

       


 
        
      }else{
        echo "Semester have not set yet!pls set first, before anything you do.";
      }//End of else for rowcount:

      

     }//End of archivetimetableFunction:

//==========================================================
//TO CLEAR THE ENTRY BEFORE GENERATE THE REQUIRED TIMETABLE:
//==========================================================    



 

                                 
                               
							
//}
?>