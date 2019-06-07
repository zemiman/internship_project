

<?php
 

session_start();
  if (!isset($_SESSION['ur_id'])) {
           
            header("Location:index.php");
            
          }


        ?>      
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Automated TimeTable</title>
  <link rel="shortcut icon" href="MU.png">
  <link rel="stylesheet" type="text/css" href="style.css"> 
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="font_awesome/css/all.min.css">
   
   

    

</head>
<body>   
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  <!-- <div class="title"><h2>Automated Time Table</h2></div> -->
  <a href=""><img src="MU.png" class="navbar-brand" style="height: 80px; padding: 6px 20px;"></a>
   <!-- <h1 style="text-align: center; font-style: italic;">AUTOMATED TIMETABLE GENERATOR</h1> -->
   


   <div class="logout">
  <form action="includes/logout.inc.php" method="POST" style="float: right;">
      <button type="submit" name="submit" class="btn btn-secondary" style="background: #f8f9fa; border: none; font-size: 16px; color: black; font-weight: bold; font-style: italic;">logout</button> </form>
    </div>
    
   
 
</nav>
 


<div class="container-fluid" style="background: #efffff;">
  
  <div class="row">
    <div class="col-sm-4 m-auto d-block" style="background-color: #efffff; min-height: 100vh; margin-top: 200px; padding-top: 160px;">
      <?php
   

      include_once'includes/dbConnection.inc.php';


      $sql="SELECT * FROM College";
      $result=mysqli_query($conn,$sql) or die(mysql_error()."[".$sql."]");

   ?>
    
  <form action="adminFiles/adminPage.php" method="POST" class="justify-content-center col-md-offset-4" style="margin-top: 60px">
    <div class="form-group">
      <label for="sel1" style="font-size: 18px; font-style: italic;">  College:  </label>
        
      <select name="college" class="form-control" id="sel1" style="font-style: italic; font-size: 14px;">
       <?php while ($row = mysqli_fetch_array($result)){
   ?>
   <option value=" <?php echo $row['coll_id'];  ?> " style="font-style: italic; font-size: 14px; padding-right: 0;">
     <?php echo $row['name']; ?>
      
    </option>
    <?php
}
?>        

      </select>
      
       
      
    <input type="submit" name="submit" class="btn btn-success" style="margin: 10px 0 10px 150px;"> 
  </div>
  </form>

  



     

 
 
 
     </div>
     
  </div>
    
</div>


<hr style="margin-top:0; padding-top: 30px;">
 <footer class="cn-ftr">
  <div class="container" style="position: absolute;">
  <div class="row">
    <div class="col-sm-6 mx-auto" style="padding-bottom: 20px;"><strong>Copyright &copy; 2018-2019.</strong> All rights
    reserved.</div>
    <div class="col-sm-6 mx-autom"><p></p></div>
      
    
    <!-- <div class="col-sm-3 mx-auto"><p style="float: right;">Powered By</p></div>
      </div> -->
    </div>
    
  </div>
   
 </footer>

 <script src="jquery-3.3.1.min.js"></script>
 <script src="bootstrap.min.js"></script>

 

  </body>
</html>