          <?php

     include_once'header.php';
     include_once'../includes/dbConnection.inc.php';


 $dayslist=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  $dayslistlab=['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  $startTime1=['8:30', '9:30', '10:30', '11:30',  '14:30', '15:30', '16:30'];
  $startTime2=[ '8:30', '9:30', '10:30', '14:30', '15:30'];
  $endtime1=[ '9:30', '10:30', '11:30',  '12:30', '15:30', '16:30', '17:30'];
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
							
									 

					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-11">	

            <div class="alert alert-success" style="margin-top: 8px;">
               
              <strong style="font-style: italic;font-size: 16px;"><a href="adminPage.php">Home</a>/timetable/view/Edit_Timetable</strong> : you can change schedule if there is complain.
 
            </div>					
										 

         
          <?php
      // include_once'includes/dbConnection.inc.php';

        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");
   ?>
         

  <div class="card-body">
        <form method="POST" class="form" role="form" autocomplete="off" style="margin-top: 4px;" onsubmit="return form_Validation()">

           <div class="form-group">
           <label for="department" class="col-sm-6 control-label" style="font-weight: bold; font-style: italic; font-size: 18px;">Department:</label>
           <div class="col-sm-6">
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
             

             

           

            <div class="form-group col-sm-3" style="margin-bottom: 35px;">
                <button type="submit" name="view" class="btn btn-success" style="padding: 8px 12px; margin-left: 10px; float: right;">View</button>
            </div>

        </form>
    </div>

  <?php
  
  if (isset($_POST['view'])) {
      $departmentId=mysqli_real_escape_string($conn, trim($_POST['department_name']));
      if (empty($departmentId)) {
        echo '<SCRIPT type="text/javascript"> swal("OOPS!", "field was not filled out!", "error");</SCRIPT>';
        # code...
      }else{
        $sql="SELECT * FROM department WHERE dep_id='$departmentId'";
        $result=mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($result)) {
          $departmentName=mysqli_real_escape_string($conn, trim($row['dep_name']));
          # code...
        }//End of while loop for retrieve department name:
         
         
        $sql1="SELECT * FROM groupofstudent WHERE dep_id='$departmentId'";
        $result1=mysqli_query($conn, $sql1);
        $rowcount1=mysqli_num_rows($result1);
        
        if ($rowcount1>0) {
          while ($row1=mysqli_fetch_assoc($result1)) {
            $batchName=mysqli_real_escape_string($conn, trim($row1['batch_name']));
            $sectionName=mysqli_real_escape_string($conn, trim($row1['section_name']));
            $stId=mysqli_real_escape_string($conn, trim($row1['st_id']));
             
            $courselist=array();
            $courseidlist=array();
            $locationName=array();
            $locidlist=array();
            
            echo "<p style='padding: 0;margin: 1px;font-style: italic;font-size: 18px; font-weight: bold;'>".$departmentName.": ".$batchName.", ".$sectionName."</p><br>";
            echo '<div style="overflow-x:auto;">';
            echo '<table class="table table-striped table-bordered" style="padding: 0;margin: 0;font-style: italic;"> <thead class="table-success" style="padding: 0;margin: 0;font-style: italic; font-size:11px; background-color:#664d00;color:white;"><tr>';
            echo '<th>CId</th>';
            echo '<th>Mon<br>morning</th>';
            echo '<th>Mon<br>after noon</th>';
            echo '<th>Tues<br>morning</th>';
            echo '<th>Tues<br>after noon</th>';
            echo '<th>Wedn<br>morning</th>';
            echo '<th>Wedn<br>after noon</th>';
            echo '<th>Thur<br>morning</th>';
            echo '<th>Thur<br>after noon</th>';
            echo '<th>Fri<br>morning</th>';
            echo '<th>Fri<br>after noon</th>';
            echo '<th>Sat<br>morning</th>';
            echo '<th>Sat<br>after noon</th>';

            echo '</tr></thead><tbody style="font-size:13px; padding:0; margin:0;"><tr>';
            $courseIdvalue="empty";
            $value1='';
            $value2='';
            $value3='';
            $value4='';
            $value5='';
            $value6='';
            $value7='';
            $value8='';
            $value9='';
            $value10='';
            $value11='';
            $value12='';

            $sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId'";
            $result2=mysqli_query($conn, $sql2);
            $rowcount2=mysqli_num_rows($result2);
            if ($rowcount2>0) {
                while ($row2=mysqli_fetch_assoc($result2)) {
                    $courseId=mysqli_real_escape_string($conn,$row2['course_id']);
                    if ($courseId!=$courseIdvalue) {
                         
                        $value1=$courseId;
                        $value1.='col1';
                        $value2=$courseId;
                        $value2.='col2';
                        $value3=$courseId;
                        $value3.='col3';
                        $value4=$courseId;
                        $value4.='col4';
                        $value5=$courseId;
                        $value5.='col5';
                        $value6=$courseId;
                        $value6.='col6';
                        $value7=$courseId;
                        $value7.='col7';
                        $value8=$courseId;
                        $value8.='col8';
                        $value9=$courseId;
                        $value9.='col9';
                        $value10=$courseId;
                        $value10.='col10';
                        $value11=$courseId;
                        $value11.='col11';
                        $value12=$courseId;
                        $value12.='col12';
                     echo '<td>'.$courseId.'</td>';                    
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value7."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value8."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value9."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value10."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value11."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value12."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "</tr>";
                        # code...
                    }

                    
                                    

                $sql3="SELECT * FROM lecture_timetable WHERE course_id='$courseId' AND st_id='$stId'";
                $result3=mysqli_query($conn, $sql3);
                $rowcount3=mysqli_num_rows($result3);
                if ($rowcount3>0) {
                    $checking="lecture";
                    while ($row3=mysqli_fetch_assoc($result3)) {
                         $courseId=mysqli_real_escape_string($conn, trim($row3['course_id']));
                        $lecId=mysqli_real_escape_string($conn, trim($row3['lec_id']));
                        $classrmId=mysqli_real_escape_string($conn, trim($row3['classrm_id']));
                        $beginningTime=mysqli_real_escape_string($conn, trim($row3['beginning_time']));
                        $endingTime=mysqli_real_escape_string($conn, trim($row3['ending_time']));
                        $day=mysqli_real_escape_string($conn, trim($row3['days']));
                        list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11,$value12,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                        array_push($courseidlist, $courseId);
                        array_push($courselist, $coursename);
                        array_push($locidlist, $locId);
                        array_push($locationName, $locationname);
                         
                        # code...
                    }//End of while loop for lecturer_timetable:

            

                    # code...
                }//End of if for rowcount3 of lecturer_timetable:


                 $sql4="SELECT * FROM lab_timetable WHERE course_id='$courseId' AND st_id='$stId'";
                $result4=mysqli_query($conn, $sql4);
                $rowcount4=mysqli_num_rows($result4);
                if ($rowcount4>0) {
                    $checking="lab";
                    while ($row4=mysqli_fetch_assoc($result4)) {
                         $courseId=mysqli_real_escape_string($conn, trim($row4['course_id']));
                        $lecId=mysqli_real_escape_string($conn, trim($row4['lec_id']));
                        $classrmId=mysqli_real_escape_string($conn, trim($row4['labrm_id']));
                        $beginningTime=mysqli_real_escape_string($conn, trim($row4['beginning_time']));
                        $endingTime=mysqli_real_escape_string($conn, trim($row4['ending_time']));
                        $day=mysqli_real_escape_string($conn, trim($row4['days']));
                        list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11,$value12,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                        array_push($courseidlist, $courseId);
                        array_push($courselist, $coursename);
                        array_push($locidlist, $locId);
                        array_push($locationName, $locationname);
                        

                        
                        # code...
                    }//End of while loop for leab_timetable:

               
                    
                    
 
                }//End of if for rowcount3 of lab_timetable:


                                    
                $courseIdvalue=$courseId;
                    
                }//End of while loop for row2:


            }//End of if condition for rowcount2:

            
    

            echo "</tbody></table></div>";
            
            
        echo '<div style="overflow-x:auto;"><br>NB:';
        echo '<table class="table table-bordered" style="padding: 0;margin: 1px;font-style: italic; width:600px;"><tbody><tr>';
         
           $courselist=array_unique($courselist);
           $courseidlist=array_unique($courseidlist);
           $locidlist=array_unique($locidlist);
           $locationName=array_unique($locationName);
            
            echo "<td>";
           foreach ($courseidlist as $value) {
            echo "<br>".$value;

             # code...
           }
           echo "</td><td>";
            foreach ($courselist as $value) {
            echo "<br>".$value;

             # code...
           }
           echo "</td><td>";
           foreach ($locidlist as $value) {
            echo "<br>".$value;

             # code...
           }
           echo "</td><td>";
           foreach ($locationName as $value) {
            echo "<br>".$value;

             # code...
           }
           echo "</td>";


           echo "</tr></tbody></table></div>";

          

          }//End of while loop for $row1:
          
        }//End of if condition for $rowcount1:


      }//End of else for checking the emptiness of department id:

    
  }//End of if condition for isset submit:

  function identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10,$value11,$value12,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime){
                    $timevalue1='8:30';
                    $startingtime1=date('h:i', strtotime($timevalue1));
                    $timevalue2='11:30';
                    $startingtime2=date('h:i', strtotime($timevalue2));
                    $timevalue3='14:30';
                    $startingtime3=date('h:i', strtotime($timevalue3));
                    $timevalue4='16:30';
                    $startingtime4=date('h:i', strtotime($timevalue4));
                    $beginningTime=date('h:i',strtotime($beginningTime));
                    $endingTime=date('h:i',strtotime($endingTime));
                    $timeDiff=(int)($endingTime-$beginningTime);
    if ($day=='Monday') {
                    list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                    $lnamestring=(string)$lname;

                    
                    if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {

                       echo "<script type='text/javascript'>document.getElementById('".$value1."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                         
                        // echo "<script type='text/javascript'>document.getElementById('".$value1."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                       echo "<script type='text/javascript'>document.getElementById('".$value2."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                        // echo "<script type='text/javascript'>document.getElementById('".$value2."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                        }


                 }//end of if for day=monday:

                 elseif ($day=='Tuesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                
                if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {
                         
                      echo "<script type='text/javascript'>document.getElementById('".$value3."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                  //echo "<script type='text/javascript'>document.getElementById('".$value1."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                       echo "<script type='text/javascript'>document.getElementById('".$value4."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                         
                        // echo "<script type='text/javascript'>document.getElementById('".$value4."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                            # code...
                        }
                   # code...
                 }
                 elseif ($day=='Wednesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {
                         
                      echo "<script type='text/javascript'>document.getElementById('".$value5."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                       // echo "<script type='text/javascript'>document.getElementById('".$value5."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                         
                      echo "<script type='text/javascript'>document.getElementById('".$value6."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                       // echo "<script type='text/javascript'>document.getElementById('".$value6."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                            # code...
                        }
                   # code...
                 }
                 elseif ($day=='Thursday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {
                  echo "<script type='text/javascript'>document.getElementById('".$value7."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                         
                        
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                      echo "<script type='text/javascript'>document.getElementById('".$value8."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        }
                   # code...
                 }
                 elseif ($day=='Friday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                    if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {
                         
                      echo "<script type='text/javascript'>document.getElementById('".$value9."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                         
                      echo "<script type='text/javascript'>document.getElementById('".$value10."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        }
                   # code...
                 }
                 elseif ($day=='Saturday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  if (($beginningTime>=$startingtime1)&&($beginningTime<=$startingtime2)) {
                         
                     echo "<script type='text/javascript'>document.getElementById('".$value11."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        }

                    elseif (($beginningTime>=$startingtime3)&&($beginningTime<=$startingtime4)) {
                         
                     echo "<script type='text/javascript'>document.getElementById('".$value12."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        }
                   # code...
                 }
                
                
                # code...

             return array($fname,$lname,$coursename,$locationname,$locId);
              
  }//End of identfyingdayfunction:

  function forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId){

    if ($checking=='lecture') {
      $sql1="SELECT * FROM faculties WHERE lec_id='$lecId'";
    $result1=mysqli_query($conn,$sql1);
    $rowcount1=mysqli_num_rows($result1);
    if ($rowcount1>0) {
      while ($row1=mysqli_fetch_assoc($result1)) {
        $fname=mysqli_real_escape_string($conn,trim($row1['fname']));
        $lname=mysqli_real_escape_string($conn,trim($row1['lname']));
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:
    $sql2="SELECT * FROM class_room WHERE classrm_id='$classrmId'";
    $result2=mysqli_query($conn,$sql2);
    $rowcount2=mysqli_num_rows($result2);
    if ($rowcount2>0) {
      while ($row2=mysqli_fetch_assoc($result2)) {
        $rmname=mysqli_real_escape_string($conn,trim($row2['class_name']));
        $blockId=mysqli_real_escape_string($conn,trim($row2['block_id']));

       $sql3="SELECT * FROM block WHERE block_id='$blockId'";
       $result3=mysqli_query($conn,$sql3);
       $rowcount3=mysqli_num_rows($result3);
      if ($rowcount3>0) {
        while ($row3=mysqli_fetch_assoc($result3)) {
          $blockname=mysqli_real_escape_string($conn,trim($row3['block_name']));
          $locId=mysqli_real_escape_string($conn,trim($row3['loc_id']));

          $sql4="SELECT * FROM location WHERE loc_id='$locId'";
          $result4=mysqli_query($conn,$sql4);
         $rowcount4=mysqli_num_rows($result4);
        if ($rowcount4>0) {
          while ($row4=mysqli_fetch_assoc($result4)) {
            $locationname=mysqli_real_escape_string($conn,trim($row4['location_name']));
             
            # code...
          }//End of while loop for $row1 lab
          # code...
        }//End of if for $rowcount1 lab:
          # code...
        }//End of while loop for $row1 lab
        # code...
      }//End of if for $rowcount1 lab:



        # code...
      }//End of while loop for $row1 lab
      # code...
    }//End of if for $rowcount2 lab:

    $sql5="SELECT * FROM courses WHERE course_id='$courseId'";
    $result5=mysqli_query($conn,$sql5);
    $rowcount5=mysqli_num_rows($result5);
    if ($rowcount5>0) {
      while ($row5=mysqli_fetch_assoc($result5)) {
        $coursename=mysqli_real_escape_string($conn,trim($row5['course_name']));
        // $lname=mysqli_real_escape_string($conn,trim($row1['lname']));
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:

      # code...
    }elseif($checking=='lab'){

    $sql1="SELECT * FROM faculties WHERE lec_id='$lecId'";
    $result1=mysqli_query($conn,$sql1);
    $rowcount1=mysqli_num_rows($result1);
    if ($rowcount1>0) {
      while ($row1=mysqli_fetch_assoc($result1)) {
        $fname=mysqli_real_escape_string($conn,trim($row1['fname']));
        $lname=mysqli_real_escape_string($conn,trim($row1['lname']));
        # code...
      }//End of while loop for $row1 lab
      # code...
    }//End of if for $rowcount1 lab:

    $sql2="SELECT * FROM lab_room WHERE labrm_id='$classrmId'";
    $result2=mysqli_query($conn,$sql2);
    $rowcount2=mysqli_num_rows($result2);
    if ($rowcount2>0) {
      while ($row2=mysqli_fetch_assoc($result2)) {
        $rmname=mysqli_real_escape_string($conn,trim($row2['lab_name']));
        $blockId=mysqli_real_escape_string($conn,trim($row2['block_id']));

       $sql3="SELECT * FROM block WHERE block_id='$blockId'";
       $result3=mysqli_query($conn,$sql3);
       $rowcount3=mysqli_num_rows($result3);
      if ($rowcount3>0) {
        while ($row3=mysqli_fetch_assoc($result3)) {
          $blockname=mysqli_real_escape_string($conn,trim($row3['block_name']));
          $locId=mysqli_real_escape_string($conn,trim($row3['loc_id']));

          $sql4="SELECT * FROM location WHERE loc_id='$locId'";
          $result4=mysqli_query($conn,$sql4);
         $rowcount4=mysqli_num_rows($result4);
        if ($rowcount4>0) {
          while ($row4=mysqli_fetch_assoc($result4)) {
            $locationname=mysqli_real_escape_string($conn,trim($row4['location_name']));
             
            # code...
          }//End of while loop for $row1 lab
          # code...
        }//End of if for $rowcount1 lab:
          # code...
        }//End of while loop for $row1 lab
        # code...
      }//End of if for $rowcount1 lab:



        # code...
      }//End of while loop for $row2 lab
      # code...
    }//End of if for $rowcount2 lab:

    $sql5="SELECT * FROM courses WHERE course_id='$courseId'";
    $result5=mysqli_query($conn,$sql5);
    $rowcount5=mysqli_num_rows($result5);
    if ($rowcount5>0) {
      while ($row5=mysqli_fetch_assoc($result5)) {
        $coursename=mysqli_real_escape_string($conn,trim($row5['course_name']));
        // $lname=mysqli_real_escape_string($conn,trim($row1['lname']));
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:


    



    }//End of else for $checking :
    
    return array($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId);

  }//End of forLecturerAdnRoomFunction:


      
  



  ?>        
    

<!-- modal -->
    <!-- <button type="button" class="btn btn-success" data-target="#mymodal" data-toggle="modal" style="padding: 0; margin-left: 190px;" >Set Semester</button>
     -->      
                     <div class="modal" id="mymodal">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header bg-info">
                            <h4 class="text-white">Edit Timetable</h4>
                            <button type="button" class="close" data-dismiss="modal"> &times;</button>
                            
                          </div>
                          <div class="modal-body">
                            <p class="text"></p>
                            <form method="POST" class="editTimetableForm form" role="form" autocomplete="off" onsubmit="return form_Validation_modal()" style="margin-top: 8px;">

                               <div class="form-group col-sm-8">
                                <label style="margin-bottom: 0;">Days:</label>
                              <select name="day" class="day form-control" required="" id="days" style="font-style: italic; padding: 8px; font-size: 16px; margin-bottom: 4px;">
                                <?php 
                                 echo '<option value="">select day</option>';
                                foreach ($dayslist as $day) {    
                                  echo '<option value="'.$day.'">'.$day.'</option>';
                                  

                              }
                               ?>
                              </select>
                           <label style="margin-bottom: 0;">BeginningTime:</label>
                           <select name="startingtTime" class="startingtTime form-control" required="" id="startingtTimes" style="font-style: italic; padding: 8px; font-size: 16px; margin-bottom: 4px;">
                                <?php 
                                 echo '<option value="">select beginning time</option>';
                                foreach ($startTime1 as $time1) { 

                                  $time1=strtotime($time1);
                                  $time1=date('h:i',$time1);
                                  echo '<option value="'.$time1.'">'.$time1.'</option>';
                                  

                              }
                               ?>
                              </select>

                                <label style="margin-bottom: 0;">EndingTime:</label>
                               <select name="endingTime" class="endingTime form-control" required="" id="endingTimes" style="font-style: italic; padding: 8px; font-size: 16px; margin-bottom: 4px;">
                                <?php 
                                 echo '<option value="">select ending time</option>';
                                foreach ($endtime1 as $time2) { 

                                  $time2=strtotime($time2);
                                  $time2=date('h:i',$time2);
                                  echo '<option value="'.$time2.'">'.$time2.'</option>';
                                  

                              }
                               ?>
                              </select>
                              <!--  <label style="margin-bottom: 0;">Course Id:</label>
                              <select name="courseId" class="courseId form-control" id="courseIds" style="font-style: italic; padding: 8px; font-size: 16px;"></select> -->
                               <label style="margin-bottom: 0;">Lecturer Id:</label>
                              <select name="lecturerId" class="lecturerId form-control" required="" id="lecturerIds" style="font-style: italic; padding: 8px; font-size: 16px;"></select>
                              <span id="select1" class="text-danger font-weight-bold"></span>
                               <label style="margin-bottom: 0;">Section Id:</label>
                              <select name="sectionId"  class="sectionId form-control" required="" id="sectionIds" style="font-style: italic; padding: 8px; font-size: 16px;"></select>
                              <span id="select2" class="text-danger font-weight-bold"></span> 
                               <label style="margin-bottom: 0;">Room Id:</label>
                              <select name="roomId" class="roomId form-control" required="" id="roomIds" style="font-style: italic; padding: 8px; font-size: 16px;"></select>
                              <span id="select3" class="text-danger font-weight-bold"></span>
                                
                              
                          </div>                                            
                          <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-success" style="padding: 8px 18px; margin-left: 15px;">submit</button>
                        </div>

                        </form>

                            
                          </div>
                          
                        </div>
                        
                      </div>
                      
                     </div>
          <!-- end of modal -->


                       

  
 


				</div>
       <!--  ===============================
        END OF COL-10 (MAIN CONTETS OF PGM)
        ==================================== -->
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
              
              <div class="container">
                <a href="#top" class="to-top"><i class="fas fa-chevron-up"></i></a>
                
              </div>

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


 <script src="jquery.tabledit.js"></script>
 
 <!-- STYLE FOR SCROLL TO TOP -->
 <style>
    .to-top{
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #000;
      color: #fff;
      padding: 9px 12px;
      border-radius: 50%;
    }
    .to-top:hover{
      background: #d7d7d7;
      color: #000;
    }
   
 </style>
 <!-- SCRIPT FOR SCROLL TO TOP -->
 <script>
   $(document).ready(function(){
    var offset=250;
    var duration=500;
    $(window).scroll(function(){
      if ($(this).scrollTop()>offset) {
        $('.to-top').fadeIn(duration);
      }else{
        $('.to-top').fadeOut(duration);
      }

    
    })
    $('.to-top').click(function(){
      $('body,html').animate({scrollTop:0}, duration);
      // return false;
    })

   })
 </script>
 <!-- END OF SCRIPT AND STYLE FOR SCROLL TO TOP 
      ==========================================-->

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

     
        
    
}//End of form_validation:

function form_Validation_modal() {
    var sectionIds=document.getElementById('sectionIds').value;
    var lecturerIds=document.getElementById('lecturerIds').value;
    var roomIds=document.getElementById('roomIds').value;


      if (lecturerIds==""||lecturerIds=="not_available") {
      document.getElementById('select1').innerHTML="*Number only is allowed!<br>";

      return false;
     }   
       if (sectionIds==""||sectionIds=="not_available") {
      document.getElementById('select2').innerHTML="*Number only is allowed!<br>";

      return false;
     }

     if (roomIds=="") {
      document.getElementById('select3').innerHTML="*it is empty!<br>";

      return false;
     } 

     
        
    
}//End of form_validation:

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


$(document).on("submit", ".editTimetableForm", function(e){
 // e.preventDefault();
  var data={old_stId:stId, old_courseId:courseId, old_day:day, old_roomId:roomId, old_startingtime:startingtime, old_endingTime:endingTime, old_lecId:lecId, statuschecking:status, timeDiff1:timeDiff, new_stId:$(".sectionId").val(), new_day:$(".day").val(), new_roomId:$(".roomId").val(), new_startingtime:$(".startingtTime").val(), new_endingTime:$(".endingTime").val(), new_lecId:$(".lecturerId").val()};
    

   var url=window.location.origin+'/internProject/timetable/adminFiles/timetable_editor.php';
   // alert(JSON.stringify(data))
  $.ajax({
    type:'post',
    data: data,
    url:'http://localhost/internProject/timetable/adminFiles/timetable_editor.php',
    success: function(data){
      // alert(data)
    },
    error: function(error){
      alert('Can t complete request');
    }
  })

})


var stId, courseId, day, roomId, startingtime, endingTime, lecId, timeDiff, status;
$(document).on('click', '.mytd', function(e){
var $span=$(this).children('.mySpan');
   stId=$span.attr("stId");
   courseId=$span.attr("courseId");
   day=$span.attr("day");
   roomId=$span.attr("roomId");
   startingtime=$span.attr("startingtime");
   endingTime=$span.attr("endingTime");
   lecId=$span.attr("lecId");
   timeDiff=$span.attr("timediff");
   status=$span.attr("status");
   


 // $span.text("stId="+stId+" courseId="+courseId+" day="+day+" roomId="+roomId+" startingtime="+startingtime+" endingTime="+endingTime+" lecId="+lecId);
 // $('.text').text("stId="+stId+" courseId="+courseId+" day="+day+" roomId="+roomId+" startingtime="+startingtime+" endingTime="+endingTime+" lecId="+lecId);
 $('.text').text("lecture or lab hours: "+timeDiff);


})

$(document).ready(function(){
    $('#endingTimes').on('change',function(){
      var new_day=$("#days").val();
      var new_start_time=$("#startingtTimes").val();
      // var new_day=$("#days option:selected").text();
      // alert(day+"  "+courseId+"  "+new_day+"  "+new_start_time)
      var endTime1s=$(this).val();
      if (endTime1s) {
        $.ajax({
              type:'POST',
              url:'ajaxDataForEditTimetbale.php',
              data:{endtime_value:endTime1s, st_ID:stId, course_Id:courseId, room_Id:roomId, lec_Id:lecId, days:new_day, start_time:new_start_time, oldEndTime:endingTime, oldStartTime:startingtime, statuschecking:status, timeDiff1:timeDiff},
              success:function(html){
                // alert(JSON.decode(html));
                var data=$.parseJSON(html);
                Object.keys(data).forEach(function(key, value){
                  //main one
                $('#'+key).empty().append('<option value='+this[key]+'>'+this[key]+'</option>');

                }, data);
                 
               
              },
               
        })
      }else{
        $('#lecturerIds').html('<option value="">Select endTime first</option>');
        $('#sectionIds').html('<option value="">Select endTime  first</option>');
        $('#roomIds').html('<option value="">Select endTime  first</option>');
      }
    })
  })

</script>

	 
	

</body>
</html>

