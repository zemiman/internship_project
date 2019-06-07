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
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/addcourses</strong> : add courses of each department of this college.
 
            </div>					
										 
 <?php
       

      

        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             


   ?>
     
       

  <div class="card-body">
        <form method="POST" class="form bg-light" role="form" autocomplete="off" style="margin-top: 10px; padding-top: 20px; padding-bottom: 40px;" onsubmit="return form_Validation()">

      <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Dep't:</p>
              <select class="form-control col-sm-8" name="department_name" id="department" style="font-style: italic;  font-size: 14px;display: inline-block; text-align: center;">
            
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
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Course:</p>
            <input type="text" name="courses" class="form-control col-sm-8" id="coursename" placeholder=" Insert course name" style="font-style: italic; padding: 6px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="course-name" class="text-danger font-weight-bold"></span>
            </div>

             <div class="form-group col-sm-9" style=" text-align: center;">
                <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">CourseId:</p>
                <input type="text" name="courseId" class="form-control col-sm-8" id="courseid" placeholder=" Insert course id" style="font-style: italic; padding: 7px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="course-id" class="text-danger font-weight-bold"></span>
            </div>
 

             
       <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Course credit:</p>
           
              <select class="form-control col-sm-6" name="credit" id="credit1" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">  
                <option value="">Select Credit</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                 
   

           </select> 
           <span id="select1" class="text-danger font-weight-bold"></span>         
          
         
     </div>

        <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Lecture hour:</p>        
              <select class="form-control col-sm-6" name="hour" id="hours" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">  
                <option value="">Select lecture hour</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                
   

           </select> 
           <span id="select2" class="text-danger font-weight-bold"></span>         
          
        </div>
     
       <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">lab required:</p>
              <select class="form-control col-sm-6" name="yes" id="yesorno" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
                <option value="">lab required!</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                 
           

           </select> 
            <span id="select3" class="text-danger font-weight-bold"></span>         
          
        </div>

   <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px; margin-left: 5px;">lab hour:</p>
              <select class="form-control col-sm-6" name="labhour" id="labhours" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
                <option value="">select lab hour!</option>
                 
           

           </select> 
            <span id="select4" class="text-danger font-weight-bold"></span>         
          
       
     </div>          


           

            <div class="form-group col-sm-8" style="text-align: center;">
                <button type="submit" name="add" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>



    <?php
    
   if (isset($_POST['add'])) {
           include_once'semester.php';
           // echo "semester".$semester;

          if ($_SERVER['REQUEST_METHOD']=='POST') {

             $department=mysqli_real_escape_string($conn, $_POST['department_name']);
             $courses=mysqli_real_escape_string($conn, $_POST['courses']);
             $courseId=mysqli_real_escape_string($conn, $_POST['courseId']);
             $credit=mysqli_real_escape_string($conn, $_POST['credit']);
             $labhour=mysqli_real_escape_string($conn, $_POST['labhour']);
             $lecturehour=mysqli_real_escape_string($conn, $_POST['hour']);
             $yes=mysqli_real_escape_string($conn, $_POST['yes']);
             $semester=$semester;
             if ($labhour==0&&$yes=='No') {
              $labhour=1;

               # code...
             }

             if (empty($department)||empty($courses)||empty($courseId)||empty($credit)||empty($yes)||empty($semester)||empty($lecturehour)||empty($labhour)) {
              echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";
            

               
             }else{

                                  if ($labhour==1&&$yes=='No') {
                                  $labhour=0;

                                   # code...
                                 }
                               

                               $_SESSION['depm-id']=$department;
                               $departmentId=$_SESSION['depm-id'];

                               $sql="SELECT * FROM courses WHERE course_id='$courseId'";
                               $result=mysqli_query($conn,$sql);
                               $rowcount=mysqli_num_rows($result);

                                  if ($rowcount<1){
                                

                    

                              $sql="INSERT INTO courses(course_id, course_name, credit, lectureHour, labHour, lab_requirement, dep_id, semester) VALUES('$courseId', '$courses', '$credit', '$lecturehour', '$labhour', '$yes', '$departmentId', '$semester')";
                                   $result=mysqli_query($conn, $sql);
                               


                                if ($result) {
                                echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
                                        // header("Location:lecturer.php");
                                    
               
                           } 

              
             }else{
            echo '<SCRIPT type="text/javascript"> swal("Error!", "It has already added!", "error");</SCRIPT>';


             }

       # code...
      }

    







     # code...
   }


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
    var course=document.getElementById('coursename').value;
     var courseid=document.getElementById('courseid').value;
      var credit=document.getElementById('credit1').value;
        var hours=document.getElementById('hours').value;
       var yesornot=document.getElementById('yesorno').value;
       var labhours=document.getElementById('labhours').value;
       var semester1=document.getElementById('Semester1').value;
         if (department1=="") {
      document.getElementById('select').innerHTML="*please Select department first!";

      return false;
    }
    if (course=="") {
      document.getElementById('course-name').innerHTML="*please add course first!";

      return false;
    }
     

       if (courseid=="") {
      document.getElementById('course-id').innerHTML="*please add course id first!";

      return false;
    }

     if (credit=="") {
      document.getElementById('select1').innerHTML="*please Select credit of the course first!";

      return false;
    }
    if (hours=="") {
      document.getElementById('select2').innerHTML="*please Select lecturer hour of the course first!";

      return false;
    }

      if (yesornot=="") {
      document.getElementById('select3').innerHTML="*please decided first whethere the course required lab or not!";

      return false;
    }

      if (labhours=="") {
      document.getElementById('select4').innerHTML="*please Select lab hour of the course first!";

      return false;
    }

        if (semester1=="") {
      document.getElementById('select5').innerHTML="*please Select semester first!";

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