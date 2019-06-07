          <?php
     include_once'header.php';
     include_once'../includes/dbConnection.inc.php';

     ?>
                   <div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h3 style="font-style: italic; text-align: center; padding: 4px 2px 4px 2px;">Automated Timetable Generator</h3>
													 
													<div class="clearfix"></div>
											</div>
									</div>
						</div>
						<!-- end row -->
             
						



							
					<div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
              <!--  div1 of main body -->

              </div>
                   

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">

            <div class="alert alert-success" style="margin-top: 8px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/create timetable/department wise</strong> : generate time timetable department wise.
 
            </div>						
								 

         
       
    <?php
   

      
        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             


   ?>
     
       

  <div class="card-body">
        <form method="POST" class="form" role="form" autocomplete="off" style="margin-top: 4px;" onsubmit="return form_Validation()">

           <div class="form-group">
           <label for="department" class="col-sm-7 control-label" style="font-weight: bold; font-style: italic; font-size: 18px;">Department:</label>
           <div class="col-sm-7">
              <select class="form-control" name="department_name" id="department" style="font-style: italic;  font-size: 16px;">
            
                <option value="">Select Department</option>
                 <?php while ($row = mysqli_fetch_array($result)){
             ?>
                 <option value=" <?php echo $row['dep_id'];?> " style="font-weight: bold; font-style: italic; line-height: 28px; font-size: 16px; margin: 14px;">
     <?php echo $row['dep_name']; ?>
      
    </option>
    <?php

}
?>
           

           </select> 
        <span id="select" class="text-danger font-weight-bold"></span>         
          
        </div>
     </div>          
             

          <div class="form-group col-sm-4">
              <button type="submit" name="submit" class="btn btn-success" style="padding: 8px 12px; float: right;">Generate</button>
          </div>

        </form>
    </div>

  <?php 
  $dayslist=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  $dayslistlab=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  $startTime1=['11:30', '9:30', '8:30', '10:30',  '16:30', '15:30', '14:30'];
  $startTime2=[ '9:30', '8:30', '10:30', '15:30', '14:30'];

      if (isset($_POST['submit'])) {
        clearFunction($conn);
        $stId1=0;
        $departmentId=mysqli_real_escape_string($conn, $_POST['department_name']);
        $sql26="SELECT * FROM groupofstudent WHERE dep_id='$departmentId' ORDER BY st_id DESC LIMIT 1";
            $result26=mysqli_query($conn, $sql26);
            while ($row26=mysqli_fetch_assoc($result26)) {
              $stId1=mysqli_real_escape_string($conn, trim($row26['st_id']));
              

              # code...
            }
            $sql27="SELECT * FROM class WHERE st_id='$stId1' ORDER BY st_id, lec_id DESC LIMIT 1";
            $result27=mysqli_query($conn, $sql27);
            while ($row27=mysqli_fetch_assoc($result27)) {
              $lastStudentId=mysqli_real_escape_string($conn, trim($row27['st_id']));
              $lastLecturerId=mysqli_real_escape_string($conn, trim($row27['lec_id']));
               
              # code...
            }
            
         

         if (empty($departmentId)) {
          echo '<SCRIPT type="text/javascript"> swal("OOPS!", "field was not filled out!", "error");</SCRIPT>';
           
         }else{
            $sql25="SELECT * FROM groupofstudent WHERE dep_id='$departmentId'";
            $result25=mysqli_query($conn, $sql25);
            $rowcount25=mysqli_num_rows($result25);
            if ($rowcount25>0) {
               while ($row25=mysqli_fetch_assoc($result25)) {
                $studentId=mysqli_real_escape_string($conn, trim($row25['st_id']));


                // echo "stid: ".$studentId;



              $sql1="SELECT * FROM class WHERE st_id='$studentId'";
              $result1=mysqli_query($conn, $sql1);
              while ($row1=mysqli_fetch_assoc($result1)) {
                $stid=$row1['st_id'];
                $lecId=$row1['lec_id'];
                $courseId=$row1['course_id'];
                $sql6="SELECT * from courses where course_id='$courseId'";
                $result6=mysqli_query($conn, $sql6);
                while ($row6=mysqli_fetch_assoc($result6)) {
                   $hours= mysqli_real_escape_string($conn,$row6['lectureHour']);
                   $labrequirement=mysqli_real_escape_string($conn,$row6['lab_requirement']);
                   $semester=mysqli_real_escape_string($conn,$row6['semester']);

                }

                //TO FETCH FACULTIES' ROLE FROM faculties table:
                $sql30="SELECT * FROM faculties   WHERE lec_id='$lecId'";
                $result30=mysqli_query($conn, $sql30);
                while ($row30=mysqli_fetch_assoc($result30)) {
                  $Role=mysqli_real_escape_string($conn, $row30['role']);


                  
                 }

                //TO GENERATE DEPARTMENT ID THAT TAKEN FROM STUDENT TABLE:
                $sql2="SELECT * FROM groupofstudent WHERE st_id='$stid'";
              $result2=mysqli_query($conn, $sql2);
              while ($row2=mysqli_fetch_assoc($result2)) {

                  
                  $depid=$row2['dep_id'];
                   backAgain:
                  $day=dayGenerator($dayslist);
                  list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                  $classrmId=classRoomGenerator($depid, $conn);
                   
                                                          
                      backTimeSetter:
                      backRandInt:
                      $randInt=mt_rand(1,2);
                     
                      if ($hours==1) {
                            $value=strtotime($selectedTime1);
                            $startingtime=date('h:i', strtotime($selectedTime1));
                            $endTime = strtotime("+1 hours", strtotime($selectedTime1));
                            $endTime=date('h:i', $endTime);
                             

                             $decrmenttime=1;
                        
                      }//End of if of hours checking condition:
                      elseif ($hours==2) {
                                 
                                   $value=strtotime($selectedTime2);
                                $startingtime=date('h:i', strtotime($selectedTime2));
                                 $endTime = strtotime("+2 hours", strtotime($selectedTime2));
                               $endTime=date('h:i', $endTime);
                               $decrmenttime=2;

                                }
                        # code...
                      
                      else{
                           if ($randInt==2) {

                             $value=strtotime($selectedTime2);
                            $startingtime=date('h:i', strtotime($selectedTime2));
                             $endTime = strtotime("+2 hours", strtotime($selectedTime2));
                             $endTime=date('h:i', $endTime);
                             $decrmenttime=2;
                            
                              
                           }//End of if calculating end time:
                           else{
                            $value=strtotime($selectedTime1);
                            $startingtime=date('h:i', strtotime($selectedTime1));
                            $endTime = strtotime("+1 hours", strtotime($selectedTime1));
                            $endTime=date('h:i', $endTime);
                             

                             $decrmenttime=1;
                             

                           }//End of if calculating end time:

                           }//End of else of hours checking condition:
                           

                    $endTime1 = strtotime("+1 hours", $value);
                    $endTime1=date('h:i', $endTime1);
                    $endTime2 = strtotime("-1 hours", $value);
                    $endTime2=date('h:i', $endTime2);
                    $endTime3 = strtotime("-2 hours", $value);
                    $endTime3=date('h:i', $endTime3);
                     
                    backClassRoom:
                    backFromDaysGenerator:
                    $sql7="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
                    $sql8="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
                    $sql9="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$startingtime' AND days='$day'";
                    $sql15="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND ending_time='$endTime1' AND days='$day'";
                    $sql16="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
                    $sql17="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime2' AND days='$day'";
                    $sql18="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime3' AND days='$day'";
                      
                    $result7=mysqli_query($conn, $sql7);
                    $rowcount7=mysqli_num_rows($result7);
                    $result8=mysqli_query($conn, $sql8);
                    $rowcount8=mysqli_num_rows($result8);
                    $result9=mysqli_query($conn, $sql9);
                    $rowcount9=mysqli_num_rows($result9);
                    $result15=mysqli_query($conn, $sql15);
                    $rowcount15=mysqli_num_rows($result15);
                    $result16=mysqli_query($conn, $sql16);
                    $rowcount16=mysqli_num_rows($result16);
                    $result17=mysqli_query($conn, $sql17);
                    $rowcount17=mysqli_num_rows($result17);
                    $result18=mysqli_query($conn, $sql18);
                    $rowcount18=mysqli_num_rows($result18);
                     if ($rowcount7==1||$rowcount8==1||$rowcount9==1||$rowcount15==1||$rowcount16==1||$rowcount17==1||$rowcount18==1) {
                            $randvalue=mt_rand(0,2);
                          if ($randvalue==2) {
                            list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                          goto backTimeSetter;
                            # code...
                          }elseif ($randvalue==1) {
                             $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;

                            # code...
                          }
                          else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }
                       
                     }//end of if for orginal data check:
                     else{
                           if ($Role=='Both') {

                             $sql31="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$startingtime' AND days='$day'";
                             $sql32="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime2' AND days='$day'";
                             $sql33="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime3' AND days='$day'";
                                
                             $result31=mysqli_query($conn, $sql31);
                             $rowcount31=mysqli_num_rows($result31);
                             $result32=mysqli_query($conn, $sql32);
                             $rowcount32=mysqli_num_rows($result32);
                             $result33=mysqli_query($conn, $sql33);
                             $rowcount33=mysqli_num_rows($result33);

                             if ($rowcount31==1||$rowcount32==1||$rowcount33==1) {
                             $randvalue=mt_rand(0,2);
                          if ($randvalue==2) {
                            list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                          goto backTimeSetter;
                            # code...
                          }elseif ($randvalue==0) {
                             $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;

                            # code...
                          }
                          else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }
                          

                          
                        }//End of if for row count 31, 32 and 33:
                        else{
                           if ($decrmenttime==2){
                    $sql10="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
                    $sql11="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
                    $sql12="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
                    $sql34="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";

                     
                     
                    $result10=mysqli_query($conn, $sql10);
                    $rowcount10=mysqli_num_rows($result10);
                    $result11=mysqli_query($conn, $sql11);
                    $rowcount11=mysqli_num_rows($result11);
                    $result12=mysqli_query($conn, $sql12);
                    $rowcount12=mysqli_num_rows($result12);
                    $result34=mysqli_query($conn, $sql34);
                    $rowcount34=mysqli_num_rows($result34);
                        if ($rowcount10==1||$rowcount11==1||$rowcount12==1||$rowcount34==1) {
                          $randvalue=mt_rand(0,2);
                          if ($randvalue==1) {
                            list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                          goto backTimeSetter;
                            # code...
                          }elseif ($randvalue==2) {
                             $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;

                            # code...
                          }
                          else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }
                          

                          
                        }//End of if for row count 10, 11 and 12:
                        else{

                          $sql13="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$startingtime' AND days='$day'";
                          $sql14="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
                          $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
                          $result13=mysqli_query($conn, $sql13);
                          $rowcount13=mysqli_num_rows($result13);
                          $result14=mysqli_query($conn, $sql14);
                          $rowcount14=mysqli_num_rows($result14);
                          $result19=mysqli_query($conn, $sql19);
                          $rowcount19=mysqli_num_rows($result19);
                          if ($rowcount13==1||$rowcount14==1||$rowcount19==1) {
                            $randvalue=mt_rand(0,2);
                            if ($randvalue==2) {
                              $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;
                              # code...
                            }
                            elseif ($randvalue==0) {
                              list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                              goto backTimeSetter;
                              # code...
                            }
                            else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }//end of else for randvalue evaluation:
                            

                             
                          }//End of if for row count 13 and 14:
                          else{
                            $sql20="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$lecId' AND classrm_id='$classrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                            $result20=mysqli_query($conn, $sql20);
                            $rowcount20=mysqli_num_rows($result20);
                            if ($rowcount20==1) {
                              goto backAgain;
                              # code...
                            }else{
                               $query1="INSERT INTO lecture_timetable(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$lecId', '$classrmId', '$startingtime', '$endTime', '$day')";
                               mysqli_query($conn, $query1);
                               $hours=$hours-$decrmenttime;
                               $datetime1 = new DateTime($startingtime);
                               $datetime2 = new DateTime($endTime);
                               $interval = $datetime2->diff($datetime1);
                               $timediff=$interval->format('%H');
                               $timediff=(int)($timediff);
                               //$timediff=(int)($endTime-$startingtime);
                               archivetimetableFunction($conn,$college_id,$stid,$courseId,$lecId,$classrmId,$startingtime,$endTime,$day,$semester,$timediff);

                               if ($hours>0) {
                                goto backAgain;
                                 # code...
                               }else{
                                if ($hours==0&&$labrequirement=='Yes') {
                                  labSchedulerFunction($conn, $courseId, $stid, $depid, $college_id);

                                  if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                  # code...
                                }//End of if condition for checking hours and lab requirement:
                                  else{
                                    if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                    }

                                  }//End of else for hours and labrequirement condition:
                                }//Emd of else for backAgaim loop:
            

                            }//End of else for row count of query 20: 

                          }//End of if for row count 13 and 14:
                  

                        }//End of else for row count 10, 11 and 12:
       

                           
                            
                         }//End of if for decrmenttime:
                         else{
                          $sql21="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$startingtime' AND days='$day'";
                          $sql22="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
                          $result21=mysqli_query($conn, $sql21);
                          $rowcount21=mysqli_num_rows($result21);
                          $result22=mysqli_query($conn, $sql22);
                          $rowcount22=mysqli_num_rows($result22);
                          if ($rowcount21==1||$rowcount22==1) {
                            $randvalue=mt_rand(0,2);
                            if ($randvalue==2) {
                              $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;
                              # code...
                            }elseif ($randvalue==0) {
                              list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                              goto backTimeSetter;
                              # code...
                            }else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }//end of else for randvalue evaluation:

                        }//End of  if for row count 21 and 22:
                        else{
                          $sql20="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$lecId' AND classrm_id='$classrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                            $result20=mysqli_query($conn, $sql20);
                            $rowcount20=mysqli_num_rows($result20);
                            if ($rowcount20==1) {
                              goto backAgain;
                              # code...
                            }else{
                                 // if () {
                                 //   # code...
                                 // }
                               $query2="INSERT INTO lecture_timetable(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$lecId', '$classrmId', '$startingtime', '$endTime', '$day')";
                               mysqli_query($conn, $query2);
                               $hours=$hours-$decrmenttime;
                               $datetime1 = new DateTime($startingtime);
                               $datetime2 = new DateTime($endTime);
                               $interval = $datetime2->diff($datetime1);
                               $timediff=$interval->format('%H');
                               $timediff=(int)($timediff);
                               //$timediff=(int)($endTime-$startingtime);
                               archivetimetableFunction($conn,$college_id,$stid,$courseId,$lecId,$classrmId,$startingtime,$endTime,$day,$semester,$timediff);
                               if ($hours>0) {
                                goto backAgain;
                                 # code...
                               }
                               else{
                                if ($hours==0&&$labrequirement=='Yes') {
                                  labSchedulerFunction($conn, $courseId, $stid, $depid, $college_id);
                                  if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                  # code...
                                }//End of if condition for checking hours and lab requirement:
                                  else{
                                    if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                     
                                  }//End of else for hours and labrequirement condition:

                               }//Emd of else for backAgaim loop:




                            }//End of else for row count of query 20: 


                        }//End of else for row count 21 and 22:






                         }//End of else for decrmenttime inside role=Both:


                        }//End of else forrowcount 31,32 and 33 inside role=Both:


                                  
                           

                         }else{

                         if ($decrmenttime==2){
                    $sql10="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
                    $sql11="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='$endTime1' AND days='$day'";
                    $sql12="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
                    // $sql19="SELECT * FROM lab_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
                     
                    $result10=mysqli_query($conn, $sql10);
                    $rowcount10=mysqli_num_rows($result10);
                    $result11=mysqli_query($conn, $sql11);
                    $rowcount11=mysqli_num_rows($result11);
                    $result12=mysqli_query($conn, $sql12);
                    $rowcount12=mysqli_num_rows($result12);
                        if ($rowcount10==1||$rowcount11==1||$rowcount12==1) {
                          $randvalue=mt_rand(0,2);
                          if ($randvalue==1) {
                            list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                          goto backTimeSetter;
                            # code...
                          }elseif ($randvalue==2) {
                             $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;

                            # code...
                          }
                          else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }
                          

                          
                        }//End of if for row count 10, 11 and 12:
                        else{

                          $sql13="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$startingtime' AND days='$day'";
                          $sql14="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
                          $sql19="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$endTime1' AND days='$day'";
                          $result13=mysqli_query($conn, $sql13);
                          $rowcount13=mysqli_num_rows($result13);
                          $result14=mysqli_query($conn, $sql14);
                          $rowcount14=mysqli_num_rows($result14);
                          $result19=mysqli_query($conn, $sql19);
                          $rowcount19=mysqli_num_rows($result19);
                          if ($rowcount13==1||$rowcount14==1||$rowcount19==1) {
                            $randvalue=mt_rand(0,2);
                            if ($randvalue==2) {
                              $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;
                              # code...
                            }
                            elseif ($randvalue==0) {
                              list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                              goto backTimeSetter;
                              # code...
                            }
                            else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }//end of else for randvalue evaluation:
                            

                             
                          }//End of if for row count 13 and 14:
                          else{
                            $sql20="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$lecId' AND classrm_id='$classrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                            $result20=mysqli_query($conn, $sql20);
                            $rowcount20=mysqli_num_rows($result20);
                            if ($rowcount20==1) {
                              goto backAgain;
                              # code...
                            }else{
                               $query1="INSERT INTO lecture_timetable(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$lecId', '$classrmId', '$startingtime', '$endTime', '$day')";
                               mysqli_query($conn, $query1);
                               $hours=$hours-$decrmenttime;
                               $datetime1 = new DateTime($startingtime);
                               $datetime2 = new DateTime($endTime);
                               $interval = $datetime2->diff($datetime1);
                               $timediff=$interval->format('%H');
                               $timediff=(int)($timediff);
                               //$timediff=(int)($endTime-$startingtime);
                               archivetimetableFunction($conn,$college_id,$stid,$courseId,$lecId,$classrmId,$startingtime,$endTime,$day,$semester,$timediff);
                               if ($hours>0) {
                                goto backAgain;
                                 # code...
                               }else{
                                if ($hours==0&&$labrequirement=='Yes') {
                                  labSchedulerFunction($conn, $courseId, $stid, $depid, $college_id);

                                  if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                  # code...
                                }//End of if condition for checking hours and lab requirement:
                                  else{
                                    if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                    }

                                  }//End of else for hours and labrequirement condition:
                                }//Emd of else for backAgaim loop:
            

                            }//End of else for row count of query 20: 

                          }//End of if for row count 13 and 14:
                  

                        }//End of else for row count 10, 11 and 12:
        
                            
                      }//End of if for decrmenttime:
                         else{
                          $sql21="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND beginning_time='$startingtime' AND days='$day'";
                          $sql22="SELECT * FROM lecture_timetable WHERE classrm_id='$classrmId' AND ending_time='$endTime1' AND days='$day'";
                          $result21=mysqli_query($conn, $sql21);
                          $rowcount21=mysqli_num_rows($result21);
                          $result22=mysqli_query($conn, $sql22);
                          $rowcount22=mysqli_num_rows($result22);
                          if ($rowcount21==1||$rowcount22==1) {
                            $randvalue=mt_rand(0,2);
                            if ($randvalue==2) {
                              $classrmId=classRoomGenerator($depid, $conn);
                               goto backClassRoom;
                              # code...
                            }elseif ($randvalue==0) {
                              list($selectedTime1, $selectedTime2)=timeGenerator($startTime1, $startTime2);
                              goto backTimeSetter;
                              # code...
                            }else{
                            $day=dayGenerator($dayslist);
                            goto backFromDaysGenerator;

                          }//end of else for randvalue evaluation:

                        }//End of  if for row count 21 and 22:
                        else{
                          $sql20="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$lecId' AND classrm_id='$classrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                            $result20=mysqli_query($conn, $sql20);
                            $rowcount20=mysqli_num_rows($result20);
                            if ($rowcount20==1) {
                              goto backAgain;
                              # code...
                            }else{
                                 // if () {
                                 //   # code...
                                 // }
                               $query2="INSERT INTO lecture_timetable(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$lecId', '$classrmId', '$startingtime', '$endTime', '$day')";
                               mysqli_query($conn, $query2);
                               $hours=$hours-$decrmenttime;
                               $datetime1 = new DateTime($startingtime);
                               $datetime2 = new DateTime($endTime);
                               $interval = $datetime2->diff($datetime1);
                               $timediff=$interval->format('%H');
                               $timediff=(int)($timediff);
                               archivetimetableFunction($conn,$college_id,$stid,$courseId,$lecId,$classrmId,$startingtime,$endTime,$day,$semester,$timediff);
                               if ($hours>0) {
                                goto backAgain;
                                 # code...
                               }
                               else{
                                if ($hours==0&&$labrequirement=='Yes') {
                                  labSchedulerFunction($conn, $courseId, $stid, $depid, $college_id);
                                  if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                  # code...
                                }//End of if condition for checking hours and lab requirement:
                                  else{
                                    if ($lastStudentId==$stid&&$lastLecturerId==$lecId&&$hours==0) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Generated!", "success");</SCRIPT>';
                                    # code...
                                  }
                                     
                                  }//End of else for hours and labrequirement condition:

                               }//Emd of else for backAgaim loop:




                            }//End of else for row count of query 20: 


                        }//End of else for row count 21 and 22:






                         }//End of else for decrmenttime:

                       }//End of else for role check condition:



                     }//End of else for row count 7, 8 and 9:

              
                  }  //End of while loop for fetching department id from students' table on query 2:
                    
       
              } //End of while loop for fetching data on query 1:

     }//End of while loop for retreiving student id on query 25:
    }//End of if for row count 25:

  }//End of else for emptieness checking::
    
}//End of if for isset condition generate button:

     //TO GENERATE starting times:
  function timeGenerator($startTime1, $startTime2){
        $index1=mt_rand(0,6);
        $index2=mt_rand(0,4);
        $selectedTime1 = $startTime1[$index1];
        $selectedTime2 = $startTime2[$index2];

        return array($selectedTime1, $selectedTime2);

      }//TEnd of timeGenerator fun:
      function timeGeneratorForLab($startTime){
        
        $index=mt_rand(0,2);
         
        $selectedTime=$startTime[$index];

        return $selectedTime;

      }//TEnd of timeGenerator fun
    //TO GENERATE CLASS ROOM:
 function classRoomGenerator($depid, $conn){
       $classrmId=mt_rand(1,20);

     $sql3="SELECT * FROM class_room WHERE block_id=(SELECT block_id FROM block WHERE loc_id=(SELECT loc_id FROM location WHERE loc_id=(SELECT loc_id FROM departmentlocation WHERE dep_id='$depid') ORDER BY RAND() LIMIT 1) ORDER BY RAND() LIMIT 1) ORDER BY RAND() LIMIT 1";

      $result3=mysqli_query($conn, $sql3);


      while ($row3=mysqli_fetch_assoc($result3)) {
        $classrmId=$row3['classrm_id'];

        
               } //End of query 3 for 
      return $classrmId;         

    } //End of classRoomGenerator function 


  function dayGenerator($dayslist){
      $day=mt_rand(0,4);
      $day=$dayslist[$day];
      return $day;

    }//End of dayGenerator
    function dayGeneratorForLab($dayslist){
      $day=mt_rand(0,5);
      $day=$dayslist[$day];
      return $day;

    }//End of dayGenerator

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
  function labSchedulerFunction($conn, $courseId, $stid, $depid, $college_id){
    $labAssId=0;
    $Role="Assistant";

      $dayslist=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $startTime=[ '9:30', '8:30', '14:30'];
    // echo "course id: ".$courseId;
    $sql1="SELECT * FROM courses WHERE course_id='$courseId'";
      $result1=mysqli_query($conn, $sql1);
    while ($row1=mysqli_fetch_assoc($result1)) {
      $labhour=mysqli_real_escape_string($conn, trim($row1['labHour']));
      $semester=mysqli_real_escape_string($conn,trim($row1['semester']));
       
    }
     $sql2="SELECT * FROM lab WHERE course_id='$courseId' AND st_id='$stid'";
      $result2=mysqli_query($conn, $sql2);
    while ($row2=mysqli_fetch_assoc($result2)) {
      $labAssId=mysqli_real_escape_string($conn, trim($row2['lec_id']));
      
       
    }


      //TO FETCH FACULTIES' ROLE FROM faculties table:
      $sql24="SELECT * FROM faculties   WHERE lec_id='$labAssId'";
      $result24=mysqli_query($conn, $sql24);
      while ($row24=mysqli_fetch_assoc($result24)) {
        $Role=mysqli_real_escape_string($conn, $row24['role']);
        // echo "<br>Role: ".$Role;

        
       }



      
       backAgainlab:
    
     $day=dayGeneratorForLab($dayslist);
     $labrmId=labRoomGenerator($conn, $courseId);
     $selectedTime=timeGeneratorForLab($startTime);
      

       
     backFromDaysGeneratorlab:
     backFromlabRoomGenerator:
     backTimeSetterlab:
     if ($labhour==2) {
      $startingtime=date('h:i', strtotime($selectedTime));
     $endTime = strtotime("+2 hours", strtotime($selectedTime));
     $endTime=date('h:i', $endTime);
     $decrmenttime=2;
     $endTime1 = strtotime("+1 hours", strtotime($selectedTime));
       $endTime1=date('h:i', $endTime1);
       $endTime2 = strtotime("+2 hours", strtotime($selectedTime));
       $endTime2=date('h:i', $endTime2);
        
      
       $sql3="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
       $sql4="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
       $sql5="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
    
        $sql6="SELECT * FROM lab_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
        $sql7="SELECT * FROM lab_timetable WHERE st_id='$stid' AND ending_time='$endTime2' AND days='$day'";
        $sql8="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
        $sql9="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
      
        $sql10="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime1' AND days='$day'";
        $sql11="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime2' AND days='$day'";
        $sql12="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND beginning_time='$startingtime' AND days='$day'";
        $sql13="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime1' AND days='$day'";
          
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
        $result10=mysqli_query($conn, $sql10);
        $rowcount10=mysqli_num_rows($result10);
        $result11=mysqli_query($conn, $sql11);
        $rowcount11=mysqli_num_rows($result11);
        $result12=mysqli_query($conn, $sql12);
        $rowcount12=mysqli_num_rows($result12);
        $result13=mysqli_query($conn, $sql13);
        $rowcount13=mysqli_num_rows($result13);

 
        if ($rowcount3==1||$rowcount4==1||$rowcount5==1||$rowcount6==1||$rowcount7==1||$rowcount8==1||$rowcount9==1||$rowcount10==1||$rowcount11==1||$rowcount12==1||$rowcount13==1) {
          $randvalue=mt_rand(0,2);
          if ($randvalue==2) {
            $selectedTime=timeGeneratorForLab($startTime);
            goto backTimeSetterlab;

            # code...
          }elseif ($randvalue==0) {
               $labrmId=labRoomGenerator($conn, $courseId);
               goto backFromlabRoomGenerator;
            
          }else{
            $day=dayGeneratorForLab($dayslist);
            goto backFromDaysGeneratorlab;
          }
          # code...
        }//End of if condition for row counting 3-16:
        else{
                 if ($Role=="Both") {
                   
                   $sql25="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime1' AND days='$day'";
                   $sql26="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND beginning_time='$startingtime' AND days='$day'";
                   $sql27="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime1' AND days='$day'";
                   $result25=mysqli_query($conn, $sql25);
                   $rowcount25=mysqli_num_rows($result25);
                   $result26=mysqli_query($conn, $sql26);
                   $rowcount26=mysqli_num_rows($result26);
                   $result27=mysqli_query($conn, $sql27);
                   $rowcount27=mysqli_num_rows($result27);
                   if ($rowcount25==1||$rowcount26==1||$rowcount27==1) {
                      $randvalue=mt_rand(0,2);
                        if ($randvalue==2) {
                          $selectedTime=timeGeneratorForLab($startTime);
                          goto backTimeSetterlab;

                          # code...
                        }elseif ($randvalue==0) {
                             $labrmId=labRoomGenerator($conn, $courseId);
                             goto backFromlabRoomGenerator;
                          
                        }else{
                          $day=dayGeneratorForLab($dayslist);
                          goto backFromDaysGeneratorlab;
                        }


                     # code...
                   }else{
                    $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime1' AND days='$day'";
                    $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime2' AND days='$day'";
                    $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$startingtime' AND days='$day'";
                    $sql20="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime1' AND days='$day'";
                   $result17=mysqli_query($conn, $sql17);
                   $rowcount17=mysqli_num_rows($result17);
                   $result18=mysqli_query($conn, $sql18);
                   $rowcount18=mysqli_num_rows($result18);
                   $result19=mysqli_query($conn, $sql19);
                   $rowcount19=mysqli_num_rows($result19);
                   $result20=mysqli_query($conn, $sql20);
                   $rowcount20=mysqli_num_rows($result20);

                   if ($rowcount17==1||$rowcount18==1||$rowcount19==1||$rowcount20==1) {
                         $randvalue=mt_rand(0,2);
                    if ($randvalue==1) {
                      $selectedTime=timeGeneratorForLab($startTime);
                      goto backTimeSetterlab;

                      # code...
                    }elseif ($randvalue==2) {
                         $labrmId=labRoomGenerator($conn, $courseId);
                         goto backFromlabRoomGenerator;
                      
                    }else{
                      $day=dayGeneratorForLab($dayslist);
                      goto backFromDaysGeneratorlab;
                     }

                   }//End of if condition for row counting 17-21:
                    else{
                      $sql22="SELECT * FROM lab_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND labrm_id='$labrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                        $result22=mysqli_query($conn, $sql22);
                        $rowcount22=mysqli_num_rows($result22);
                        if ($rowcount22==1) {
                          goto backAgainlab;
                          # code...
                        }else{
                           $query3="INSERT INTO lab_timetable(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$labAssId', '$labrmId', '$startingtime', '$endTime', '$day')";
                            $result23=mysqli_query($conn, $query3);
                            $labhour=$labhour-$decrmenttime;
                            $datetime1 = new DateTime($startingtime);
                             $datetime2 = new DateTime($endTime);
                             $interval = $datetime2->diff($datetime1);
                             $timediff=$interval->format('%H');
                             $timediff=(int)($timediff);
                            //$timediff=(int)($endTime-$startingtime);
                        archivetimetablelabFunction($conn,$college_id,$stid,$courseId,$labAssId,$labrmId,$startingtime,$endTime,$day,$semester,$timediff);
                             

                        }

                    }//End of else condition for row counting 17-21 inside role=Both:



                   }//end of else for rowcount 25-28 inside role=Both:

                 }else{

                    $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime1' AND days='$day'";
                    $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime2' AND days='$day'";
                    $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$startingtime' AND days='$day'";
                    $sql20="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime1' AND days='$day'";                 
                   $result17=mysqli_query($conn, $sql17);
                   $rowcount17=mysqli_num_rows($result17);
                   $result18=mysqli_query($conn, $sql18);
                   $rowcount18=mysqli_num_rows($result18);
                   $result19=mysqli_query($conn, $sql19);
                   $rowcount19=mysqli_num_rows($result19);
                   $result20=mysqli_query($conn, $sql20);
                   $rowcount20=mysqli_num_rows($result20);

                   if ($rowcount17==1||$rowcount18==1||$rowcount19==1||$rowcount20==1) {
                         $randvalue=mt_rand(0,2);
                    if ($randvalue==1) {
                      $selectedTime=timeGeneratorForLab($startTime);
                      goto backTimeSetterlab;

                      # code...
                    }elseif ($randvalue==2) {
                         $labrmId=labRoomGenerator($conn, $courseId);
                         goto backFromlabRoomGenerator;
                      
                    }else{
                      $day=dayGeneratorForLab($dayslist);
                      goto backFromDaysGeneratorlab;
                     }

                   }//End of if condition for row counting 17-21:
                    else{
                      $sql22="SELECT * FROM lab_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND labrm_id='$labrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                        $result22=mysqli_query($conn, $sql22);
                        $rowcount22=mysqli_num_rows($result22);
                        if ($rowcount22==1) {
                          goto backAgainlab;
                          # code...
                        }else{
                           $query3="INSERT INTO lab_timetable(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$labAssId', '$labrmId', '$startingtime', '$endTime', '$day')";
                            $result23=mysqli_query($conn, $query3);
                            $labhour=$labhour-$decrmenttime;
                            $timediff=(int)($endTime-$startingtime);
                            archivetimetablelabFunction($conn,$college_id,$stid,$courseId,$labAssId,$labrmId,$startingtime,$endTime,$day,$semester,$timediff);

                        }

                    }//End of else condition for row counting 17-21:


            }//End of else for role checking condition:
 
         }//End of else for row counting 3-16:
       
     }//End of if for $labhour==2:
     else{
      $startingtime=date('h:i', strtotime($selectedTime));
     $endTime = strtotime("+3 hours", strtotime($selectedTime));
     $endTime=date('h:i', $endTime);
     $decrmenttime=3;
     $endTime1 = strtotime("+1 hours", strtotime($selectedTime));
       $endTime1=date('h:i', $endTime1);
       $endTime2 = strtotime("+2 hours", strtotime($selectedTime));
       $endTime2=date('h:i', $endTime2);
        
      
       $sql3="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
       $sql4="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
       $sql5="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
       $sql6="SELECT * FROM lecture_timetable WHERE st_id='$stid' AND beginning_time='$endTime2' AND days='$day'";

        $sql7="SELECT * FROM lab_timetable WHERE st_id='$stid' AND ending_time='$endTime1' AND days='$day'";
        $sql8="SELECT * FROM lab_timetable WHERE st_id='$stid' AND ending_time='$endTime2' AND days='$day'";
        $sql9="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$startingtime' AND days='$day'";
        $sql10="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime1' AND days='$day'";
        $sql11="SELECT * FROM lab_timetable WHERE st_id='$stid' AND beginning_time='$endTime2' AND days='$day'";

        $sql12="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime1' AND days='$day'";
        $sql13="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime2' AND days='$day'";
        $sql14="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND beginning_time='$startingtime' AND days='$day'";
        $sql15="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime1' AND days='$day'";
        $sql16="SELECT * FROM lab_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime2' AND days='$day'";
          
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

        if ($rowcount3==1||$rowcount4==1||$rowcount5==1||$rowcount6==1||$rowcount7==1||$rowcount8==1||$rowcount9==1||$rowcount10==1||$rowcount11==1||$rowcount12==1||$rowcount13==1||$rowcount14==1||$rowcount15==1||$rowcount16==1) {
          $randvalue=mt_rand(0,2);
          if ($randvalue==2) {
            $selectedTime=timeGeneratorForLab($startTime);
            goto backTimeSetterlab;

            # code...
          }elseif ($randvalue==0) {
               $labrmId=labRoomGenerator($conn, $courseId);
               goto backFromlabRoomGenerator;
            
          }else{
            $day=dayGeneratorForLab($dayslist);
            goto backFromDaysGeneratorlab;
          }
          # code...
        }//End of if condition for row counting 3-16:
        else{
                 if ($Role=="Both") {
                   
                   $sql25="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND ending_time='$endTime1' AND days='$day'";
                   $sql26="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND beginning_time='$startingtime' AND days='$day'";
                   $sql27="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime1' AND days='$day'";
                   $sql28="SELECT * FROM lecture_timetable WHERE lec_id='$labAssId' AND beginning_time='$endTime2' AND days='$day'";
                   $result25=mysqli_query($conn, $sql25);
                   $rowcount25=mysqli_num_rows($result25);
                   $result26=mysqli_query($conn, $sql26);
                   $rowcount26=mysqli_num_rows($result26);
                   $result27=mysqli_query($conn, $sql27);
                   $rowcount27=mysqli_num_rows($result27);
                   $result28=mysqli_query($conn, $sql28);
                   $rowcount28=mysqli_num_rows($result28);
                   if ($rowcount25==1||$rowcount26==1||$rowcount27==1||$rowcount28==1) {
                      $randvalue=mt_rand(0,2);
                        if ($randvalue==2) {
                          $selectedTime=timeGeneratorForLab($startTime);
                          goto backTimeSetterlab;

                          # code...
                        }elseif ($randvalue==0) {
                             $labrmId=labRoomGenerator($conn, $courseId);
                             goto backFromlabRoomGenerator;
                          
                        }else{
                          $day=dayGeneratorForLab($dayslist);
                          goto backFromDaysGeneratorlab;
                        }


                     # code...
                   }else{
                    $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime1' AND days='$day'";
                    $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime2' AND days='$day'";
                    $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$startingtime' AND days='$day'";
                    $sql20="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime1' AND days='$day'";
                    $sql21="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime2' AND days='$day'";

                   $result17=mysqli_query($conn, $sql17);
                   $rowcount17=mysqli_num_rows($result17);
                   $result18=mysqli_query($conn, $sql18);
                   $rowcount18=mysqli_num_rows($result18);
                   $result19=mysqli_query($conn, $sql19);
                   $rowcount19=mysqli_num_rows($result19);
                   $result20=mysqli_query($conn, $sql20);
                   $rowcount20=mysqli_num_rows($result20);
                   $result21=mysqli_query($conn, $sql21);
                   $rowcount21=mysqli_num_rows($result21);

                   if ($rowcount17==1||$rowcount18==1||$rowcount19==1||$rowcount20==1||$rowcount21==1) {
                         $randvalue=mt_rand(0,2);
                    if ($randvalue==1) {
                      $selectedTime=timeGeneratorForLab($startTime);
                      goto backTimeSetterlab;

                      # code...
                    }elseif ($randvalue==2) {
                         $labrmId=labRoomGenerator($conn, $courseId);
                         goto backFromlabRoomGenerator;
                      
                    }else{
                      $day=dayGeneratorForLab($dayslist);
                      goto backFromDaysGeneratorlab;
                     }

                   }//End of if condition for row counting 17-21:
                    else{
                      $sql22="SELECT * FROM lab_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND labrm_id='$labrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                        $result22=mysqli_query($conn, $sql22);
                        $rowcount22=mysqli_num_rows($result22);
                        if ($rowcount22==1) {
                          goto backAgainlab;
                          # code...
                        }else{
                           $query3="INSERT INTO lab_timetable(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$labAssId', '$labrmId', '$startingtime', '$endTime', '$day')";
                            $result23=mysqli_query($conn, $query3);
                            $labhour=$labhour-$decrmenttime;
                            $datetime1 = new DateTime($startingtime);
                             $datetime2 = new DateTime($endTime);
                             $interval = $datetime2->diff($datetime1);
                             $timediff=$interval->format('%H');
                             $timediff=(int)($timediff);
                            //$timediff=(int)($endTime-$startingtime);
                        archivetimetablelabFunction($conn,$college_id,$stid,$courseId,$labAssId,$labrmId,$startingtime,$endTime,$day,$semester,$timediff);
                             

                        }

                    }//End of else condition for row counting 17-21 inside role=Both:



                   }//end of else for rowcount 25-28 inside role=Both:


                   # code...
                 }else{

             

            $sql17="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime1' AND days='$day'";
            $sql18="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND ending_time='$endTime2' AND days='$day'";
            $sql19="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$startingtime' AND days='$day'";
            $sql20="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime1' AND days='$day'";
            $sql21="SELECT * FROM lab_timetable WHERE labrm_id='$labrmId' AND beginning_time='$endTime2' AND days='$day'";

           $result17=mysqli_query($conn, $sql17);
               $rowcount17=mysqli_num_rows($result17);
               $result18=mysqli_query($conn, $sql18);
               $rowcount18=mysqli_num_rows($result18);
               $result19=mysqli_query($conn, $sql19);
               $rowcount19=mysqli_num_rows($result19);
               $result20=mysqli_query($conn, $sql20);
               $rowcount20=mysqli_num_rows($result20);
               $result21=mysqli_query($conn, $sql21);
               $rowcount21=mysqli_num_rows($result21);

               if ($rowcount17==1||$rowcount18==1||$rowcount19==1||$rowcount20==1||$rowcount21==1) {
                     $randvalue=mt_rand(0,2);
                if ($randvalue==1) {
                  $selectedTime=timeGeneratorForLab($startTime);
                  goto backTimeSetterlab;

                  # code...
                }elseif ($randvalue==2) {
                     $labrmId=labRoomGenerator($conn, $courseId);
                     goto backFromlabRoomGenerator;
                  
                }else{
                  $day=dayGeneratorForLab($dayslist);
                  goto backFromDaysGeneratorlab;
                 }

               }//End of if condition for row counting 17-21:
                else{
                  $sql22="SELECT * FROM lab_timetable WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND labrm_id='$labrmId' AND beginning_time='$startingtime' AND ending_time='$endTime' AND days='$day'";
                    $result22=mysqli_query($conn, $sql22);
                    $rowcount22=mysqli_num_rows($result22);
                    if ($rowcount22==1) {
                      goto backAgainlab;
                      # code...
                    }else{
                       $query3="INSERT INTO lab_timetable(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days) VALUES('$stid', '$courseId', '$labAssId', '$labrmId', '$startingtime', '$endTime', '$day')";
                        $result23=mysqli_query($conn, $query3);
                        $labhour=$labhour-$decrmenttime;
                        $datetime1 = new DateTime($startingtime);
                         $datetime2 = new DateTime($endTime);
                         $interval = $datetime2->diff($datetime1);
                         $timediff=$interval->format('%H');
                         $timediff=(int)($timediff);
                        //$timediff=(int)($endTime-$startingtime);
                        archivetimetablelabFunction($conn,$college_id,$stid,$courseId,$labAssId,$labrmId,$startingtime,$endTime,$day,$semester,$timediff);

                    }

                }//End of else condition for row counting 17-21:







          }//End of else for role checking condition:

        }//End of else for row counting 3-16:

     }//End of else for $labhour>=3:

     


     }//end of labSchedulerFunction:
     function archivetimetablelabFunction($conn,$college_id,$stid,$courseId,$labAssId,$labrmId,$startingtime,$endTime,$day,$semester,$timediff){
      $currentDate=date("Y-m-d");
        $year='';
       
      $sql="SELECT * FROM semesterinterval WHERE coll_id='$college_id' AND startDate<='$currentDate' AND endDate>='$currentDate'";
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
        $sql1="SELECT * FROM archive_timetablelab WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$labAssId' AND startDate='$startDate' AND endDate='$endDate' AND timediff='$timediff'";
        $result1=mysqli_query($conn,$sql1);
        $rowcount1=mysqli_num_rows($result1);
        if ($rowcount1==1) {
          $sql2="UPDATE archive_timetablelab SET st_id='".$stid."', course_id='".$courseId."', lec_id='".$labAssId."', labrm_id='".$labrmId."', beginning_time='".$startingtime."', ending_time='".$endTime."', days='".$day."', startDate='".$startDate."', endDate='".$endDate."', year='".$year."', semester='".$semester."', timediff='".$timediff."' WHERE st_id='".$stid."' AND course_id='".$courseId."' AND lec_id='".$labAssId."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timediff."'";
          mysqli_query($conn,$sql2);
          # code...
        }else{
          $sql3=" INSERT INTO archive_timetablelab(st_id, course_id, lec_id, labrm_id, beginning_time, ending_time, days, startDate, endDate, year, semester, timediff) VALUES('".$stid."', '".$courseId."', '".$labAssId."', '".$labrmId."', '".$startingtime."', '".$endTime."', '".$day."', '".$startDate."', '".$endDate."', '".$year."', '".$semester."', '".$timediff."')";
          mysqli_query($conn,$sql3);

        }

        # code...
      }else{
        echo "semester have not set yet!pls set firts, before anything you do.";
      }


     }//End of archivetimetablelabFunction:

     function archivetimetableFunction($conn,$college_id,$stid,$courseId,$lecId,$classrmId,$startingtime,$endTime,$day,$semester,$timediff){
      $currentDate=date("Y-m-d");
        $year='';
       
      $sql="SELECT * FROM semesterinterval WHERE coll_id='$college_id' AND startDate<='$currentDate' AND endDate>='$currentDate'";
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
        $sql1="SELECT * FROM archive_timetablelecture WHERE st_id='$stid' AND course_id='$courseId' AND lec_id='$lecId' AND startDate='$startDate' AND endDate='$endDate' AND timediff='$timediff'";
        $result1=mysqli_query($conn,$sql1);
        $rowcount1=mysqli_num_rows($result1);
        if ($rowcount1==1) {
          $sql2="UPDATE archive_timetablelecture SET st_id='".$stid."', course_id='".$courseId."', lec_id='".$lecId."', classrm_id='".$classrmId."', beginning_time='".$startingtime."', ending_time='".$endTime."', days='".$day."', startDate='".$startDate."', endDate='".$endDate."', year='".$year."', semester='".$semester."', timediff='".$timediff."' WHERE st_id='".$stid."' AND course_id='".$courseId."' AND lec_id='".$lecId."' AND startDate='".$startDate."' AND endDate='".$endDate."' AND timediff='".$timediff."'";
          mysqli_query($conn,$sql2);
          # code...
        }else{
          $sql3=" INSERT INTO archive_timetablelecture(st_id, course_id, lec_id, classrm_id, beginning_time, ending_time, days, startDate, endDate, year, semester, timediff) VALUES('".$stid."', '".$courseId."', '".$lecId."', '".$classrmId."', '".$startingtime."', '".$endTime."', '".$day."', '".$startDate."', '".$endDate."', '".$year."', '".$semester."', '".$timediff."')";
          mysqli_query($conn,$sql3);

        }




        
        
      }else{
        echo "Semester have not set yet!pls set first, before anything you do.";
      }//End of else for rowcount:

      

     }//End of archivetimetableFunction:


