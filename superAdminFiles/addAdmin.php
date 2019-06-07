<?php
 include_once'adminHeader.php';
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


		</div>		 

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-8">						
			<div class="alert alert-success" style="margin-top: 4px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/admin/add</strong> : can add either admin or super admin of each College.
 
            </div>					
										 

          <?php
   

        // $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM college ORDER BY name";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             


   ?>

  

 
      <form action="#" method="POST" name="add_name" id="add_name" class="bg-light" style="margin-top: 25px; padding: 20px 10px 45px 10px;" onsubmit="return form_Validation()">

         <div class="form-group">
           <div class="col-sm-8"> 

             <p style="font-size: 16px; font-style: italic; display: inline-block;margin-bottom:3px;">  College:</p>
              
            <select name="college" class="form-control col-md-10" required id="collegeid" style="font-style: italic; font-size: 12px; display: inline-block; font-weight: bold; padding-top: 12px; overflow-y: scroll;">
              <option value="" style="font-style: italic; font-size: 12px; padding-right: 0; font-weight: bold; display: inline-block; padding-top: 24px; overflow-y: scroll;">select College </option>
             <?php while ($row = mysqli_fetch_array($result)){
         ?>
         <option value=" <?php echo $row['coll_id'];  ?> " style="font-style: italic; font-size: 12px; padding-right: 0; font-weight: bold; display: inline-block; padding-top: 24px; overflow-y: scroll;">
           <?php echo $row['name']; ?>
            
          </option>
          <?php
      }
      ?>        

            </select> 

            <span id="select" class="text-danger font-weight-bold"></span>         
          
        </div>
     </div> 
 
       
          <div class="form-group col-md-8" >
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Fname:</p>
             
               <input type="text" name="fname" id="fname" class="form-control name_list col-md-9" required="" autocomplete="off" placeholder="Enter first name" style="padding: 12px; display: inline-block;"> 
             
        
            <span id="fname1" class="text-danger font-weight-bold"></span>
          </div>
          <div class="form-group col-md-8" >
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Lname:</p>
             
               <input type="text" name="lname" id="lname" class="form-control name_list col-md-9" required="" autocomplete="off" placeholder="Enter last name" style="padding: 12px; display: inline-block;"> 
             
        
            <span id="lname1" class="text-danger font-weight-bold"></span>
          </div>

          <div class="form-group col-md-8" >
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Email:</p>
             
               <input type="email" name="email" id="email" class="form-control name_list col-md-9" required="" autocomplete="off" placeholder="email@gmail.com" style="padding: 12px; display: inline-block;"> 
            <span id="email1" class="text-danger font-weight-bold"></span>

          </div>


          <div class="form-group col-md-8" >
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Uname:</p>
             
               <input type="text" name="username" id="username" class="form-control name_list col-md-9" required="" autocomplete="off" placeholder="Enter user name" style="padding: 12px; display: inline-block;"> 
            <span id="username1" class="text-danger font-weight-bold"></span>
          </div>
          <div class="form-group col-md-8" >
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Password:</p>
             
               <input type="password" name="password" id="password" class="form-control name_list col-md-9" required="" autocomplete="off" placeholder="Enter password" style="padding: 12px; display: inline-block;"> 
             
        
            <span id="password1" class="text-danger font-weight-bold"></span>
          </div>


             <div class="form-group">
           
           <div class="col-sm-6">
           	<p style="font-style: italic; font-size: 16px; display: inline-block; margin-right: 8px;margin-bottom:3px;">Role:</p>
              <select class="form-control col-md-10" name="role" required="" title="please select role of this admin!!" id="role1" style="font-style: italic;  font-size: 16px; display: inline-block;">
            
                <option value="">Select Role</option>
                <option value="superAdmin">superAdmin</option>
                <option value="admin">admin</option>
                
           

           </select> 
        <span id="select2" class="text-danger font-weight-bold"></span>         
          
        </div>
     </div> 

      <div class="form-group">
           
           <div class="col-sm-6">
           	<p style="font-style: italic; font-size: 16px; display: inline-block; margin-bottom: 3px;">Status:</p>
              <select class="form-control col-md-10" name="status" required="" title="please select status of this admin!!" id="status1" style="font-style: italic;  font-size: 16px; display: inline-block;">
            
                <option value="">Select Status</option>
                <option value="Active">Active</option>
                <option value="Passive">Passive</option>
                
           

           </select> 
        <span id="select2" class="text-danger font-weight-bold"></span>         
          
        </div>
     </div>  

      


           <div class="checkbox col-sm-6">
            
              <input type="submit" name="submit" id="submit" value="Add" class="btn btn-success" style="float: right;">
            </div>
             
          
         </form>	


         <?php
         if (isset($_POST['submit'])) {
           if ($_SERVER['REQUEST_METHOD']=='POST') {

            $collegeId=mysqli_real_escape_string($conn, trim($_POST['college']));
            $fname=mysqli_real_escape_string($conn, trim($_POST['fname']));
            $lname=mysqli_real_escape_string($conn, trim($_POST['lname']));
            $email=mysqli_real_escape_string($conn, trim($_POST['email']));
            $status=mysqli_real_escape_string($conn, trim($_POST['status']));
            $username=mysqli_real_escape_string($conn, trim($_POST['username']));
            $password=mysqli_real_escape_string($conn, trim($_POST['password']));
             $role=mysqli_real_escape_string($conn, trim($_POST['role']));
             if (empty($collegeId)||empty($fname)||empty($lname)||empty($email)||empty($status)||empty($username)||empty($password)||empty($role)) {

              echo "<h4> You have forgetten unfilled field one or more. plse fill first!! </h4>";
               # code...
             }else{
              if (!preg_match("/^[a-zA-Z]*$/",$fname)||!preg_match("/^[a-zA-Z]*$/",$lname)) {
             
                  echo "<h4> You did not enter a correct first name or last name!</h4";
          }else{
              if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    echo "<h4> You have entered Invalid email!</h4>";
                  
              }else{

                if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,}$/", $password)) {
                    echo "<h3>the password does not meet the requirements!</h3>";
                            

                      }else{

                        $sql="SELECT * FROM users WHERE email='$email'";
                        $result=mysqli_query($conn,$sql);
                        $rowcount=mysqli_num_rows($result);

                       if ($rowcount<1){

                        $hashpassword=password_hash($password,PASSWORD_DEFAULT);
                        $sql1="INSERT INTO users(username, psw, email, role) VALUES('$username', '$hashpassword', '$email', '$role')";
                        $result1=mysqli_query($conn, $sql1);
                      
                        $sql="INSERT INTO admin(fname, lname, email, username, password, role, status, coll_id) VALUES('$fname', '$lname', '$email', '$username', '$hashpassword', '$role', '$status', '$collegeId')";
                        $result=mysqli_query($conn, $sql);
                         
                           if ($result&&$result1) {
                                echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
                                         
                                        //   exit();
               
                           } 


                          }else{
                            echo '<SCRIPT type="text/javascript"> swal("Error!", " he/she has already registered or someone use this email!", "error");</SCRIPT>';

                          }



                      }//end of else for password validation:


              }//End of else for email validation:
            }//end of else for fname and lnbame validation:

             }//end of else for emptiness:
             # code...
           }//end of if for server->request_method==post:
           # code...
         }//end of if for isset submit:

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

  


<!-- <script src="jquery3.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery.min.js"></script> -->

<!--  <script src="bootstrap.min.js"></script> -->
<!--  <script src="jquery.tabledit.js"></script>	 -->

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
	

</body>
</html>