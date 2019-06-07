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


             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
              <!--  div1 of main body -->

              </div>
                   

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">

            <div class="alert alert-success" style="margin-top: 8px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/addsections</strong> : add sections of each department of this college.
 
            </div>					
										 
<?php
        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             


   ?>
     
       

  <div class="card-body">
        <form method="POST" class="form bg-light" role="form" autocomplete="off" style="margin-top: 10px; padding-top: 20px; padding-bottom: 40px;" onsubmit="return form_Validation()">

         <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Department:</p>
            
              <select class="form-control col-sm-7" name="department_name" title="please select department !!" id="department" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
            
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
          
            <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Batch:</p>
                <input type="text" name="batch" class="form-control col-sm-8" id="batchname" placeholder="batch name" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="batch-name" class="text-danger font-weight-bold"></span>
            </div>


            <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Section:</p>
                <input type="text" name="section" class="form-control col-sm-8" id="sectionname" placeholder="section name" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="section-name" class="text-danger font-weight-bold"></span>
            </div>

 


              <?php
              $sql="SELECT * FROM courses";
              $result=mysqli_query($conn, $sql);
              $rowcount=mysqli_num_rows($result);


              ?>

      <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Semester:</p>
              <select class="form-control col-sm-7" name="semester" title="please select semester for this academic year!!" id="semester1" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
            
                <option value="">Select Semester</option>
                <option value="Semester_1">Semester_1</option>
                <option value="Semester_2">Semester_2</option>
                
           

           </select> 
        <span id="select2" class="text-danger font-weight-bold"></span>         
 
     </div>          
        





           <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Courses:[you can select more than course]:</p>
            
              <select class="form-control col-sm-8" name="Course[]" size="10" multiple="multiple" title="please select courses for this semester!!" id="courses" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
            
                <option value="">Select Courses</option>
                 
           

           </select> 
        <span id="select3" class="text-danger font-weight-bold"></span>         
          
        
     </div>   
         



            <div class="form-group col-sm-8" style="text-align: center;">
                <button type="submit" name="add" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>



    


<?php
if (isset($_POST['add'])) {

  if ($_SERVER['REQUEST_METHOD']=='POST') {
 
    $department=mysqli_real_escape_string($conn, $_POST['department_name']);
    $batch=mysqli_real_escape_string($conn, $_POST['batch']);
    $section=mysqli_real_escape_string($conn, $_POST['section']);

    $Course1= $_POST['Course'];


    if (empty($department)||empty($batch)||empty($section)||empty($Course1)) {

      echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";

      # code...
    }else{

        $sql="SELECT * FROM groupofstudent WHERE batch_name='$batch' AND section_name='$section' AND dep_id='$department'";
        $result=mysqli_query($conn,$sql);
        $rowcount=mysqli_num_rows($result);

         if ($rowcount<1) {
           # code...
         

         $_SESSION['depm-id']=$department;
         $departmentId=$_SESSION['depm-id'];
         $sql="INSERT INTO groupofstudent(batch_name, section_name, dep_id) VALUES('$batch', '$section', '$department')";
         $result=mysqli_query($conn, $sql);
         if ($result) {
          echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
                 
                $sql1="SELECT * FROM groupofstudent WHERE batch_name='$batch' AND section_name='$section' AND dep_id='$department'";
                $result2=mysqli_query($conn, $sql1);

                if ($result2) {
                  while ($row=mysqli_fetch_array($result2)) {
                    $stId=$row['st_id'];
                    # code...
                  }
                  # code...
                  $Course1= $_POST['Course'];

                  if (empty($Course1)) {

                       echo " <h3 style='font-weight: bold; font-style: italic; text-align: center; color: blue;'>You have not selected courses!</h3>";
                    # code...
                  }else{
                         

                    foreach ($Course1 as $value) {
                       mysqli_query($conn, "INSERT INTO studentscourses(st_id, course_id) VALUES('".$stId."', '".mysqli_real_escape_string($conn, $value)."')");
                      # code...
                    }



                  }


                




                }
         


           # code...
         }else{


                        echo "<h2>System Error</h2>
                                  <p>You could not be registered due to a system error. We apologize 
                                   for any inconvenience.</p>";
        
                                    echo "<p>" . mysqli_error($conn) . "<br><br>Query: " . $sql . "</p>";

         }




           }else{
             
             echo '<SCRIPT type="text/javascript"> swal("Error!", "It has already added!", "error");</SCRIPT>';
           }



    }








    # code...
  }






  # code...
  }



?>
 

				</div>
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
									 
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
    var batch=document.getElementById('batchname').value;
     var section=document.getElementById('sectionname').value;
     var semester1=document.getElementById('semester1').value;
       
       
         if (department1=="") {
      document.getElementById('select').innerHTML="*please Select department first!";

      return false;
    }
    if (batch=="") {
      document.getElementById('batch-name').innerHTML="*please add batch name first!";

      return false;
    }
     

       if (section=="") {
      document.getElementById('section-name').innerHTML="*please add section name of the class first!";

      return false;
    }

     if (semester1=="") {
      document.getElementById('select2').innerHTML="*please choose semester first!";

      return false;
    }

    
    
  }



  $(document).ready(function(){
    $('#semester1').on('change',function(){
      var semesterId=$(this).val();
      if (semesterId) {
        $.ajax({
              type:'POST',
              url:'ajaxData.php',
              data:'semester='+semesterId,
              success:function(html){
                console.log(html);
                $('#courses').html(html);
                // alert(html);
              }
        })
      }else{
        $('#courses').html('<option value="">Select Semester first</option>');
      }
    })
  })




   
</script>
	

</body>
</html>