//==========================================================
//TO CLEAR THE ENTRY BEFORE GENERATE THE REQUIRED TIMETABLE:
//==========================================================

     
function clearFunction($conn){
      
      $stId1=0;
      $lastLecturerId=0;
      $lastStudentId=0;
      $departmentId=mysqli_real_escape_string($conn, $_POST['department_name']);
      $sql26="SELECT * FROM groupofstudent WHERE dep_id='$departmentId' ORDER BY st_id DESC LIMIT 1";
            $result26=mysqli_query($conn, $sql26);
            while ($row26=mysqli_fetch_assoc($result26)) {
              $stId1=mysqli_real_escape_string($conn, trim($row26['st_id']));
              

              # code...
            }
            $sql27="SELECT * FROM lecture_timetable WHERE st_id='$stId1' ORDER BY st_id, lec_id DESC LIMIT 1";
            $result27=mysqli_query($conn, $sql27);
            while ($row27=mysqli_fetch_assoc($result27)) {
              $lastStudentId=mysqli_real_escape_string($conn, trim($row27['st_id']));
              $lastLecturerId=mysqli_real_escape_string($conn, trim($row27['lec_id']));
               
              # code...
            }//End of while for query 27;

      if (empty($departmentId)) {
          echo '<SCRIPT type="text/javascript"> swal("OOPS!", "field was not filled out!", "error");</SCRIPT>';
           
         }else{
            $sql1="SELECT * FROM groupofstudent WHERE dep_id='$departmentId'";
            $result1=mysqli_query($conn, $sql1);
            $rowcount1=mysqli_num_rows($result1);
            if ($rowcount1>0) {
               while ($row1=mysqli_fetch_assoc($result1)) {
                $studentId=mysqli_real_escape_string($conn, trim($row1['st_id']));

               $sql2="SELECT * FROM class WHERE st_id='$studentId'";
               $result2=mysqli_query($conn, $sql2);
               while ($row2=mysqli_fetch_assoc($result2)) {
                  $stid=$row2['st_id'];
                  $lecId=$row2['lec_id'];
                  $courseId=$row2['course_id'];

                  $sql3="SELECT * from courses where course_id='$courseId'";
                  $result3=mysqli_query($conn, $sql3);
                while ($row3=mysqli_fetch_assoc($result3)) {
                   $labrequirement=$row3['lab_requirement'];


                }
             
                $sql4="DELETE FROM lecture_timetable WHERE course_id='$courseId' AND st_id='$stid'";
                mysqli_query($conn,$sql4);
                if ($labrequirement=='Yes') {
                  $sql5="DELETE FROM lab_timetable WHERE course_id='$courseId' AND st_id='$stid'";
                    mysqli_query($conn,$sql5);
                    if (($lastStudentId==$stid&&$lastLecturerId==$lecId)||($lastLecturerId==0&&$lastStudentId==0)) {
                      // echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Cleared!", "success");</SCRIPT>';

                      # code...
                    }

                  # code...
                }//End of if condition for lab requirement:
                else{
                  if (($lastStudentId==$stid&&$lastLecturerId==$lecId)||($lastLecturerId==0&&$lastStudentId==0)) {
                      echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully Cleared!", "success");</SCRIPT>';

                      # code...
                    }
                }

               }//End of while for query 2: 


             }//End of while for retrieving student id:

         }//End of if condition for row count 1:
       

       }//End of else for emptieness of department id:

     }//End of clearFunction:

      # code...
    
  



  ?> 





  
 



				</div>
   <!-- ========================================
        END OF COL-10 (MAIN CONTENTS)
        ======================================== -->
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
										<!--  
                     Right SideBar  -->                                     <!-- end card-->					
							</div>
									
				</div>
							<!-- end row -->














            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
  

