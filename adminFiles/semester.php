<?php
// session_start();
 
 // include_once'includes/dbConnection.inc.php';
 $collegeId=$_SESSION['coll_id'];
  
 $currentDate=date("Y-m-d");
 

$semester='empty';
 
$sql="SELECT * FROM semesterinterval WHERE coll_id='$collegeId' AND startDate<='$currentDate' AND endDate>='$currentDate'";
$result=mysqli_query($conn, $sql);
$rowcount=mysqli_num_rows($result);
if ($rowcount>0) {
	# code...
 
while ($row=mysqli_fetch_array($result)) {
	$startDate1=$row['startDate'];
	$endDate1=$row['endDate'];
	 
	
}


$startDate1string1 = strtotime("+1 months", strtotime($startDate1));
$datewithformat1 = date("Y-m-d", $startDate1string1);
$StartDate1=date_create($datewithformat1);

$StartDate1=date_format($StartDate1, "d F Y");
$month1 = date('F', strtotime($StartDate1));

 

if ($month1=='November'||$month1=='October') {

	if ($startDate1<=$currentDate&&$endDate1>=$currentDate) {
		$semester='Semester_1';

		# code...
	}
	# code...

}

elseif ($month1=='March'||$month1=='April') {

	if ($startDate1<=$currentDate&&$endDate1>=$currentDate) {
		$semester='Semester_2';

		# code ...
	}
	# code...

}


 

}//end of if condition for rowcount value:
else{
   echo "<h4>semester has not been set yet!</h4>";
 // echo '<SCRIPT type="text/javascript"> swal("Error!", "It has been already set before!", "error");</SCRIPT>';
}


 
 
 

 
 

?>