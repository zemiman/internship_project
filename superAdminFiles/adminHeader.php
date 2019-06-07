<?php

 
session_start();
  if (!isset($_SESSION['superAdmin_id'])) {
            # code...
            header("Location:../index.php");
            exit();
          }


        ?>


<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Mekelle University</title>
		
		<link rel="shortcut icon" href="MU.png">
		<!-- Bootstrap CSS -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- <link rel="stylesheet" type="text/css" href="bootstrap.min.css"> -->
		
		<!-- Font Awesome CSS -->
		<link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="font_awesome/css/all.min.css">
		
		<!-- Custom CSS -->
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<!-- <link href="styleMainOne.css" rel="stylesheet" type="text/css" /> -->
		
		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<!-- END CSS for this page -->
		  <!-- sweat popup alert -->
		  <script src="sweetalert.min.js"></script>
		<!-- END CSS for this page -->
		
</head>

<body class="adminbody" id="top">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

        <!-- LOGO -->
        <div class="headerbar-left">
			<!-- <a href="adminPage.php" class="logo"><img alt="Logo" src="assets/images/logo.png" /> <span>Home</span></a> -->
			<a href="adminPage.php" class="logo"><i class="fas fa-home"></i><span>Home</span></a>
			
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
						
					 

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <!-- <img src="assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded"> -->
                                <i class="fa fa-cogs"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                 
                                <a href="#" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Profile</span>
                                </a>

                                 
                                <a href="" class="dropdown-item notify-item">
                                  <form action="../includes/logout.inc.php" method="POST"><i class="fa fa-power-off"></i>
                   <button type="submit" name="submit" class="btn btn-default" style="background: #fff; border: none; font-size: 16px; color: black;  font-style: italic; margin: 0; padding: 0;">Logout</button> </form>
                                </a>
								
								 
                            </div>

                        </li>


                    </ul>


                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>
        </nav>
	</div>

	
 
	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">
        
			<ul> 
                <!-- fa fa-user-secre -->

					<!-- <li class="submenu">
						<a class="active" href=""><i class="fa fa-fw fa-user fa-lg" style="font-size: 40px;"></i> <span style="font-size: 20px;font-style: italic;font-weight: bold;">Admin </span></a>
                    </li>

 -->
                      <li class="submenu">
						<a class="active" href=""><i class="fa fa-fw fa-user-tie fa-lg" style="font-size: 40px;"></i> <span style="font-size: 20px;font-style: italic;font-weight: bold;">Admin </span></a>
                    </li>

                     <li class="submenu">
                        <a href="#" style="padding-bottom: 6px;"><i class="fa fa-fw fa-user fa-lg"></i> <span> Admin</span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="addAdmin.php" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Add</span></a></li>
								<li><a href="adminView.php" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>View</span></a></li>
							</ul>
                    </li>

                    <li class="submenu">
                        <a href="#" style="padding-bottom: 6px;"><i class="fas fa-graduation-cap fa-lg"></i> <span>Manage</span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Add</span></a></li>
								<li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>View</span></a></li>
							</ul>
                    </li>

                    <li class="submenu">
                        <a href="#" style="padding-bottom: 6px;"><i class="fas fa-graduation-cap fa-lg"></i> <span> Information</span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Add</span></a></li>
								<li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>View</span></a></li>
							</ul>
                    </li>
					 
					
					<li class="submenu">
                        <a href="#" style="padding-bottom: 6px;"><i class="fa fa-fw fa-table"></i> <span> Timetable </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Timetable</span></a></li>
								<li><a href="schedule_admin_view.php" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>View</span></a></li>
							</ul>
                    </li>				

					<!-- <li class="submenu">
                        <a href="#"><i class="fa fa-fw fa-indent"></i><span> Menu Levels </span><span class="menu-arrow"></a>
                            <ul>
								<li>
                                    <a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Second Level</span></a>
                                </li>
                                <li class="submenu">
                                    <a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Third Level</span> <span class="menu-arrow"></span> </a>
                                        <ul style="">
                                            <li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Third Level Item</span></a></li>
                                            <li><a href="#" style="padding-bottom: 2px;"><i class="far fa-circle" style="font-size: 13px;"></i><span>Third Level Item</span></a></li>
                                        </ul>
                                </li>                                
                            </ul>
                    </li> -->

					 
					
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->



    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">