          <?php
     include_once'userHeader.php';
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


             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
                 <!--  div1 of main body -->

             </div>              

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
                      <div class="alert alert-success" style="margin-top: 8px;">
               
                       <strong style="font-style: italic;font-size: 16px;"><a href="userPage.php">Home</a>/My schedule/View</strong> : you can see or print schedule of yourslef.
         
                    </div>            
                  
              

            <?php
            $lecId=$_SESSION['lec_id'];
            $collegeId=$_SESSION['coll_id'];
            $sql="SELECT * FROM College";
            $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

         ?>
          
         

        <?php
  
   

      

         
  
           $currentDate=date("Y-m-d");
           

          $semester='empty';
           
          $sql="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$currentDate' AND endDate>='$currentDate'";
          $result=mysqli_query($conn, $sql);
          $rowcount=mysqli_num_rows($result);
          if ($rowcount>0) {
            # code...
           
          while ($row=mysqli_fetch_array($result)) {
            $startDate1=$row['startDate'];
            $endDate1=$row['endDate'];
             
            
          }

          $startDate1string1 = strtotime("+1 months", strtotime($startDate1));
          $datewithformat1 = date("Y-m-d", $startDate1string1);
          $StartDate1=date_create($datewithformat1);

          $StartDate1=date_format($StartDate1, "d F Y");
          $month1 = date('F', strtotime($StartDate1));

           

          if ($month1=='November'||$month1=='October') {

            if ($startDate1<=$currentDate&&$endDate1>=$currentDate) {
              $semester='Semester_1';

              # code...
            }
            # code...

          }

          elseif ($month1=='March'||$month1=='April') {

            if ($startDate1<=$currentDate&&$endDate1>=$currentDate) {
              $semester='Semester_2';

              # code ...
            }
            # code...

          }

        }//end of if condition for rowcount value:
          else{
             echo "<h4>semester has not been set yet!</h4>";
           // echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already set before!", "error");</SCRIPT>';
          }
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


        $sql="SELECT * FROM faculties WHERE lec_id='$lecId'";
        $result=mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($result)) {
          $fName=mysqli_real_escape_string($conn, trim($row['fname']));
          $lName=mysqli_real_escape_string($conn, trim($row['lname']));

        }
          
           
            $courselist=array();
            $courseidlist=array();
            $locationName=array();
            $locidlist=array();
            $sectionIdlist=array();
            $depNamelist=array();
            $batchNamelist=array();
            $sectionNamelist=array();
            $value01='001';
            // $value01=$stId;

            echo "<div id='".$value01."'>";
            echo "<p style='padding: 0;margin: 1px;font-style: italic;font-size: 18px; font-weight: bold;'>".$semester." &nbsp".$year." Academy Year! </p><br>";
            echo '<div style="overflow-x:auto;">';
            echo '<table class="table table-striped table-bordered" style="padding: 0;margin: 0;font-style: italic;"> <thead class="table-info" style="padding: 0;margin: 0;font-style: italic; background-color:#94b8b8;color:white;"><tr>';
            echo '<th>TimeSlot</th>';
            echo '<th>Monday</th>';
            echo '<th>Tuesday</th>';
            echo '<th>Wednesday</th>';
            echo '<th>Thursday</th>';
            echo '<th>Friday</th>';
            echo '<th>Saturday</th>';
            echo '</tr></thead><tbody style="font-size:13px; padding:0; margin:0;"><tr>';
            
            $sql2="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='8:30' AND ending_time='9:30'";
            $result2=mysqli_query($conn, $sql2);
            $rowcount2=mysqli_num_rows($result2);
            if ($rowcount2>0) {

                  $checking='lecturer';
                  $value1=$lecId;
                  $value1.='col1sql2';
                  $value2=$lecId;
                  $value2.='col2sql2';
                  $value3=$lecId;
                  $value3.='col3sql2';
                  $value4=$lecId;
                  $value4.='col4sql2';
                  $value5=$lecId;
                  $value5.='col5sql2';
                  $value6=$lecId;
                  $value6.='col6sql2';
                  echo '<td>8:30am-<br>9:30am</td>';
                  echo "<td id='".$value1."'></td>";
                  echo "<td id='".$value2."'></td>";
                  echo "<td id='".$value3."'></td>";
                  echo "<td id='".$value4."'></td>";
                  echo "<td id='".$value5."'></td>";
                  echo "<td id='".$value6."'></td>";  
                    
               while ($row2=mysqli_fetch_assoc($result2)) {
                $courseId=mysqli_real_escape_string($conn, trim($row2['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row2['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row2['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row2['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row2['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row2['days']));
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                 
                }//End of while loop for $row2:


              # code...
            }//End of if condition for $rowcount2:
                // echo "day: ".$day;
                 
            echo "</tr>";
             

          $sql3="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='8:30' AND ending_time='10:30'";
            $result3=mysqli_query($conn, $sql3);
            $rowcount3=mysqli_num_rows($result3);
            if ($rowcount3>0) {
              $checking='lecturer'; 
              $value1=$lecId;
              $value1.='col1sql3';
              $value2=$lecId;
              $value2.='col2sql3';
              $value3=$lecId;
              $value3.='col3sql3';
              $value4=$lecId;
              $value4.='col4sql3';
              $value5=$lecId;
              $value5.='col5sql3';
              $value6=$lecId;
              $value6.='col6sql3';  
              echo '<td>8:30am-<br>10:30am</td>';
              echo "<td id='".$value1."'></td>";
              echo "<td id='".$value2."'></td>";
              echo "<td id='".$value3."'></td>";
              echo "<td id='".$value4."'></td>";
              echo "<td id='".$value5."'></td>";
              echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3=mysqli_fetch_assoc($result3)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);


                # code...
              }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
            $sql3l2="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='8:30' AND ending_time='10:30'";
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
                    echo "<td id='".$value1."'></td>";
                    echo "<td id='".$value2."'></td>";
                    echo "<td id='".$value3."'></td>";
                    echo "<td id='".$value4."'></td>";
                    echo "<td id='".$value5."'></td>";
                    echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l2=mysqli_fetch_assoc($result3l2)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l2['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l2['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l2['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l2['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l2['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l2['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
            $sql3l="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='8:30' AND ending_time='11:30'";
            $result3l=mysqli_query($conn, $sql3l);
            $rowcount3l=mysqli_num_rows($result3l);
            if ($rowcount3l>0) {
              $checking='lab';
              $value1=$lecId;
              $value1.='col1sql31';
              $value2=$lecId;
              $value2.='col2sql31';
              $value3=$lecId;
              $value3.='col3sql31';
              $value4=$lecId;
              $value4.='col4sql31';
              $value5=$lecId;
              $value5.='col5sql31';
              $value6=$lecId;
              $value6.='col6sql31';
              echo '<td>8:30am-<br>11:30am</td>';
              echo "<td id='".$value1."'></td>";
              echo "<td id='".$value2."'></td>";
              echo "<td id='".$value3."'></td>";
              echo "<td id='".$value4."'></td>";
              echo "<td id='".$value5."'></td>";
              echo "<td id='".$value6."'></td>";     
               while ($row3l=mysqli_fetch_assoc($result3l)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

             $sql4="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='9:30' AND ending_time='10:30'";
            $result4=mysqli_query($conn, $sql4);
            $rowcount4=mysqli_num_rows($result4);
            if ($rowcount4>0) {
              $checking='lecturer';
              $value1=$lecId;
              $value1.='col1sql4';
              $value2=$lecId;
              $value2.='col2sql4';
              $value3=$lecId;
              $value3.='col3sql4';
              $value4=$lecId;
              $value4.='col4sql4';
              $value5=$lecId;
              $value5.='col5sql4';
              $value6=$lecId;
              $value6.='col6sql4';
              echo '<td>9:30am-<br>10:30am</td>';
              echo "<td id='".$value1."'></td>";
              echo "<td id='".$value2."'></td>";
              echo "<td id='".$value3."'></td>";
              echo "<td id='".$value4."'></td>";
              echo "<td id='".$value5."'></td>";
              echo "<td id='".$value6."'></td>";
                    
                    
               while ($row4=mysqli_fetch_assoc($result4)) {
                $courseId=mysqli_real_escape_string($conn, trim($row4['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row4['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row4['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row4['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row4['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row4['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
              }//End of while loop for $row4:


              # code...
            }//End of if condition for $rowcount4:
            echo "</tr>";

             $sql5="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='9:30' AND ending_time='11:30'";
            $result5=mysqli_query($conn, $sql5);
            $rowcount5=mysqli_num_rows($result5);
            if ($rowcount5>0) {

                $checking='lecturer';
                $value1=$lecId;
                $value1.='col1sql5';
                $value2=$lecId;
                $value2.='col2sql5';
                $value3=$lecId;
                $value3.='col3sql5';
                $value4=$lecId;
                $value4.='col4sql5';
                $value5=$lecId;
                $value5.='col5sql5';
                $value6=$lecId;
                $value6.='col6sql5';
                echo '<td>9:30am-<br>11:30am</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row5=mysqli_fetch_assoc($result5)) {
                $courseId=mysqli_real_escape_string($conn, trim($row5['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row5['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row5['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row5['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row5['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row5['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
               
              }//End of while loop for $row5:


              # code...
            }//End of if condition for $rowcount5:
            echo "</tr>";
            $sql3l3="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='9:30' AND ending_time='11:30'";
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
                    echo "<td id='".$value1."'></td>";
                    echo "<td id='".$value2."'></td>";
                    echo "<td id='".$value3."'></td>";
                    echo "<td id='".$value4."'></td>";
                    echo "<td id='".$value5."'></td>";
                    echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l3=mysqli_fetch_assoc($result3l3)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l3['course_id']));
                $lecId=mysqli_real_escape_string($conn, trim($row3l3['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l3['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l3['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l3['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l3['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql3l1="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='9:30' AND ending_time='12:30'";
            $result3l1=mysqli_query($conn, $sql3l1);
            $rowcount3l1=mysqli_num_rows($result3l1);
            if ($rowcount3l1>0) {
              $checking='lab'; 
              $value1=$lecId;
              $value1.='col1sql3l1';
              $value2=$lecId;
              $value2.='col2sql3l1';
              $value3=$lecId;
              $value3.='col3sql3l1';
              $value4=$lecId;
              $value4.='col4sql3l1';
              $value5=$lecId;
              $value5.='col5sql3l1';
              $value6=$lecId;
              $value6.='col6sql3l1';
              echo '<td>9:30am-<br>12:30pm</td>';
              echo "<td id='".$value1."'></td>";
              echo "<td id='".$value2."'></td>";
              echo "<td id='".$value3."'></td>";
              echo "<td id='".$value4."'></td>";
              echo "<td id='".$value5."'></td>";
              echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l1=mysqli_fetch_assoc($result3l1)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l1['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l1['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l1['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l1['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l1['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l1['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
               
              }//End of while loop for $row3:

              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
            $sql6="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='10:30' AND ending_time='11:30'";
            $result6=mysqli_query($conn, $sql6);
            $rowcount6=mysqli_num_rows($result6);
            if ($rowcount6>0) {

                $checking='lecturer';
                $value1=$lecId;
                $value1.='col1sql6';
                $value2=$lecId;
                $value2.='col2sql6';
                $value3=$lecId;
                $value3.='col3sql6';
                $value4=$lecId;
                $value4.='col4sql6';
                $value5=$lecId;
                $value5.='col5sql6';
                $value6=$lecId;
                $value6.='col6sql6';
                echo '<td>10:30am-<br>11:30am</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
               while ($row6=mysqli_fetch_assoc($result6)) {
                $courseId=mysqli_real_escape_string($conn, trim($row6['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row6['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row6['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row6['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row6['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row6['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
               
                }//End of while loop for $row6:
              
            }//End of if condition for $rowcount6:
            echo "</tr>";
            $sql7="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='10:30' AND ending_time='12:30'";
            $result7=mysqli_query($conn, $sql7);
            $rowcount7=mysqli_num_rows($result7);
            if ($rowcount7>0) {

                $checking='lecturer'; 
                $value1=$lecId;
                $value1.='col1sql7';
                $value2=$lecId;
                $value2.='col2sql7';
                $value3=$lecId;
                $value3.='col3sql7';
                $value4=$lecId;
                $value4.='col4sql7';
                $value5=$lecId;
                $value5.='col5sql7';
                $value6=$lecId;
                $value6.='col6sql7';    
                echo '<td>10:30am-<br>12:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row7=mysqli_fetch_assoc($result7)) {
                $courseId=mysqli_real_escape_string($conn, trim($row7['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row7['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row7['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row7['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row7['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row7['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
              }//End of while loop for $row7:


              # code...
            }//End of if condition for $rowcount7:
            echo "</tr>";
             $sql3l7="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='10:30' AND ending_time='12:30'";
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
                    echo "<td id='".$value1."'></td>";
                    echo "<td id='".$value2."'></td>";
                    echo "<td id='".$value3."'></td>";
                    echo "<td id='".$value4."'></td>";
                    echo "<td id='".$value5."'></td>";
                    echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l7=mysqli_fetch_assoc($result3l7)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l7['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l7['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l7['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l7['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l7['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l7['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

             $sql8="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='11:30' AND ending_time='12:30'";
            $result8=mysqli_query($conn, $sql8);
            $rowcount8=mysqli_num_rows($result8);
            if ($rowcount8>0) {

                $checking='lecturer';
                $value1=$lecId;
                $value1.='col1sql8';
                $value2=$lecId;
                $value2.='col2sql8';
                $value3=$lecId;
                $value3.='col3sql8';
                $value4=$lecId;
                $value4.='col4sql8';
                $value5=$lecId;
                $value5.='col5sql8';
                $value6=$lecId;
                $value6.='col6sql8';
                echo '<td>11:30am-<br>12:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row8=mysqli_fetch_assoc($result8)) {
                $courseId=mysqli_real_escape_string($conn, trim($row8['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row8['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row8['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row8['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row8['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row8['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
               
              }//End of while loop for $row8:
 
            }//End of if condition for $rowcount8:
            echo "</tr>";

             $sql9="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='2:30' AND ending_time='3:30'";
            $result9=mysqli_query($conn, $sql9);
            $rowcount9=mysqli_num_rows($result9);
            if ($rowcount9>0) {

                $checking='lecturer'; 
                $value1=$lecId;
                $value1.='col1sql9';
                $value2=$lecId;
                $value2.='col2sql9';
                $value3=$lecId;
                $value3.='col3sql9';
                $value4=$lecId;
                $value4.='col4sql9';
                $value5=$lecId;
                $value5.='col5sql9';
                $value6=$lecId;
                $value6.='col6sql9';       
                echo '<td>2:30pm-<br>3:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row9=mysqli_fetch_assoc($result9)) {
                $courseId=mysqli_real_escape_string($conn, trim($row9['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row9['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row9['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row9['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row9['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row9['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql10="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='2:30' AND ending_time='4:30'";
            $result10=mysqli_query($conn, $sql10);
            $rowcount10=mysqli_num_rows($result10);
            if ($rowcount10>0) {

                $checking='lecturer'; 
                $value1=$lecId;
                $value1.='col1sql10';
                $value2=$lecId;
                $value2.='col2sql10';
                $value3=$lecId;
                $value3.='col3sql10';
                $value4=$lecId;
                $value4.='col4sql10';
                $value5=$lecId;
                $value5.='col5sql10';
                $value6=$lecId;
                $value6.='col6sql10';        
                echo '<td>2:30pm-<br>4:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row10=mysqli_fetch_assoc($result10)) {
                $courseId=mysqli_real_escape_string($conn, trim($row10['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row10['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row10['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row10['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row10['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row10['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
               
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql3l8="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='2:30' AND ending_time='4:30'";
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
                    echo "<td id='".$value1."'></td>";
                    echo "<td id='".$value2."'></td>";
                    echo "<td id='".$value3."'></td>";
                    echo "<td id='".$value4."'></td>";
                    echo "<td id='".$value5."'></td>";
                    echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l8=mysqli_fetch_assoc($result3l8)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l8['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l8['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l8['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l8['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l8['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l8['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";
             $sql3l12="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='2:30' AND ending_time='5:30'";
            $result3l12=mysqli_query($conn, $sql3l12);
            $rowcount3l12=mysqli_num_rows($result3l12);
            if ($rowcount3l12>0) {
                $checking='lab';
                $value1=$lecId;
                $value1.='col1sql3l12';
                $value2=$lecId;
                $value2.='col2sql3l12';
                $value3=$lecId;
                $value3.='col3sql3l12';
                $value4=$lecId;
                $value4.='col4sql3l12';
                $value5=$lecId;
                $value5.='col5sql3l12';
                $value6=$lecId;
                $value6.='col6sql3l12';
                echo '<td>2:30pm-<br>5:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l12=mysqli_fetch_assoc($result3l12)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l12['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l12['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l12['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l12['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l12['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l12['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
              }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql11="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='3:30' AND ending_time='4:30'";
            $result11=mysqli_query($conn, $sql11);
            $rowcount11=mysqli_num_rows($result11);
            if ($rowcount11>0) {

                $checking='lecturer'; 
                $value1=$lecId;
                $value1.='col1sql11';
                $value2=$lecId;
                $value2.='col2sql11';
                $value3=$lecId;
                $value3.='col3sql11';
                $value4=$lecId;
                $value4.='col4sql11';
                $value5=$lecId;
                $value5.='col5sql11';
                $value6=$lecId;
                $value6.='col6sql11';                    
                echo '<td>3:30pm-<br>4:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row11=mysqli_fetch_assoc($result11)) {
                $courseId=mysqli_real_escape_string($conn, trim($row11['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row11['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row11['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row11['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row11['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row11['days']));
                
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);  
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);

                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                 
              }//End of while loop for $row9:

            }//End of if condition for $rowcount9:
            echo "</tr>";

            $sql12="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='3:30' AND ending_time='5:30'";
            $result12=mysqli_query($conn, $sql12);
            $rowcount12=mysqli_num_rows($result12);
            if ($rowcount12>0) {

                $checking='lecturer';
                $value1=$lecId;
                $value1.='col1sql12';
                $value2=$lecId;
                $value2.='col2sql12';
                $value3=$lecId;
                $value3.='col3sql12';
                $value4=$lecId;
                $value4.='col4sql12';
                $value5=$lecId;
                $value5.='col5sql12';
                $value6=$lecId;
                $value6.='col6sql12';
                echo '<td>3:30pm-<br>5:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row12=mysqli_fetch_assoc($result12)) {
                $courseId=mysqli_real_escape_string($conn, trim($row12['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row12['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row12['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row12['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row12['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row12['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
              }//End of while loop for $row9:
              # code...
            }//End of if condition for $rowcount9:
            echo "</tr>";
            $sql3l9="SELECT * FROM lab_timetable WHERE lec_id='$lecId' AND beginning_time='3:30' AND ending_time='5:30'";
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
                    echo "<td id='".$value1."'></td>";
                    echo "<td id='".$value2."'></td>";
                    echo "<td id='".$value3."'></td>";
                    echo "<td id='".$value4."'></td>";
                    echo "<td id='".$value5."'></td>";
                    echo "<td id='".$value6."'></td>";
                    
                    
               while ($row3l9=mysqli_fetch_assoc($result3l9)) {
                $courseId=mysqli_real_escape_string($conn, trim($row3l9['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row3l9['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row3l9['labrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row3l9['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row3l9['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row3l9['days']));
                // echo "day: ".$day;
                list($fname,$lname,$coursename,$locationname,$locId)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                           
               }//End of while loop for $row3:
              # code...
            }//End of if condition for $rowcount3:
            echo "</tr>";

            $sql13="SELECT * FROM lecture_timetable WHERE lec_id='$lecId' AND beginning_time='4:30' AND ending_time='5:30'";
            $result13=mysqli_query($conn, $sql13);
            $rowcount13=mysqli_num_rows($result13);
            if ($rowcount13>0) {

                $checking='lecturer';
                $value1=$lecId;
                $value1.='col1sql13';
                $value2=$lecId;
                $value2.='col2sql13';
                $value3=$lecId;
                $value3.='col3sql13';
                $value4=$lecId;
                $value4.='col4sql13';
                $value5=$lecId;
                $value5.='col5sql13';
                $value6=$lecId;
                $value6.='col6sql13';
                echo '<td>4:30pm-<br>5:30pm</td>';
                echo "<td id='".$value1."'></td>";
                echo "<td id='".$value2."'></td>";
                echo "<td id='".$value3."'></td>";
                echo "<td id='".$value4."'></td>";
                echo "<td id='".$value5."'></td>";
                echo "<td id='".$value6."'></td>";
                    
                    
               while ($row13=mysqli_fetch_assoc($result13)) {
                $courseId=mysqli_real_escape_string($conn, trim($row13['course_id']));
                $stId=mysqli_real_escape_string($conn, trim($row13['st_id']));
                $classrmId=mysqli_real_escape_string($conn, trim($row13['classrm_id']));
                $beginningTime=mysqli_real_escape_string($conn, trim($row13['beginning_time']));
                $endingTime=mysqli_real_escape_string($conn, trim($row13['ending_time']));
                $day=mysqli_real_escape_string($conn, trim($row13['days']));
                // echo "day: ".$day;
                 list($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName)=identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking);
                 array_push($courseidlist, $courseId);
                array_push($courselist, $coursename);
                array_push($locidlist, $locId);
                array_push($locationName, $locationname);
                array_push($sectionIdlist, $stId);
                array_push($sectionNamelist, $sectionName);
                array_push($batchNamelist, $batchName);
                array_push($depNamelist, $depName);
                
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
           $sectionIdlist=array_unique($sectionIdlist);
           $sectionNamelist=array_unique($sectionNamelist);
           $batchNamelist=array_unique($batchNamelist);
           $depNamelist=array_unique($depNamelist);

            
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
           foreach ($sectionIdlist as $value) {
        
            $sql120="SELECT * FROM groupofstudent WHERE st_id='$value'";
            $result120=mysqli_query($conn,$sql120);
            $rowcount120=mysqli_num_rows($result120);
            if ($rowcount120>0) {
              while ($row120=mysqli_fetch_assoc($result120)) {
                $batchName=mysqli_real_escape_string($conn,trim($row120['batch_name']));
                $sectionName=mysqli_real_escape_string($conn,trim($row120['section_name']));
                $depId=mysqli_real_escape_string($conn,trim($row120['dep_id']));
                # code...
              }//End of while loop for $row1:
              # code...
            }//End of if for $rowcount1:
            $sql14="SELECT * FROM department WHERE dep_id='$depId'";
            $result14=mysqli_query($conn,$sql14);
            $rowcount14=mysqli_num_rows($result14);
            if ($rowcount14>0) {
              while ($row14=mysqli_fetch_assoc($result14)) {
                $depName=mysqli_real_escape_string($conn,trim($row14['dep_name']));
                 
                # code...
              }//End of while loop for $row1:
              # code...
            }//End of if for $rowcount1:
            echo "<br>".$value."->".$depName." ".$batchName." ".$sectionName;

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
           // foreach ($locationName as $value) {
           //  echo "<br>".$value;

           //   # code...
           // }
           // echo "</td>";


           echo "</tr></tbody></table></div></div>";

           
           echo '<button onclick=printPdfFunction("'.$value01.'") class="btn btn-secondary" style="float: right; padding:2px 5px; font-style:italic;"><i class="fas fa-print"></i>print</button>';

           echo "<br><br><br>";

          

        //   }//End of while loop for $row1:
          
        // }//End of if condition for $rowcount1:


      

    

  function identifyingDay($value1,$value2,$value3,$value4,$value5,$value6,$courseId,$lecId,$classrmId,$stId,$day,$conn,$checking){
    if ($day=='Monday') {
                    list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                   $lnamestring=(string)$lname;
                   echo "<script type='text/javascript'>document.getElementById('".$value1."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId."</p>'</script>";
                   # code...
                 }

                 elseif ($day=='Tuesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                
                  echo "<script type='text/javascript'>document.getElementById('".$value2."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId." </p>'</script>";
                   # code...
                 }
                 elseif ($day=='Wednesday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  echo "<script type='text/javascript'>document.getElementById('".$value3."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId."</p>'</script>";
                   # code...
                 }
                 elseif ($day=='Thursday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  echo "<script type='text/javascript'>document.getElementById('".$value4."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId."</p>'</script>";
                   # code...
                 }
                 elseif ($day=='Friday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  echo "<script type='text/javascript'>document.getElementById('".$value5."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId."</p>'</script>";
                   # code...
                 }
                 elseif ($day=='Saturday') {
                  list($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName)=forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId);
                  $lnamestring=(string)$lname;
                  echo "<script type='text/javascript'>document.getElementById('".$value6."').innerHTML='<p style=\"font-size:13px;padding:0;\">".$courseId.",".$stId."<br>".$rmname.", ".$blockname.", ".$locId."</p>'</script>";
                   # code...
                 }
                
                
                # code...

             return array($fname,$lname,$coursename,$locationname,$locId,$batchName,$sectionName,$depName);
              
  }//End of identfyingdayfunction:

  function forLecturerAdnRoomFunction($conn,$stId,$lecId,$classrmId,$checking,$courseId){

    if ($checking=='lecturer') {
    $sql120="SELECT * FROM groupofstudent WHERE st_id='$stId'";
    $result120=mysqli_query($conn,$sql120);
    $rowcount120=mysqli_num_rows($result120);
    if ($rowcount120>0) {
      while ($row120=mysqli_fetch_assoc($result120)) {
        $batchName=mysqli_real_escape_string($conn,trim($row120['batch_name']));
        $sectionName=mysqli_real_escape_string($conn,trim($row120['section_name']));
        $depId=mysqli_real_escape_string($conn,trim($row120['dep_id']));
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:
    $sql14="SELECT * FROM department WHERE dep_id='$depId'";
    $result14=mysqli_query($conn,$sql14);
    $rowcount14=mysqli_num_rows($result14);
    if ($rowcount14>0) {
      while ($row14=mysqli_fetch_assoc($result14)) {
        $depName=mysqli_real_escape_string($conn,trim($row14['dep_name']));
         
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:
     
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
      $sql120="SELECT * FROM groupofstudent WHERE st_id='$stId'";
    $result120=mysqli_query($conn,$sql120);
    $rowcount120=mysqli_num_rows($result120);
    if ($rowcount120>0) {
      while ($row120=mysqli_fetch_assoc($result120)) {
        $batchName=mysqli_real_escape_string($conn,trim($row120['batch_name']));
        $sectionName=mysqli_real_escape_string($conn,trim($row120['section_name']));
        $depId=mysqli_real_escape_string($conn,trim($row120['dep_id']));
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:
    $sql14="SELECT * FROM department WHERE dep_id='$depId'";
    $result14=mysqli_query($conn,$sql14);
    $rowcount14=mysqli_num_rows($result14);
    if ($rowcount14>0) {
      while ($row14=mysqli_fetch_assoc($result14)) {
        $depName=mysqli_real_escape_string($conn,trim($row14['dep_name']));
         
        # code...
      }//End of while loop for $row1:
      # code...
    }//End of if for $rowcount1:

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
    
    return array($fname,$lname,$rmname,$blockname,$locationname,$coursename,$locId,$batchName,$sectionName,$depName);

  }//End of forLecturerAdnRoomFunction:


      
  



  ?>        




  
 


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
  function printPdfFunction(element1){
    var restorePage=document.body.innerHTML;
    var printcontents=document.getElementById(element1).innerHTML;
    document.body.innerHTML=printcontents;
    window.print();
    document.body.innerHTML=restorePage;

  }
</script> 



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
   $('#collegeid').on('change',function(){
      var collegeId=$(this).val();
      if (collegeId) {
        $.ajax({
          type:'POST',
          url:'../adminFiles/ajaxData.php',
          data:'college_Id='+collegeId,
          success:function(html){
            console.log(html);
            $('#departmentid').html(html);
            $('#sectionid').html('<option value="">select department first</option>');

          }

        })

      }else{
        $('#departmentid').html('<option value="">select college first</option>');
        $('#sectionid').html('<option value="">select department first</option>');

      }
    })
 $('#departmentid').on('change',function(){
   var departmentId=$(this).val();
   if (departmentId) {
    $.ajax({
      type:'POST',
      url:'../adminFiles/ajaxData.php',
      data:'user_departmentId='+departmentId,
      success:function(html){
        console.log(html);
        $('#sectionid').html(html);
      }
    })

   }else{
    $('#sectionid').html('<option value="">select department first</option>');

   }

 })



})

   

 
</script>

   
  

</body>
</html>