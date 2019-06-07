
<?php
session_start();
// if (!isset($_SESSION['ur_id'])) {
//             # code...
//         echo "<script>
//     history.pushState(null, null, null);
//     window.addEventListener('popstate', function () {
//         history.pushState(null, null, null);
//     });
// </script>";
      
//           }


    // if (isset($_SESSION['ur_id'])) {
    //   // header("Location:/");
    //   exit();
    //   # code...
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mekelle University</title>
  <link rel="shortcut icon" href="MU.png">
	 
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="font_awesome/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="styleindex.css"> 


</head>
<body>
 
 <nav class="navbar navbar-light bg-light">

  <!-- <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-2">
               
      <a href=""><img src="MU_clock_logo.png" class="navbar-brand" style="height: 120px; padding: 4px 18px; "></a>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10">
      <h1 style="text-align: right; font-style: italic;">AUTOMATED TIMETABLE GENERATOR</h1>
               

      </div>

  </div> -->

  <a href="index.html"><img src="MU_clock_logo.png" class="navbar-brand" style="height: 120px; padding: 4px 18px; "></a> 
  <h2 style="text-align: center; font-style: italic;">AUTOMATED TIMETABLE GENERATOR</h2> 
    
 	
 </nav>
  <div class="container">
    <!-- ALERT FOR ERROR -->
 <?php
    if (isset($_SESSION['error']))
{
 
echo ' <div class="alert alert-danger alert-dismissible" style="margin-top: 4px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>OOPs!</strong>'.$_SESSION['error'].'
 
            </div>';
unset($_SESSION['error']);
}
    ?>
   
      <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-3 m-auto d-block">
        <img src="login.png" class="mx-auto d-block" style="margin-top: 65px;">
      	
      </div>
     <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-5 m-auto d-block">

     
        
      
      	 <form action="includes/login.inc.php" method="POST" class="bg-light" style="margin-top: 86px; padding: 14px 16px 30px 14px" onsubmit="return form_Validation()">
      		<div class="form-group col-sm-11">

      			 
  
                 <div class="iconsfont1">
            <i class="fas fa-user-graduate fa-lg fa-fw"></i>

      			<input type="text" name="user" id="username" class="form-control" required="" placeholder="user name" autocomplete="off">  
      			<span id="user-name" class="text-danger font-weight-bold"></span>
             </div>
            
      		</div>
      		<div class="form-group col-sm-11">
      	
                <div class="iconsfont2">
            <i class="fas fa-lock fa-lg fa-fw"></i>
      			<input type="Password" name="psw" id="Password" class="form-control" required="" placeholder="Password" autocomplete="off">
      			<span id="psws" class="text-danger font-weight-bold"></span>
            </div>

      		</div>

      		 <div class="checkbox col-sm-11">
              <label><input type="checkbox"> Remember me</label>
              <input type="submit" name="submit" value="login" class="btn btn-success" style="float: right;">
            </div>
             
      		  <a href="#" style="margin-left: 32px; ">Forget Password?</a>
      	 </form>
      	   
      </div>
    <div class="col-xs-12 col-sm-12 col-md-12  col-lg-12 col-xl-4 m-auto d-block">
        

          <!-- <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#Announce" role="tab">Announcement</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#schedule" role="tab">Schedule</a>
        </li>
         
      </ul> -->

      <!-- Tab panes -->
      <!-- <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" style="border-left: 1px solid #ddd; padding: 25px 15px;">Home page</div>
        <div class="tab-pane" id="schedule" role="tabpanel" style="border-left: 1px solid #ddd; padding: 25px 15px;">
           <a href="schedule_user_view.php" style="text-decoration: underline; padding-top: 20px;">All Available Schedules:</a>
           <p style="padding: 0;">Click on this link if you want to see any department's class and lab schedule from what college you are going to select!</p>

        </div>
        
      </div> -->
      	
      </div>

  	
  </div>
 </div>
</section>



 
 <hr style="margin-top: 120px;">
  <footer class="footer">
    <span class="text-right" style="margin-left: 10px;">
    <strong>Copyright &copy; 2018-2019.</strong> <a target="_blank" href="index.html">Our Website</a>
    </span>
    <span class="float-right" style="margin-right: 10px;">
    dev. by <a  href=""><b>MITian</b></a>
    </span>
  </footer>
    
    </div>
    
  </div>
   
 </footer>






<script src="jquery-3.2.1.slim.min.js"></script>
 <script src="bootstrap.min.js"></script>

<script type="text/javascript">
  <script type="text/javascript">
  $(".nav-link.active").click(function(){
    $(this).find('.tab-pane').removeClass('active');
})
	function form_Validation() {
		var user=document.getElementById('username').value;
		var psw=document.getElementById('Password').value;
		if (user=="") {
			document.getElementById('user-name').innerHTML="*please fill the username field!";

			return false;
		}
		if (psw=="") {
			document.getElementById('psws').innerHTML="*please fill the Password field!";

			return false;
		}


		
	}
</script>
</body>
</html>