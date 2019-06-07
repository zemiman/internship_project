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
            				
         
          <?php
        
        $college_id=$_SESSION['coll_id'];
        $sql2="SELECT * FROM college WHERE coll_id='".$college_id."'";
        $result2=mysqli_query($conn,$sql2);
        while ($row2=mysqli_fetch_assoc($result2)) {
          $collegeName=$row2['name'];

          
        }
           
   ?>
       
   <div class="alert alert-success" style="margin-top: 8px;">
               
      <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/classRoomsView</strong> : List of Class Rooms of <?php echo $collegeName;?>.

    </div>  
    <div style="overflow-x:auto;">
    <table class="table table-striped table-bordered" id="tabledit" style="margin-top: 10px;">
      <thead class="thead-light">
        <tr>
          <th>rmId</th>
          <th>rmName</th>
          <th>blockId</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql="SELECT * FROM location WHERE coll_id='".$college_id."'";
        $result=mysqli_query($conn,$sql);
        while ($row=mysqli_fetch_assoc($result)) {

          $locId=mysqli_real_escape_string($conn, $row['loc_id']);
          $sql2="SELECT * FROM block WHERE loc_id='".$locId."'";
        $result2=mysqli_query($conn,$sql2);

          while ($row2=mysqli_fetch_assoc($result2)) {
               $blockId=mysqli_real_escape_string($conn,trim($row2['block_id']));

           $sql3="SELECT * FROM class_room WHERE block_id='".$blockId."'";
           $result3=mysqli_query($conn,$sql3);
           while ($row3=mysqli_fetch_assoc($result3)) {
            echo '<tr>
                <td>'.$row3["classrm_id"].'</td>
                <td>'.$row3["class_name"].'</td>
                <td>'.$row3["block_id"].'</td>
                 

             </tr>';

             # code...
             }

          
          # code...
          }//end of the 2nd while loop:
          # code...
        }//end of the 1st while loop:

        
        
        ?>
         
      </tbody>
    </table>
  </div>
 

  
 

				</div>
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
										<!--  
                     Right SideBar  -->  
                     <!-- Scroll to top button -->

                <div class="container">
                    <a href="#top" class="to-top"><i class="fas fa-chevron-up"></i></a>
                    
                  </div>                                    <!-- end card-->					
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
    $('button').click(function() {
      $('aside').toggleClass('active')
           }) 
 
  })

   $(document).ready(function(){
    $('#tabledit').Tabledit({
      url:'crudForrooms.php',
    rowIdentifier: 'classrm_id',
    autoFocus: true,
    editButton: true,
    restoreButton: false,
    buttons: {
         edit: {
            class: 'btn btn-sm btn-warning',
            html: '<i class="fas fa-pencil-alt"></i>',
            action: 'edit'
        },
        delete: {
            class: 'btn btn-sm btn-danger',
            html: '<i class="far fa-trash-alt"></i>',
            action: 'delete'
        }
         
    },
      columns:{
        identifier: [0, "classrm_id"],
        editable: [[1, "class_name"], [2, "block_id"]]

      },
      
      onSuccess:function(data, textStatus, jqXHR){
        if (data.action=='delete') {
          $('#'+data.classrm_id).remove();
        }

      }
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