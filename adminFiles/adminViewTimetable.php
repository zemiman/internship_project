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


                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
                       <!--  div1 of main body -->

                   </div>
              
                   

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                      <div class="alert alert-success" style="margin-top: 8px;">
               
                       <strong style="font-style: italic;font-size: 16px;"><a href="adminPage.php">Home</a>/timetable/view/Edit_Timetable</strong> : you can view or print schedule of each section.
         
                    </div>            
                             

         
          <?php
      

        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");
   ?>
         

  <div class="card-body">
        <form method="POST" class="form" role="form" autocomplete="off" style="margin-top: 2px;" onsubmit="return form_Validation()">

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
             

             

           

            <div class="form-group col-sm-3" style="margin-bottom: 30px;">
                <button type="submit" name="view" class="btn btn-success" style="padding: 8px 14px; margin-left: 10px; float: right;">View</button>
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

        include_once'semester.php';
         $currentDate1=date("Y-m-d");
        $year='';
       
       

        $startDate1string = strtotime("+1 months", strtotime($startDate1));
        $datewithformat = date("Y-m-d", $startDate1string);
        $new_startDate1=date_create($datewithformat);
        $new_startDate1=date_format($new_startDate1, "d F Y");
        $month = date('F', strtotime($new_startDate1));

        $new_endDate1=$endDate1;
        $new_endDate1=date_create($new_endDate1);
        $new_endDate1=date_format($new_endDate1, "d F y");
        $new_endDate1 = date('y', strtotime($new_endDate1));

        $new_startDate1=$startDate1;
        $new_startDate1=date_create($new_startDate1);
        $new_startDate1=date_format($new_startDate1, "d F Y");
        $new_startDate1 = date('Y', strtotime($new_startDate1));

        $startDate2=$startDate1;
        $startDate2 = strtotime("+2 months", strtotime($startDate2));
        $startDate2 = date("Y-m-d", $startDate2);
        $startDate2=date_create($startDate2);
        $startDate2=date_format($startDate2, "d F Y");
        $startDate2 = date('Y', strtotime($startDate2));
   
        if (($month=='November'||$month=='October')&&($semester=='Semester_1')) {
          $year.=$new_startDate1;
          $year.='/';
          $year.=$new_endDate1;
           
        }elseif (($month=='February'||$month=='March'||$month=='April')&&($semester=='Semester_2')) {
             
         // $year.=$startDate2;
         //  $year.='/';
          $year.=$new_endDate1;
        }


        $sql="SELECT * FROM department WHERE dep_id='$departmentId'";
        $result=mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($result)) {
          $departmentName=mysqli_real_escape_string($conn, trim($row['dep_name']));
          
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
            $value01='001';
            $value01=$stId;

            echo "<div id='".$value01."'>";
            echo "<p style='padding: 0;margin: 1px;font-style: italic;font-size: 18px; font-weight: bold;'>".$departmentName.": ".$batchName.", ".$sectionName."&nbsp&nbsp&nbsp&nbsp".$semester." &nbsp".$year." Academy Year!</p><br>";
            echo '<div style="overflow-x:auto;">';
            echo '<table class="table table-striped table-bordered" style="padding: 0;margin: 0;font-style: italic;"> <thead class="table-info" style="padding: 1px;margin: 1px;font-style: italic; background-color:#94b8b8;color:white;"><tr>';
            echo '<th>TimeSlot</th>';
            echo '<th>Monday</th>';
            echo '<th>Tuesday</th>';
            echo '<th>Wednesday</th>';
            echo '<th>Thursday</th>';
            echo '<th>Friday</th>';
            echo '<th>Saturday</th>';
            echo '</tr></thead><tbody style="font-size:13px; padding:0; margin:0;"><tr>';
            $sql2="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='8:30' AND ending_time='9:30'";
            $result2=mysqli_query($conn, $sql2);
            $rowcount2=mysqli_num_rows($result2);
            if ($rowcount2>0) {

                  $checking='lecture';
                $value1=$stId;
                $value1.='col1';
                $value2=$stId;
                $value2.='col2';
                $value3=$stId;
                $value3.='col3';
                $value4=$stId;
                $value4.='col4';
                $value5=$stId;
                $value5.='col5';
                $value6=$stId;
                $value6.='col6';
         
                    echo '<td>8:30am-<br>9:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row2=mysqli_fetch_assoc($result2)) {
                $courseId=mysqli_real_escape_string($conn, trim($row2['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row2['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row2['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row2['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row2['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row2['days']));
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                 
                }//End of while loop for $row2:


              # code...
            }//End of if condition for $rowcount2:
                // echo "day: ".$day;
                 
            echo "</tr>";
             

          $sql3="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='8:30' AND ending_time='10:30'";
            $result3=mysqli_query($conn, $sql3);
            $rowcount3=mysqli_num_rows($result3);
            if ($rowcount3>0) {
              $checking='lecture';
                $value1=$stId;
                $value1.='col11';
                $value2=$stId;
                $value2.='col22';
                $value3=$stId;
                $value3.='col33';
                $value4=$stId;
                $value4.='col44';
                $value5=$stId;
                $value5.='col55';
                $value6=$stId;
                $value6.='col66';
         
                    echo '<td>8:30am-<br>10:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3=mysqli_fetch_assoc($result3)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);


                # code...
              }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
            $sql3l2="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='8:30' AND ending_time='10:30'";
            $result3l2=mysqli_query($conn, $sql3l2);
            $rowcount3l2=mysqli_num_rows($result3l2);
            if ($rowcount3l2>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l2';
                $value2=$stId;
                $value2.='col22l2';
                $value3=$stId;
                $value3.='col33l2';
                $value4=$stId;
                $value4.='col44l2';
                $value5=$stId;
                $value5.='col55l2';
                $value6=$stId;
                $value6.='col66l2';
         
                    echo '<td>8:30am-<br>10:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l2=mysqli_fetch_assoc($result3l2)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l2['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l2['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l2['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l2['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l2['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l2['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql3l="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='8:30' AND ending_time='11:30'";
            $result3l=mysqli_query($conn, $sql3l);
            $rowcount3l=mysqli_num_rows($result3l);
            if ($rowcount3l>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l';
                $value2=$stId;
                $value2.='col22l';
                $value3=$stId;
                $value3.='col33l';
                $value4=$stId;
                $value4.='col44l';
                $value5=$stId;
                $value5.='col55l';
                $value6=$stId;
                $value6.='col66l';
         
                    echo '<td>8:30am-<br>11:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l=mysqli_fetch_assoc($result3l)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

             $sql4="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='9:30' AND ending_time='10:30'";
            $result4=mysqli_query($conn, $sql4);
            $rowcount4=mysqli_num_rows($result4);
            if ($rowcount4>0) {
              $checking='lecture';
                $value1=$stId;
                $value1.='c1';
                $value2=$stId;
                $value2.='c2';
                $value3=$stId;
                $value3.='c3';
                $value4=$stId;
                $value4.='c4';
                $value5=$stId;
                $value5.='c5';
                $value6=$stId;
                $value6.='c6';
         
                    echo '<td>9:30am-<br>10:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row4=mysqli_fetch_assoc($result4)) {
                $courseId=mysqli_real_escape_string($conn, trim($row4['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row4['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row4['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row4['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row4['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row4['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row4:


              # code...
            }//End of if condition for $rowcount4:
            echo "</tr>";

             $sql5="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='9:30' AND ending_time='11:30'";
            $result5=mysqli_query($conn, $sql5);
            $rowcount5=mysqli_num_rows($result5);
            if ($rowcount5>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='cl11';
                $value2=$stId;
                $value2.='cl22';
                $value3=$stId;
                $value3.='cl33';
                $value4=$stId;
                $value4.='cl44';
                $value5=$stId;
                $value5.='cl55';
                $value6=$stId;
                $value6.='cl66';
         
                    echo '<td>9:30am-<br>11:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row5=mysqli_fetch_assoc($result5)) {
                $courseId=mysqli_real_escape_string($conn, trim($row5['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row5['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row5['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row5['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row5['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row5['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
               
              }//End of while loop for $row5:


              # code...
            }//End of if condition for $rowcount5:
            echo "</tr>";
            $sql3l3="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='9:30' AND ending_time='11:30'";
            $result3l3=mysqli_query($conn, $sql3l3);
            $rowcount3l3=mysqli_num_rows($result3l3);
            if ($rowcount3l3>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l6';
                $value2=$stId;
                $value2.='col22l6';
                $value3=$stId;
                $value3.='col33l6';
                $value4=$stId;
                $value4.='col44l6';
                $value5=$stId;
                $value5.='col55l6';
                $value6=$stId;
                $value6.='col66l6';
         
                    echo '<td>9:30am-<br>11:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l3=mysqli_fetch_assoc($result3l3)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l3['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l3['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l3['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l3['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l3['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l3['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql3l1="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='9:30' AND ending_time='12:30'";
            $result3l1=mysqli_query($conn, $sql3l1);
            $rowcount3l1=mysqli_num_rows($result3l1);
            if ($rowcount3l1>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l1';
                $value2=$stId;
                $value2.='col22l2';
                $value3=$stId;
                $value3.='col33l3';
                $value4=$stId;
                $value4.='col44l4';
                $value5=$stId;
                $value5.='col55l5';
                $value6=$stId;
                $value6.='col66l6';
         
                    echo '<td>9:30am-<br>12:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l1=mysqli_fetch_assoc($result3l1)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l1['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l1['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l1['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l1['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l1['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l1['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
               
              }//End of while loop for $row3:

              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
            $sql6="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='10:30' AND ending_time='11:30'";
            $result6=mysqli_query($conn, $sql6);
            $rowcount6=mysqli_num_rows($result6);
            if ($rowcount6>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col61';
                $value2=$stId;
                $value2.='col62';
                $value3=$stId;
                $value3.='col63';
                $value4=$stId;
                $value4.='col64';
                $value5=$stId;
                $value5.='col65';
                $value6=$stId;
                $value6.='co66';
         
                    echo '<td>10:30am-<br>11:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
               while ($row6=mysqli_fetch_assoc($result6)) {
                $courseId=mysqli_real_escape_string($conn, trim($row6['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row6['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row6['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row6['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row6['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row6['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
               
                }//End of while loop for $row6:
              
            }//End of if condition for $rowcount6:
            echo "</tr>";
            $sql7="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='10:30' AND ending_time='12:30'";
            $result7=mysqli_query($conn, $sql7);
            $rowcount7=mysqli_num_rows($result7);
            if ($rowcount7>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col71';
                $value2=$stId;
                $value2.='col72';
                $value3=$stId;
                $value3.='col73';
                $value4=$stId;
                $value4.='col74';
                $value5=$stId;
                $value5.='col75';
                $value6=$stId;
                $value6.='col76';
         
                    echo '<td>10:30am-<br>12:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row7=mysqli_fetch_assoc($result7)) {
                $courseId=mysqli_real_escape_string($conn, trim($row7['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row7['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row7['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row7['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row7['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row7['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row7:


              # code...
            }//End of if condition for $rowcount7:
            echo "</tr>";
            $sql3l7="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='10:30' AND ending_time='12:30'";
            $result3l7=mysqli_query($conn, $sql3l7);
            $rowcount3l7=mysqli_num_rows($result3l7);
            if ($rowcount3l7>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l7';
                $value2=$stId;
                $value2.='col22l7';
                $value3=$stId;
                $value3.='col33l7';
                $value4=$stId;
                $value4.='col44l7';
                $value5=$stId;
                $value5.='col55l7';
                $value6=$stId;
                $value6.='col66l7';
         
                    echo '<td>10:30am-<br>12:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l7=mysqli_fetch_assoc($result3l7)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l7['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l7['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l7['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l7['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l7['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l7['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

             $sql8="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='11:30' AND ending_time='12:30'";
            $result8=mysqli_query($conn, $sql8);
            $rowcount8=mysqli_num_rows($result8);
            if ($rowcount8>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col81';
                $value2=$stId;
                $value2.='col82';
                $value3=$stId;
                $value3.='col83';
                $value4=$stId;
                $value4.='col84';
                $value5=$stId;
                $value5.='col85';
                $value6=$stId;
                $value6.='col86';
         
                    echo '<td>11:30am-<br>12:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row8=mysqli_fetch_assoc($result8)) {
                $courseId=mysqli_real_escape_string($conn, trim($row8['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row8['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row8['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row8['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row8['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row8['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
               
              }//End of while loop for $row8:
 
            }//End of if condition for $rowcount8:
            echo "</tr>";

             $sql9="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='2:30' AND ending_time='3:30'";
            $result9=mysqli_query($conn, $sql9);
            $rowcount9=mysqli_num_rows($result9);
            if ($rowcount9>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col91';
                $value2=$stId;
                $value2.='col92';
                $value3=$stId;
                $value3.='col93';
                $value4=$stId;
                $value4.='col94';
                $value5=$stId;
                $value5.='col95';
                $value6=$stId;
                $value6.='col96';
         
                    echo '<td>2:30pm-<br>3:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row9=mysqli_fetch_assoc($result9)) {
                $courseId=mysqli_real_escape_string($conn, trim($row9['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row9['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row9['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row9['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row9['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row9['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql10="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='2:30' AND ending_time='4:30'";
            $result10=mysqli_query($conn, $sql10);
            $rowcount10=mysqli_num_rows($result10);
            if ($rowcount10>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col101';
                $value2=$stId;
                $value2.='col102';
                $value3=$stId;
                $value3.='col103';
                $value4=$stId;
                $value4.='col104';
                $value5=$stId;
                $value5.='col105';
                $value6=$stId;
                $value6.='col106';
         
                    echo '<td>2:30pm-<br>4:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row10=mysqli_fetch_assoc($result10)) {
                $courseId=mysqli_real_escape_string($conn, trim($row10['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row10['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row10['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row10['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row10['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row10['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
               
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql3l8="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='2:30' AND ending_time='4:30'";
            $result3l8=mysqli_query($conn, $sql3l8);
            $rowcount3l8=mysqli_num_rows($result3l8);
            if ($rowcount3l8>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l8';
                $value2=$stId;
                $value2.='col22l8';
                $value3=$stId;
                $value3.='col33l8';
                $value4=$stId;
                $value4.='col44l8';
                $value5=$stId;
                $value5.='col55l8';
                $value6=$stId;
                $value6.='col66l8';
         
                    echo '<td>2:30am-<br>4:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l8=mysqli_fetch_assoc($result3l8)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l8['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l8['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l8['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l8['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l8['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l8['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
             $sql3l12="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='2:30' AND ending_time='5:30'";
            $result3l12=mysqli_query($conn, $sql3l12);
            $rowcount3l12=mysqli_num_rows($result3l12);
            if ($rowcount3l12>0) {
                $checking='lab';
                $value1=$stId;
                $value1.='col11l12';
                $value2=$stId;
                $value2.='col22l22';
                $value3=$stId;
                $value3.='col33l32';
                $value4=$stId;
                $value4.='col44l42';
                $value5=$stId;
                $value5.='col55l52';
                $value6=$stId;
                $value6.='col66l62';
         
                    echo '<td>2:30pm-<br>5:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l12=mysqli_fetch_assoc($result3l12)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l12['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l12['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l12['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l12['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l12['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l12['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql11="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='3:30' AND ending_time='4:30'";
            $result11=mysqli_query($conn, $sql11);
            $rowcount11=mysqli_num_rows($result11);
            if ($rowcount11>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col111';
                $value2=$stId;
                $value2.='col112';
                $value3=$stId;
                $value3.='col113';
                $value4=$stId;
                $value4.='col114';
                $value5=$stId;
                $value5.='col115';
                $value6=$stId;
                $value6.='col116';
         
                    echo '<td>3:30pm-<br>4:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row11=mysqli_fetch_assoc($result11)) {
                $courseId=mysqli_real_escape_string($conn, trim($row11['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row11['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row11['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row11['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row11['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row11['days']));
                
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);  
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                 
              }//End of while loop for $row9:

            }//End of if condition for $rowcount9:
            echo "</tr>";

            $sql12="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='3:30' AND ending_time='5:30'";
            $result12=mysqli_query($conn, $sql12);
            $rowcount12=mysqli_num_rows($result12);
            if ($rowcount12>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col121';
                $value2=$stId;
                $value2.='col122';
                $value3=$stId;
                $value3.='col123';
                $value4=$stId;
                $value4.='col124';
                $value5=$stId;
                $value5.='col125';
                $value6=$stId;
                $value6.='col126';
         
                    echo '<td>3:30pm-<br>5:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row12=mysqli_fetch_assoc($result12)) {
                $courseId=mysqli_real_escape_string($conn, trim($row12['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row12['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row12['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row12['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row12['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row12['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql3l9="SELECT * FROM lab_timetable WHERE st_id='$stId' AND beginning_time='3:30' AND ending_time='5:30'";
            $result3l9=mysqli_query($conn, $sql3l9);
            $rowcount3l9=mysqli_num_rows($result3l9);
            if ($rowcount3l9>0) {
              $checking='lab';
                $value1=$stId;
                $value1.='col11l9';
                $value2=$stId;
                $value2.='col22l9';
                $value3=$stId;
                $value3.='col33l9';
                $value4=$stId;
                $value4.='col44l9';
                $value5=$stId;
                $value5.='col55l9';
                $value6=$stId;
                $value6.='col66l9';
         
                    echo '<td>3:30am-<br>5:30am</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row3l9=mysqli_fetch_assoc($result3l9)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l9['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l9['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l9['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l9['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l9['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l9['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql13="SELECT * FROM lecture_timetable WHERE st_id='$stId' AND beginning_time='4:30' AND ending_time='5:30'";
            $result13=mysqli_query($conn, $sql13);
            $rowcount13=mysqli_num_rows($result13);
            if ($rowcount13>0) {

                $checking='lecture';
                $value1=$stId;
                $value1.='col131';
                $value2=$stId;
                $value2.='col132';
                $value3=$stId;
                $value3.='col133';
                $value4=$stId;
                $value4.='col134';
                $value5=$stId;
                $value5.='col135';
                $value6=$stId;
                $value6.='col136';
         
                    echo '<td>4:30pm-<br>5:30pm</td>';
                    echo "<td id='".$value1."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value2."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value3."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value4."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value5."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    echo "<td id='".$value6."' data-target='#mymodal' data-toggle='modal' class='mytd'></td>";
                    
                    
               while ($row13=mysqli_fetch_assoc($result13)) {
                $courseId=mysqli_real_escape_string($conn, trim($row13['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row13['lec_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row13['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row13['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row13['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row13['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                
              }//End of while loop for $row9:


              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";



    

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
            $sql120="SELECT * FROM location WHERE loc_id='$value'";
            $result120=mysqli_query($conn,$sql120);
            $rowcount120=mysqli_num_rows($result120);
            if ($rowcount120>0) {
              while ($row120=mysqli_fetch_assoc($result120)) {
                $locName=mysqli_real_escape_string($conn,trim($row120['location_name']));
                 
                # code...
              }//End of while loop for $row1:
              # code...
            }//End of if for $rowcount1:

            echo "<br>".$value."->".$locName;

             # code...
           }
           echo "</td>";

            


           echo "</tr></tbody></table></div></div>";
           
           // echo '<button onclick=printPdfFunction("'.$value01.'") class="btn btn-secondary" style="float: right; padding:2px 5px; font-style:italic;"><i class="fas fa-print"></i>print</button>';

           echo "<br><br><br>";

          

          }//End of while loop for $row1:
          
        }//End of if condition for $rowcount1:


      }//End of else for checking the emptiness of department id:

    
  }//End of if condition for isset submit:





  function identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking,$beginningTime,$endingTime){
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
                    //$timeDiff=2;
                    $datetime1 = new DateTime($beginningTime);
                    $datetime2 = new DateTime($endingTime);
                     $interval = $datetime2->diff($datetime1);
                     $timeDiff=$interval->format('%H');
                     $timeDiff=(int)($timeDiff);
                     //$timeDiff=(int)($endingTime-$beginningTime);
    if ($day=='Monday') {
                list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                $lnamestring=(string)$lname;
 
                 echo "<script type='text/javascript'>document.getElementById('".$value1."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                   


                 }//end of if for day=monday:

                 elseif ($day=='Tuesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                
                  echo "<script type='text/javascript'>document.getElementById('".$value2."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
   
                         
                   # code...
                 }
                 elseif ($day=='Wednesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;     
                      echo "<script type='text/javascript'>document.getElementById('".$value3."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                       // echo "<script type='text/javascript'>document.getElementById('".$value6."').innerHTML='".$beginningTime."-".$endingTime." <br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."'</script>";
                             
                       
                 }
                 elseif ($day=='Thursday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                 
                      echo "<script type='text/javascript'>document.getElementById('".$value4."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                         
                 }
                 elseif ($day=='Friday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                     
                      echo "<script type='text/javascript'>document.getElementById('".$value5."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                        
                   # code...
                 }
                 elseif ($day=='Saturday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                   
                         
                     echo "<script type='text/javascript'>document.getElementById('".$value6."').innerHTML='<span class=\"mySpan\" stId=".$stId." courseId=".$courseId." day=".$day." roomId=".$classrmId." startingtime=".$beginningTime." endingTime=".$endingTime." lecId=".$lecId." timediff=".$timeDiff." status=".$checking.">".$courseId."<br>".$fname." ".$lnamestring[0].".<br>".$rmname.", ".$blockname.", ".$locId."</span>'</script>";
                             
                            # code...
                         
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


              <!-- Right SideBar  --> 
                            <!-- Scroll to top button -->

                            <div class="container">
                                <a href="#top" class="to-top"><i class="fas fa-chevron-up"></i></a>
                                
                              </div> 
                                                                            
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
   


 //$span.text("stId="+stId+" courseId="+courseId+" day="+day+" roomId="+roomId+" startingtime="+startingtime+" endingTime="+endingTime+" lecId="+lecId);
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
                // alert(html);
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