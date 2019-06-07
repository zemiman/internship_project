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
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/blocks</strong> : add blocks according to their locations.
 
            </div>      				
										 

               
                <?php
              $college_id=$_SESSION['coll_id'];
           $sql="SELECT * FROM location where coll_id='$college_id' ORDER BY location_name";
            $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

                   


         ?>

        

       
             <form action="blocks.php" method="POST" name="add_name" id="add_name" class="bg-light" style="margin-top: 40px; padding-bottom: 30px; padding-top: 20px; padding-left: 8px;" onsubmit="return form_Validation()">

          <div class="form-group col-sm-9">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Location:</p>
                    <select class="form-control col-sm-6" name="locations" id="department" required="" title="please select a location given for the department class and lab " style="font-style: italic;  font-size: 14px; display: inline-block; text-align: center;">
                      <option value="">Select Location</option>
              
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


              
             
            <div class="form-group col-sm-10">
            <p style="font-style: italic; font-size: 16px; display: inline-block;margin-bottom:3px;">Blocks:[you can add more than one blocks!]</p>
                  <table class="table table-bordered" id="dynamic_field">
                    <tr>
                      <td><input type="text" name="name[]" id="name" class="form-control name_list" required="" autocomplete="off" placeholder="Enter Block Name" style="padding: 14px;"></td>
                      <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                
              </table>
                  
                  <span id="user-name" class="text-danger font-weight-bold"></span>
                </div>
                 
                 


                 <div class="checkbox col-sm-7" style="text-align: center;">
                  
                    <input type="submit" name="submit" id="submit" value="Add" class="btn btn-success">
                  </div>
                   
                
               </form>

               <?php
               if (isset($_POST['submit'])) {
                if ($_SERVER['REQUEST_METHOD']=='POST') {

                   
                   $locations=mysqli_real_escape_string($conn, trim($_POST['locations']));
                  $blockname=$_POST['name'];
                  if (empty($locations)||empty($blockname)) {
                    echo "<h3> You have forgetten unfilled field one or more. plse fill first!! </h3>";
                    # code...
                  }else{

                        $error=[];
                      foreach ($blockname as $value){ 

                     $sql="SELECT * FROM block WHERE loc_id='$locations' AND block_name='".$value."'";
                      $result1=mysqli_query($conn,$sql);
                      $rowcount=mysqli_num_rows($result1);

               if ($rowcount==1){
                $error='There is error!';
                 echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already added!", "error");</SCRIPT>';
                 break;


               } 

             }
             if (empty($error)){
                     foreach ($blockname as $value) {

                          // echo "<br>".$depId;
                        $result=mysqli_query($conn, "INSERT INTO block(loc_id, block_name) VALUES('".$locations."', '".mysqli_real_escape_string($conn, $value)."')");

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


 
  //   function form_Validation() {
  //   var user=document.getElementById('name').value;
  //   if (user=="") {
  //     document.getElementById('user-name').innerHTML="*please add department first!";

  //     return false;
  //   }
     


    
  // }



  $(document).ready(function(){
     
      var i=1;
      $('#add').click(function(){

         i++;
         $('#dynamic_field').append(' <tr id="row'+i+'"><td><input type="text" name="name[]" required="" id="name" class="form-control name_list" autocomplete="off" placeholder="Enter Block Name" style="padding: 14px;"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

      }) 
      $(document).on('click','.btn_remove',function(){
        var button_id=$(this).attr("id");
        $("#row"+button_id+"").remove();
      })
       


  })

 
</script>
	 
	

</body>
</html>