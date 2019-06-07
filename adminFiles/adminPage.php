          <?php
     include_once'header.php';
     include_once'../includes/dbConnection.inc.php';


      

 if (isset($_POST['submit'])) {


              
  $_SESSION['coll_id']=$_POST['college'];
  $col=$_SESSION['coll_id'];

   


}


 

     ?>
                   <div class="row">
						<div class="col-xl-12">
							<div class="breadcrumb-holder">
									<h1 class="main-title float-left">Home</h1>
									<ol class="breadcrumb float-right">
										<li class="breadcrumb-item" style="font-style: italic;">Automated Timetable</li>
										 
									</ol>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- end row -->
             
						
							
					<div class="row">
							
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">

              <!-- div1 of main body -->

            </div>			 

					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9">	

          <?php
            if (isset($_SESSION['success']))
             {
             
             echo ' <div class="alert alert-success alert-dismissible" style="margin-top: 4px;">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Good!</strong>'.$_SESSION['success'].'
             
                        </div>';
             unset($_SESSION['success']);
            }
           ?>					
										 	

                                        
				  <?php

				 

				  $college_id=$_SESSION['coll_id'];
				   				   
				   
				   $sql="SELECT * from college where coll_id='$college_id'";
				    $result=mysqli_query($conn,$sql);
				    while ($row=mysqli_fetch_array($result)) {
				      $Name=$row['name'];
				      $_SESSION['name']=$row['name'];

				      $collegeId=$row['coll_id'];

				    }
				    $Namesession=$_SESSION['name'];
				    $_SESSION['coll_id']=$collegeId;
				echo "<h3 style='font-weight: bold; font-style: italic; text-align: center;'>".$Namesession."</h3";
				 
				 
				 

				 
				 ?>

				 <div class="container">
				 	 
          <div class="alert alert-warning">
            <strong>Warning!</strong>You must <a href="#" class="alert-link">set semester interval</a> first, before you do anything. 
            
          </div>
				 	<button type="button" class="btn btn-success" data-target="#mymodal" data-toggle="modal" style="padding: 0; margin-left: 190px; margin-bottom: 30px;" >Set Semester</button>

          <?php

           $currentDate=date("Y-m-d");
               
              $sql="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$currentDate' AND endDate>='$currentDate'";
              $result=mysqli_query($conn, $sql);
              $rowcount=mysqli_num_rows($result);
              if ($rowcount>0) {
                # code...
               
              while ($row=mysqli_fetch_array($result)) {
                $startDate1=$row['startDate'];
                $endDate1=$row['endDate'];
                 
                
              }//end of while loop 

              echo '<div class="alert alert-info">
            <strong>Info!</strong>semester interval has been set from '.$startDate1.' to '.$endDate1.'</div>';
             

            }
            else{
             echo '<div class="alert alert-warning">
            <strong>warning!</strong>semester is not set yet!pls set first before you anything . 
            
          </div>';

 }//End of else for rowcount:

          ?>

        

				 	
                     <div class="modal" id="mymodal">
                     	<div class="modal-dialog modal-dialog-centered">
                     		<div class="modal-content">
                     			<div class="modal-header bg-secondary text-white">
                     				<h4 class="text-white">Set Semester</h4>
                     				<button type="button" class="close" data-dismiss="modal"> &times;</button>
                     				
                     			</div>
                     			<div class="modal-body">
                     				<form method="POST" class="form" role="form" autocomplete="off" style="margin-top: 14px;">

					                     <div class="form-group col-sm-8">
							                <label for="dates" class="bg-success text-white" style="font-weight: bold; font-style: italic; font-size: 18px; text-align: center;">Start Date:</label>
							                <input type="date" name="date1" class="form-control" required="" id="dates" placeholder="user name" style="font-style: italic; padding: 8px; font-size: 16px;">
							                 
							            </div> 

							            <div class="form-group col-sm-8">
							                <label for="dates" class="bg-success text-white" style="font-weight: bold; font-style: italic; font-size: 18px; text-align: center;">End Date:</label>
							                <input type="date" name="date2" class="form-control" required="" id="dates" placeholder="user name" style="font-style: italic; padding: 8px; font-size: 16px;">
							                 
							            </div>         
												                   
					                <div class="form-group">
					                <button type="submit" name="submitmodal" class="btn btn-success" style="padding: 8px 18px; margin-left: 15px;">submit</button>
					              </div>

					              </form>
                     				
                     			</div>
                     			
                     		</div>
                     		
                     	</div>
                     	
                     </div>
                     <!-- End of Modal div -->
				 </div>
				 <!-- End of container class -->




                   


                   <?php
                     
                     if (isset($_POST['submitmodal'])) {
                     	$currentDate=date("y-m-d");
                     	$effectiveDate = strtotime("-3 months", strtotime($currentDate));


                     	$date1=mysqli_real_escape_string($conn, $_POST['date1']);
                     	$date2=mysqli_real_escape_string($conn, $_POST['date2']);
                     	$collegeId=$_SESSION['coll_id'];
                     	if (empty($date1)||empty($date2)||empty($collegeId)) {
                     		echo "You have not filled ethier of the input field!";

                     		# code...
                     	}else{
                     		$datebefore1 = strtotime("-1 months", strtotime($date1));
                     		$datebefore2 = strtotime("-2 months", strtotime($date1));
                     		$datebefore1 = date("Y-m-d", $datebefore1);
                     		$datebefore2 = date("Y-m-d", $datebefore2);
                     		$dateAfter1 = strtotime("+1 months", strtotime($date1));
                     		$dateAfter2 = strtotime("+2 months", strtotime($date1));
                     		$dateAfter1 = date("Y-m-d", $dateAfter1);
                     		$dateAfter2 = date("Y-m-d", $dateAfter2);
                     		$sql3="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$date1' AND startDate>='$datebefore1'";
                     		$result3=mysqli_query($conn, $sql3);
                     		$rowcount3=mysqli_num_rows($result3);
                     		$sql4="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$date1' AND startDate>='$datebefore2'";
                     		$result4=mysqli_query($conn, $sql4);
                     		$rowcount4=mysqli_num_rows($result4);

                     		$sql5="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate>='$date1' AND startDate<='$dateAfter1'";
                     		$result5=mysqli_query($conn, $sql5);
                     		$rowcount5=mysqli_num_rows($result5);
                     		$sql6="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate>='$date1' AND startDate<='$dateAfter2'";
                     		$result6=mysqli_query($conn, $sql6);
                     		$rowcount6=mysqli_num_rows($result6);

                     		if ($rowcount3>0||$rowcount4>0||$rowcount5>0||$rowcount6>0) {
                     			echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already set!", "error");</SCRIPT>';

                     			# code...
                     		}else{ 


                     		$sql1="SELECT * FROM semesterinterval WHERE startDate='$date1' AND endDate='$date2' AND coll_id='$collegeId'";
                     		$result1=mysqli_query($conn, $sql1);
                     		$rowcount1=mysqli_num_rows($result1);
                     		if ($rowcount1>0) {
                     			echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already set before!", "error");</SCRIPT>';
                     			# code...
                     		}else{
                     			
                     			$sql2="INSERT INTO semesterinterval(startDate, endDate, coll_id) VALUES('$date1', '$date2', '$collegeId')";
                     			$result2=mysqli_query($conn, $sql2);
                     			if ($result2) {
                                    echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully set!", "success");</SCRIPT>';
                     				# code...
                     			}
                     		}//end of else for rowcount variable:

                            }

                     	}//end of else for emptiness of date inputs:

                     	# code...
                     }//End of if isset condition:

                     // include_once'semester.php';
                   ?>


				</div>
				<!-- End of main body of col-9 div -->
									
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
		if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
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