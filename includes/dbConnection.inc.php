<?php
$serverName="localhost";
$userName="root";
$psw="";
$db="scheduler";
$conn = mysqli_connect ($serverName,$userName,$psw,$db) OR die ('Could not connect to MySQL: ' . mysqli_connect_error () );

// mysqli_set_charset($conn, 'utf8');

