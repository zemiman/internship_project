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
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/labRooms</strong> : add lab rooms of each blocks.
 
            </div>					
										 

          <?php
   

       

        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM location where coll_id='$college_id' ORDER BY location_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             


   ?>

  

 
       <form action="labRooms.php" method="POST" name="add_name" id="add_name" class="bg-light" style="margin-top: 40px; padding:20px 0 30px 10px;" onsubmit="return form_Validation()">

        <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Location:</p>
              <select class="form-control col-sm-7" name="locations" id="locations" required="" title="please select a location given for the department class and lab " style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
                <option value="">Select Location</option> 
        
                 <?php while ($row = mysqli_fetch_array($result)){
             ?>
                 <option value=" <?php echo $row['loc_id'];?> " style="font-weight: bold; font-style: italic; line-height: 30px; font-size: 16px; margin: 12px;">
     <?php echo $row['location_name']; ?>
      
    </option>
    <?php
    
    }
    ?>
           

           </select> 
            <span id="select" class="text-danger font-weight-bold"></span>         
        
     </div> 


   <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px; margin-left: 4px;">Block:</p>
              <select class="form-control col-sm-7" name="block" required=""  title="please select lecturer for this semester!!" id="Block" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
            
                <option value="">Select block</option>
                 
           

           </select> 
        <span id="select4" class="text-danger font-weight-bold"></span>         
      
     </div> 
 
       
          <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">labRm:</p>
            
              <input type="text" name="name" id="name" class="form-control name_list col-sm-7" required="" autocomplete="off" placeholder="Enter lab room Name" style="padding: 8px; display: inline-block; text-align: center; font-size: 14px;"> 
            
            <span id="user-name" class="text-danger font-weight-bold"></span>
          </div>
             <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px; margin-left: 4px;">Semester:</p>
              <select class="form-control col-sm-7" name="semester" required="" title="please select semester for this academic year!!" id="semester1" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
            
                <option value="">Select Semester</option>
                <option value="Semester_1">Semester_1</option>
                <option value="Semester_2">Semester_2</option>
                
           

           </select> 
        <span id="select2" class="text-danger font-weight-bold"></span>         
        
     </div>  


     <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; margin-bottom:3px;">Courses:</p>
              <select class="form-control col-sm-8" size="8" name="Course[]" required="" multiple="multiple"  title="please select courses for this semester!!" id="courses" style="font-style: italic;  font-size: 14px;text-align: center; display: inline-block;">
            
                <option value="">Select Courses</option>
                 
           

           </select> 
        <span id="select3" class="text-danger font-weight-bold"></span>         
        
     </div>        


           
           


           <div class="checkbox col-sm-8" style="text-align: center;">
            
              <input type="submit" name="submit" id="submit" value="Add" class="btn btn-success">
            </div>
             
          
         </form>

        


        <?php
         if (isset($_POST['submit'])) {
          if ($_SERVER['REQUEST_METHOD']=='POST') {

             
             $block=mysqli_real_escape_string($conn, trim($_POST['block']));
             $labname=mysqli_real_escape_string($conn, trim($_POST['name']));
             $CourseId=$_POST['Course'];
            // $labroomname=;
            if (empty($block)||empty($CourseId)||empty($labname)) {
              echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";
              
            }else{

               $sql="SELECT * FROM lab_room WHERE lab_name='".$labname."' AND block_id='".$block."'";
                $result1=mysqli_query($conn,$sql);
                $rowcount=mysqli_num_rows($result1);

              if ($rowcount<1){  

                    $sql2="INSERT INTO lab_room(lab_name, block_id) VALUES('".$labname."', '".$block."')";
                     $result2=mysqli_query($conn, $sql2);

                       $sql3="SELECT * FROM lab_room WHERE lab_name='$labname' AND block_id='$block'";
                       $result3=mysqli_query($conn, $sql3);
                       if ($result3) {
                        while ($row3=mysqli_fetch_assoc($result3)) {
                          $labrmId=mysqli_real_escape_string($conn, trim($row3['labrm_id']));


                       # code...
                             }
                                 $errors=[];
                                 foreach ($CourseId as $value) {
                                  $coursesId=mysqli_real_escape_string($conn, trim($value));
                                  $sql4="SELECT * FROM courses_lab WHERE labrm_id='$labrmId' AND course_id='$value'";
                                  $result4=mysqli_query($conn, $sql4);
                                  $rowcount4=mysqli_num_rows($result4);

                                 if ($rowcount4>0){
                                  $error='There is error!';
                                   echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already exist!", "error");</SCRIPT>';
                                   break;
                                 }


                                  # code...
                                }
                                if (empty($errors)) {
                                  foreach ($CourseId as $value) {
                                  $coursesId=mysqli_real_escape_string($conn, trim($value));
                                  $sql5="INSERT INTO courses_lab(labrm_id, course_id) VALUES('".$labrmId."', '".$coursesId."')";
                                  $result5=mysqli_query($conn, $sql5);
                                   if ($result5) {
                                       echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
            
                                      }

                                  # code...
                                }
                                  # code...
                              }

                                

                            
                         #  code...
                         }//End of if for result 3 check:
                    
                    # code...
                   
                }else{
                  echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already added!", "error");</SCRIPT>';
                               break;
                }



            }//End of else for empty checking condition:

            # code...
          }
           # code...
         }

         ?>


  
 

				</div>
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
										<!--  
                     Right SideBar  --> 
                     <!-- Scroll to top button -->

                <div class="container">
                    <a href="#top" class="to-top"><i class="fas fa-chevron-up"></i></a>
                    
                  </div>                                     <!-- end card-->					
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


 
    // function form_Validation() {
    // var user=document.getElementById('name').value;
    // if (user=="") {
    //   document.getElementById('user-name').innerHTML="*please add department first!";

    //   return false;
    // }
      



//Dependent dropdown list
 
  $(document).ready(function(){
    
    $('#locations').on('change',function(){
      var locationId=$(this).val();
      if (locationId) {
        $.ajax({
          type:'POST',
          url:'ajaxData.php',
          data:'loc_id='+locationId,
          success:function(html){
            console.log(html);
            $('#Block').html(html);

          }
        })

      }else{
        $('#Block').html('<option value="">Select location first</option>');

      }

    })
       $('#semester1').on('change',function(){
      var semesterValue=$(this).val();
      if (semesterValue) {
        $.ajax({
          type:'POST',
          url:'ajaxDatalabrm.php',
          data:'semester='+semesterValue,
          success:function(html){
            console.log(html);
            $('#courses').html(html);

          }
        })

      }else{
         
        $('#courses').html('<option value="">Select semester first</option>');

      }

    })


  })


 
</script>
	 
	

</body>
</html>