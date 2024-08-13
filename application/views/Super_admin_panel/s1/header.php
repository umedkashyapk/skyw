<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?= $this->conn->company_info('company_name');?></title>

  <!--favicon-->
  <link rel="icon" href="<?= $this->conn->company_info('symbol');?>" type="image/x-icon">
  <!--material datepicker css-->
  <link rel="stylesheet" href="<?= $panel_url;?>assets/plugins/material-datepicker/css/bootstrap-material-datetimepicker.min.css">
  <link href="<?= $panel_url;?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
  <link href="<?= $panel_url;?>assets/css/style.bundle.css" rel="stylesheet" type="text/css">
   
   <link href="<?= $panel_url;?>assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" />

  <link href="<?= $panel_url;?>assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
   
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= $panel_url;?>assets/plugins/summernote/dist/summernote-bs4.css"/>
  <!-- simplebar CSS-->
  <link href="<?= $panel_url;?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?= $panel_url;?>assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?= $panel_url;?>assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?= $panel_url;?>assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="<?= $panel_url;?>assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?= $panel_url;?>assets/css/app-style.css" rel="stylesheet"/>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css'>
     <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
    .topright {
     // border: 1px solid black;
    }    
        
    .form-inline1 {
      display: flex;
      flex-flow: row wrap;
      align-items: center;
    }
    
    /* Add some margins for each label */
    .form-inline1 label {
      margin: 5px 5px 5px 0;
    }
    
    /* Style the input fields */
    .form-inline1 input,select {
      vertical-align: middle;
      margin: 5px 5px 5px 0;
      padding: 5px;
      background-color: #fff;
      border: 1px solid #ddd;
      
    }
    
    /* Style the submit button */
    .form-inline1 button {
      padding: 10px 20px;
      background-color: dodgerblue;
      border: 1px solid #ddd;
      color: white;
    }
    
    
    
    .form-inline1 button:hover {
      background-color: royalblue;
    }
    
    /* Add responsiveness - display the form controls vertically instead of horizontally on screens that are less than 800px wide */
    @media (max-width: 800px) {
      .form-inline1 input {
        margin: 5px 0;
        width:100% !important;
        
      }
    
      .form-inline1 {
        flex-direction: column;
        align-items: stretch;
      }
    }
    @media (min-width: 800px) {
      .form-inline1 input,select {
        max-width:150px;
      }
    }

 
        
    </style>
</head>

<body>

<!-- Start wrapper-->
 <div id="wrapper">
  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo bg-white">
      <a href="<?= base_url();?>index">
       <img src="<?= $this->conn->company_info('logo');?>" class="logo-icon" alt="<?= $this->conn->company_info('company_name');?>" style="width:60px;height:">
       <h5 class="logo-text text-muted"> Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <!--<li class="sidebar-header">MAIN NAVIGATION</li>-->
      <li><a href="<?= $super_admin_path.'dashboard';?>" class="waves-effect"><i class="zmdi zmdi-home"></i> <span>Dashboard</span></a></li>
      
      <li><a href="<?= $super_admin_path.'needs';?>" class="waves-effect"><i class="zmdi zmdi-email-open zmdi-hc-fw"></i> <span>Needs</span></a></li>
        <li><a href="<?= $super_admin_path.'needs/contact';?>" class="waves-effect"><i class="fa fa-phone" aria-hidden="true"></i> <span>Contact Detail</span></a></li>
      <li><a href="<?= $super_admin_path.'settings';?>" class="waves-effect"><i class="zmdi zmdi-settings zmdi-hc-fw"></i> <span>Settings</span></a></li>


      
           
           <li><a href="<?= $super_admin_path.'logout';?>" class="waves-effect"><i class="zmdi zmdi-power "></i> <span>Logout</span></a></li>

         
      
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->
 <header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top bg-white">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
     
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
      
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        admin
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="<?= $admin_path.'logout';?>" class="waves-effect"><i class="zmdi zmdi-power mr-2"></i> <span>Logout</span></a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">