<footer class="footer">
    <span class="text-right">
    <strong>Copyright &copy; 2018-2019.</strong> <a target="_blank" href="#">Our Website</a>
    </span>
    <span class="float-right">
    developed by <a  href=""><b>MITian</b></a>
    </span>
  </footer>




</div>
<!-- END main -->



<script src="../assets/js/modernizr.min.js"></script>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
    
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/js/detect.js"></script>
<script src="../assets/js/fastclick.js"></script>
<script src="../assets/js/jquery.blockUI.js"></script>
<script src="../assets/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="../assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->

  <script src="../assets/Chart.min.js"></script>
  <script src="../assets/jquery.dataTables.min.js"></script>
  <script src="../assets/dataTables.bootstrap4.min.js"></script>

  <!-- Counter-Up-->
  <script src="../assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="../assets/plugins/counterup/jquery.counterup.min.js"></script>
  

<!-- <script src="jquery3.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery.min.js"></script> -->

<!--  <script src="bootstrap.min.js"></script> -->
 <script src="jquery.tabledit.js"></script>


	 



<script>
    $(document).ready(function() {
      // data-tables
      $('#example1').DataTable();
          
      // counter-up
      $('.counter').counterUp({
        delay: 10,
        time: 600
      });
    } );    
  </script>

<script type="text/javascript">
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
   $(document).ready(function(){
    $('#hiddderButton').click(function() {
      $('aside').toggleClass('active')
      // body...
    })

     
 
  })


 
    function form_Validation() {
    var department1=document.getElementById('department').value;
     
         if (department1=="") {
      document.getElementById('select').innerHTML="*please Select department first!";

      return false;
    }

     

      
 

        
    
  }

  $(document).ready(function(){
    $('#yesorno').on('change',function(){
      var yesornoId=$(this).val();
      if (yesornoId) {
        $.ajax({
          type:'POST',
          url:'ajaxData.php',
          data:'lab_requirement='+yesornoId,
          success:function(html){
            console.log(html);
            $('#labhours').html(html);

          }

        })

      }else{
        $('#labhours').html('<option value="">Select labhour first</option>');

      }

      })


  })

 
</script>

	 
	

</body>
</html>