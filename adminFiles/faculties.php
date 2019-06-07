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
             
						



							
					<div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
              <!--  div1 of main body -->

              </div>
                   

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">
            <div class="alert alert-success" style="margin-top: 8px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/faculties/add</strong> : add Instructors and lab Assistants of this college.
 
            </div>

                                        
				     
                <?php

        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM department where coll_id='$college_id' ORDER BY dep_name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

     ?>



      <div class="card-body">
        <form method="POST" class="form bg-light" role="form" autocomplete="off" style="margin-top: 10px; padding-bottom: 40px;" onsubmit="return form_Validation()">
            <div class="form-group col-sm-9" style="padding-top: 20px; text-align: center;">
                <!-- <label for="ftname" style="font-weight: bold; font-style: italic; font-size: 19px; text-align: center;">First Name:</label> -->
                <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Fname:</p>
            <input type="text" name="fname" class="form-control col-sm-8" id="ftname" required="" placeholder="first name" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="firstname" class="text-danger font-weight-bold"></span>
            </div>

            <div class="form-group col-sm-9" style=" text-align: center;">
                <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Lname:</p>
                <input type="text" name="lname" class="form-control col-sm-8" id="ltname" required="" placeholder="last name" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="lastname" class="text-danger font-weight-bold"></span>
            </div>

            <div class="form-group col-sm-9" style=" text-align: center;">
                <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">E-mail:</p>
                <input type="email" name="email" class="form-control col-sm-8" required="" id="emailid" placeholder="email@gmail.com" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                <span id="emaild" class="text-danger font-weight-bold"></span>
            </div>

             
      <div class="form-group col-sm-9" style=" text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Department:</p>
              <select class="form-control col-sm-7" name="department_name" id="department" required="" style="font-style: italic;  font-size: 14px; padding: 7px; display: inline-block; text-align: center;">
            
                <option style="text-align: center;" value="">Select Department</option>
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
          <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Role:</p>
            
             <select class="form-control col-sm-6" name="role" id="roles" required="" style="font-style: italic;  font-size: 14px; padding: 7px; display: inline-block; text-align: center;">
            
                <option value="" style="text-align: center;">Select Role</option>
                 <option value="Instructor" style="text-align: center;">Instructor</option>
                  <option value="Assistant" style="text-align: center;">Assistant</option>
                   <option value="Both" style="text-align: center;">Both</option>
	                 
	           

           </select> 
            <span id="select" class="text-danger font-weight-bold"></span>         
          
        
     </div>          


         <div class="form-group col-sm-9" style=" text-align: center;">
               <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Uname:</p>
                <input type="text" name="username" class="form-control col-sm-8" id="username" placeholder="user name" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                <span id="user-name" class="text-danger font-weight-bold"></span>
            </div>


            <div class="form-group col-sm-9" style=" text-align: center;">
                <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Password:</p>
                 <input type="password" name="password" class="form-control col-sm-8" id="Password" placeholder="password" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" style="font-style: italic; padding: 8px; font-size: 14px; display: inline-block; text-align: center;">
                 <span id="passd" class="text-danger font-weight-bold"></span>
            </div>
           

            <div class="form-group col-sm-8" style="text-align: center;">
                <button type="submit" name="submit" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>



 




 <?php

   if (isset($_POST['submit'])) {

       if ($_SERVER['REQUEST_METHOD']=='POST') {
    $first_name=mysqli_real_escape_string($conn, $_POST['fname']);
    $last_name=mysqli_real_escape_string($conn, $_POST['lname']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $department=mysqli_real_escape_string($conn, $_POST['department_name']);
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
     $role=mysqli_real_escape_string($conn, $_POST['role']);

     
       if (empty($first_name)||empty($last_name)||empty($email)||empty($department)||empty($username)||empty($password)||empty($role)) {

           echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";
           
       }else{


          if (!preg_match("/^[a-zA-Z]*$/",$first_name)||!preg_match("/^[a-zA-Z]*$/",$last_name)) {
             
          
          echo "<h3> You did not enter a correct first name or last name!</h23";
          }else{
              if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    echo "<h3> You have entered Invalid email!</h3>";
                  
              }else{



                if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,}$/", $password)) {
                     echo "<h3>the password does not meet the requirements!</h3>";
                      
                      }else{
                       

                               $_SESSION['depm-id']=$_POST['department_name'];
                               $departmentId=$_SESSION['depm-id'];

                               if ($departmentId==0) {
                                echo "<h3>You have not selected department yet!</h3>";
                                 
                               }else{
                                    $sql="SELECT * FROM users WHERE email='$email'";
                                    $result=mysqli_query($conn,$sql);
                                    $rowcount=mysqli_num_rows($result);
           
                                   if ($rowcount<1){

                                    $hashpassword=password_hash($password,PASSWORD_DEFAULT);
                                    $sql1="INSERT INTO users(username, psw, email, role) VALUES('$username', '$hashpassword', '$email', 'user')";
                                    $result1=mysqli_query($conn, $sql1);
                                  
                                    $sql="INSERT INTO faculties(fname, lname, dep_id, email, role, username, password) VALUES('$first_name', '$last_name', '$departmentId', '$email', '$role', '$username', '$hashpassword')";
                                    $result=mysqli_query($conn, $sql);
                                     



                                       if ($result&&$result1) {
                                echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
                                         
                                        //   exit();

               
                           } 


                          }else{
                            echo '<SCRIPT type="text/javascript"> swal("Error!", "already registered!", "error");</SCRIPT>';

                          }

                                    

                               }



                          

                      }


              }


          }

    

       }





   }else{

    echo " <h3 style='font-weight: bold; font-style: italic; text-align: center; color: blue;'>You have forgotten the entire field! pls enter again if want to  add it...</h3>";
   }


        
   }
   // else{

   //  header("Location:lecturer.php");
    
   // }


 ?>





				</div>
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
										 
										<!--  Right sidebar	 -->	
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
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

  $(document).ready(function(){
    $('button').click(function() {
      $('aside').toggleClass('active')
      // body...
    })
 
 
  })




    function form_Validation() {
        var firstname=document.getElementById('ftname').value;
        var lastname=document.getElementById('ltname').value;
        var email=document.getElementById('emailid').value;
        var dep=document.getElementById('department').value;
        var user=document.getElementById('username').value;
        var psw=document.getElementById('Password').value;
        if (firstname=="") {
            document.getElementById('firstname').innerHTML="*please fill the first name field First!";

            return false;
        }
        if (lastname=="") {
            document.getElementById('lastname').innerHTML="*please fill the last name field First!";

            return false;
        }

        if (email=="") {
            document.getElementById('emaild').innerHTML="*please fill the email field First!";

            return false;
        }

         if (dep=="") {
            document.getElementById('select').innerHTML="*please select department First!";

            return false;
        }
         if (user=="") {
            document.getElementById('user-name').innerHTML="*please fill the username field First!";

            return false;
        }

        if (psw=="") {
            document.getElementById('passd').innerHTML="*please fill the Password field First!";

            return false;
        }


        
    }

 </script>
	

</body>
</html>