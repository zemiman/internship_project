    
    <?php
 include_once'userHeader.php';
 include_once'../includes/dbConnection.inc.php';

     ?>

    <div class="row">
		<div class="col-xl-12">
		<div class="breadcrumb-holder">
				<h1 class="main-title float-left">Home</h1>
				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item">Automated Timetable</li>
					 
				</ol>
				<div class="clearfix"></div>
				</div>
		</div>
	</div>
	<!-- end row -->
 
						



						 


							
			<div class="row">
			
					 

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
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">						
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