          <?php
     include_once'../header.php';
     include_once'.../includes/dbConnection.inc.php';

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
							
									 

					  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">						
										<!-- <div class="card mb-3">
											<div class="card-header">
												<h3><i class="fa fa-bar-chart-o"></i> Colour Analytics</h3>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.
											</div>
												
											<div class="card-body">
												<canvas id="pieChart"></canvas>
											</div>
											<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
										</div> -->
                                        <!-- end card-->	
          <?php
             

                // include_once'includes/dbConnection.inc.php';

                  $college_id=$_SESSION['coll_id'];
                   $sql2="SELECT * FROM college WHERE coll_id='".$college_id."'";
                  $result2=mysqli_query($conn,$sql2);
                  while ($row2=mysqli_fetch_assoc($result2)) {
                    $collegeName=$row2['name'];

                    # code...
                  }
                $sql="SELECT * FROM location WHERE coll_id='$college_id' ORDER BY loc_id DESC";
                $result=mysqli_query($conn,$sql);
               
             ?>
                 
           
           <h4 style="text-align: center; font-style: italic; font-weight: bold; margin-top: 10px; color: #6666ff;">List of Locations of <?php echo $collegeName;?></h4>
              <table class="table table-striped table-bordered" id="tabledit" style="margin-top: 20px;">
                <thead class="thead-light">
                  <tr>
                    <th>locId</th>
                    <th>locationName</th>
                    <th>collegeId</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row=mysqli_fetch_assoc($result)) {
                    echo '<tr>
                          <td>'.$row["loc_id"].'</td>
                          <td>'.$row["location_name"].'</td>
                           <td>'.$row["coll_id"].'</td>

                       </tr>';
                    # code...
                  }
                  ?>
                   
                </tbody>
              </table>
       

  
 

				</div>
									
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">						
										<!-- <div class="card mb-3">
											<div class="card-header">
												<h3><i class="fa fa-bar-chart-o"></i> Colour Analytics 2</h3>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non luctus metus. Vivamus fermentum ultricies orci sit amet sollicitudin.
											</div>
												
											<div class="card-body">
												<canvas id="doughnutChart"></canvas>
											</div>
											<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
										</div> -->
                                      <!-- end card-->					
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
		Copyright <a target="_blank" href="#">Your Website</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

	<!-- Counter-Up-->
	<script src="../assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../assets/plugins/counterup/jquery.counterup.min.js"></script>

  
 



 
  

<!-- <script src="jquery3.min.js"></script> -->
<!-- <script src="//code.jquery.com/jquery.min.js"></script> -->

<!--  <script src="bootstrap.min.js"></script> -->
 <script src="../jquery.tabledit.js"></script>


	 



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

   $(document).ready(function(){
    $('#tabledit').Tabledit({
      url:'crudFunction.php',
    rowIdentifier: 'loc_id',
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
        identifier: [0, "loc_id"],
        editable: [[1, "location_name"], [2, "coll_id"]]

      },
      
      onSuccess:function(data, textStatus, jqXHR){
        if (data.action=='delete') {
          $('#'+data.loc_id).remove();
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


  //   $(document).ready(function(){
     
  //     var i=1;
  //     $('#add').click(function(){

  //        i++;
  //        $('#dynamic_field').append(' <tr id="row'+i+'"><td><input type="text" name="name[]" required="" id="name" class="form-control name_list" autocomplete="off" placeholder="Enter Location Name" style="padding: 14px;"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

  //     }) 
  //     $(document).on('click','.btn_remove',function(){
  //       var button_id=$(this).attr("id");
  //       $("#row"+button_id+"").remove();
  //     })
       


  // })

 
</script>
	 
	

</body>
</html>