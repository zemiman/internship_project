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
            <div class="alert alert-success" style="margin-top: 12px;">
               
              <strong style="font-style: italic; font-size: 17px;"><a href="adminPage.php">Home</a>/addlocation</strong> : add location which includes classes' and labs' of blocks.
 
            </div>						
										 

                         <?php
   

       

        $college_id=$_SESSION['coll_id'];
     
   ?>
       

 
       <form  method="POST" class="bg-light" style="margin-top: 40px; padding: 20px 10px 30px 12px;" onsubmit="return form_Validation()">
         
         <div class="form-group col-sm-11">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Location:[You can add more locations!]</p>
            <table class="table table-bordered" id="dynamic_field">
              <tr>
                <td><input type="text" name="name[]" id="name" class="form-control name_list" required="" autocomplete="off" placeholder="Enter Location Name" style="padding: 14px;"></td>
                <td><button type="button" name="add" id="add" class="btn btn-success" style="font-size: 14px;">Add More</button></td>
              </tr>
          
        </table>
            
            <span id="user-name" class="text-danger font-weight-bold"></span>
          </div>
         
           
           <div class="checkbox col-sm-7" style="text-align: center;">
                
              <input type="submit" name="submit" value="Add" class="btn btn-success">
            </div>
             
          
         </form>



        <?php

        if (isset($_POST['submit'])) {
          if ($_SERVER['REQUEST_METHOD']=='POST') {

             
            $locationNames= $_POST['name'];
            $college_id=mysqli_real_escape_string($conn, trim($college_id));
            if (empty($locationNames)||empty($college_id)) {
              echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";
              # code...
            }else{

                  $error=[];
                foreach ($locationNames as $value){ 

               $sql="SELECT * FROM location WHERE coll_id='$college_id' AND location_name='".$value."'";
                $result1=mysqli_query($conn,$sql);
                $rowcount=mysqli_num_rows($result1);

         if ($rowcount>0){
          $error='There is error!';
           echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already added!", "error");</SCRIPT>';
           break;


         } 

       }
       if (empty($error)){
               foreach ($locationNames as $value) {

                    // echo "<br>".$depId;
                  $result=mysqli_query($conn, "INSERT INTO location(location_name, coll_id) VALUES('".mysqli_real_escape_string($conn, $value)."', '".$college_id."')");

                    if ($result) {
                echo '<SCRIPT type="text/javascript"> swal("Good job!", "successfully added!", "success");</SCRIPT>';
            # code...
                }
                    # code...
                  }

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


    $(document).ready(function(){
     
      var i=1;
      $('#add').click(function(){

         i++;
         $('#dynamic_field').append(' <tr id="row'+i+'"><td><input type="text" name="name[]" required="" id="name" class="form-control name_list" autocomplete="off" placeholder="Enter Location Name" style="padding: 14px;"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

      }) 
      $(document).on('click','.btn_remove',function(){
        var button_id=$(this).attr("id");
        $("#row"+button_id+"").remove();
      })
       


  })

 
</script>
	

</body>
</html>