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
							
						 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
              <!--  div1 of main body -->

              </div>
                   

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">
            <div class="alert alert-success" style="margin-top: 8px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/adddepartment</strong> : add departments of this college.
 
            </div>




          <?php
   
        $college_id=$_SESSION['coll_id'];
     $sql="SELECT * FROM location where coll_id='$college_id'";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

             
   ?>
       

 
       <form action="addDepartment.php" method="POST" class="bg-light" style="margin-top: 40px; padding: 20px 0 30px 8px" onsubmit="return form_Validation()">
        <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Department:</p>
            <input type="text" name="name" id="username" class="form-control col-sm-8" autocomplete="off" placeholder="Insert Department" style="padding: 8px; display: inline-block; text-align: center; font-size: 14px;">
            <p><span id="user-name" class="text-danger font-weight-bold"></span></p>
          </div>
         <div class="form-group col-sm-9" style="text-align: center;">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Location:[you can select more than one location]</p>
           
              <select class="form-control col-sm-8" size="6" name="locations[]" id="department" required="" title="please select a location given for the department class and lab " multiple="multiple" style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
        
                 <?php while ($row = mysqli_fetch_array($result)){
             ?>
                 <option value=" <?php echo $row['loc_id'];?> " style="font-weight: bold; font-style: italic; line-height: 28px; font-size: 16px; margin: 14px;">
     <?php echo $row['location_name']; ?>
      
    </option>
    <?php
    

}
?>
           

           </select> 
            <span id="select" class="text-danger font-weight-bold"></span>         
          
        
     </div> 
           
           <div class="checkbox col-sm-8" style="text-align: center;">
            
              <input type="submit" name="submit" value="Add" class="btn btn-success" style="margin-left: 14px; margin-bottom: 12px;">
            </div>
             
          
         </form>



        <?php
        if (isset($_POST['submit'])) {
           $college_id=$_SESSION['coll_id'];

          if ($_SERVER['REQUEST_METHOD']=='POST') {
            // include_once'includes/dbConnection.inc.php';
            $error=array();

            if (empty($_POST['name'])) {
              $error[]="You have forgotten adding a department! pls reinsert it again, if you want to add it!!!";
              # code...
            }else{

              $depName=mysqli_real_escape_string($conn, trim($_POST['name']));

            }





        # code...
        }else{

           $error[]=" <h3 style='font-weight: bold; font-style: italic; text-align: center; color: blue;'>You have forgotten the entire field! pls enter again if want to  add it...</h3>";   

        }
          # code..

        if (empty($error)) {
                 $sql="SELECT * FROM department WHERE dep_name='$depName' AND coll_id='$college_id'";
                $result1=mysqli_query($conn,$sql);
                $rowcount=mysqli_num_rows($result1);

         if ($rowcount<1) {

           
          $sql="INSERT INTO department(dep_name, coll_id) VALUES('$depName', '$college_id')";
          $result=mysqli_query($conn,$sql);

             if ($result) {
              echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
               # code...
              $sql2="SELECT * from department where dep_name='$depName'";
              $result3=mysqli_query($conn, $sql2);
                if ($result3){
                  # code...
                
                while ($row=mysqli_fetch_array($result3)) {
                  $depId=$row['dep_id'];

                

                }
                 
                // if (isset($_POST['locations'])) {
                $locationslists=$_POST['locations'];
                if (empty($locationslists)) {
                 echo " <h3 style='font-weight: bold; font-style: italic; text-align: center; color: blue;'>You have not selected location!</h3>";   

                  # code...
                }else{
                  foreach ($locationslists as $value) {

                    // echo "<br>".$depId;
                  mysqli_query($conn, "INSERT INTO departmentlocation(loc_id, dep_id) VALUES('".mysqli_real_escape_string($conn, $value)."', '".$depId."')");

                    
                    # code...
                  }

                    
                }

                # code...
              // }
              }


             }else{

                     echo "<h2>System Error</h2>
                                  <p>You could not be registered due to a system error. We apologize 
                                   for any inconvenience.</p>";
        
                                    echo "<p>" . mysqli_error($conn) . "<br><br>Query: " . $sql . "</p>";
                                   // echo "<p>" . mysqli_error($conn) . "<br><br>Query: " . $qlt . "</p>";
             }
              

              

                }else{

                    // echo '<SCRIPT type="text/javascript"> swal("Error!", "It has already added!", "error");</SCRIPT>';
                  echo '<SCRIPT type="text/javascript"> swal("OOps!", "It has already been added!", "error");</SCRIPT>';

                }
              // mysqli_close($conn); 
              //           exit();  
          
        }else{



                echo '<h2>Error!</h2>
                 <p>The following error(s) occurred:<br>';
                   foreach ($errors as $msg) {

                 echo "<p> ->$msg<br>";
                   }
                echo '</p><h3>Please try again.</h3><p><br></p>';

               
   

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
    $('button').click(function() {
      $('aside').toggleClass('active')
      // body...
    })

     
 
  })


 
    function form_Validation() {
    var user=document.getElementById('username').value;
    if (user=="") {
      document.getElementById('user-name').innerHTML="*please add department first!";

      return false;
    }
     


    
  }

 
</script>
	

</body>
</html>