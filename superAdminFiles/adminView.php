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

	



	  <?php

        $superAdminId=$_SESSION['superAdmin_id'];

	  ?>


		
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">	
 				
			 					
		</div>
				 

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">	
			<div class="alert alert-success" style="margin-top: 4px;">
               
              <strong style="font-style: italic;font-size: 17px;"><a href="adminPage.php">Home</a>/admin/view</strong> : can see and edit or delete either admin or super admin of each College.
 
            </div>	
             
    <div style="overflow-x:auto;">
    <table class="table table-striped table-bordered" id="tabledit" style="margin-top: 10px;">
      <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Fname</th>
          <th>Lname</th>
          <th>email</th>
          <th>Uname</th>
          <th>role</th>
          <th>status</th>
          <th>collId</th>
        </tr>
      </thead>
      <tbody>
        <?php
         

           

           $sql3="SELECT * FROM admin WHERE admin_id<>'".$superAdminId."'";
           $result3=mysqli_query($conn,$sql3);
           while ($row3=mysqli_fetch_assoc($result3)) {
           	$statusvalue=$row3["status"];
           	$rolevalue=$row3["role"];
            echo '<tr>
                <td>'.$row3["admin_id"].'</td>
                <td>'.$row3["fname"].'</td>
                <td>'.$row3["lname"].'</td>
                <td>'.$row3["email"].'</td>
                <td>'.$row3["username"].'</td>';
                // <td>'.$row3["role"].'</td>';
                echo '<td><select>
                   <option value="'.$row3["role"].'">'.$row3["role"].'</option>';
                   if ($rolevalue=='admin') {
                   	echo '<option value="superAdmin">superAdmin</option>';
                   	# code...
                   }elseif ($rolevalue=='superAdmin') {
                   	echo '<option value="admin">admin</option>';
                   	# code...
                   }


             echo '</select></td>';
                 
               echo '<td><select>
                   <option value="'.$row3["status"].'">'.$row3["status"].'</option>';
                   if ($statusvalue=='Active') {
                   	echo '<option value="Passive">Passive</option>';
                   	# code...
                   }elseif ($statusvalue=='Passive') {
                   	echo '<option value="Active">Active</option>';
                   	# code...
                   }


             echo '</select></td>';
              

              echo '<td>'.$row3["coll_id"].'</td></tr>';

             # code...
             }

          
         
         

        
        
        ?>
         
      </tbody>
    </table>
  </div>
 
 				
			 





		</div>

		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">						
			 
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

	<script type="text/javascript"> 
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

<script >
	// $(document).ready(function(){
 //    $('#tabledit').Tabledit({
 //      url:'crudForadmin.php',
 //    rowIdentifier: 'admin_id',
 //    autoFocus: true,
 //    editButton: true,
 //    restoreButton: false,
 //    buttons: {
 //         edit: {
 //            class: 'btn btn-sm btn-warning',
 //            html: '<i class="fas fa-pencil-alt"></i>',
 //            action: 'edit'
 //        },
 //        delete: {
 //            class: 'btn btn-sm btn-danger',
 //            html: '<i class="far fa-trash-alt"></i>',
 //            action: 'delete'
 //        }
         
 //    },
 //      columns:{
 //        identifier: [0, "admin_id"],
 //        editable: [[1, "fname"], [2, "lname"], [3, "email"], [4, "username"], [5, "role"], [6, "status"], [7, "coll_id"]]

 //      },
      
 //      onSuccess:function(data, textStatus, jqXHR){
 //        if (data.action=='delete') {
 //          $('#'+data.admin_id).remove();
 //        }

 //      }
 //    })

 //   })
</script>
	

</body>
</html>