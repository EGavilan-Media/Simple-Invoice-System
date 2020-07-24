<?php

  //header.php
  
  session_start();

  if(!isset($_SESSION["user_email"]))
  {
    header('location: login.html');
  }
  

?>
<!DOCTYPE html>
<html>

<head>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Simple Invoice System</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles -->
  <link href="css/egm-invoice.css" rel="stylesheet"> 

  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
  <!-- favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.jpg">
  
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info fixed-top shadow p-3 mb-5">
    <div class="container">
      <a class="navbar-brand" href="index.php"><b>Invoice System</b></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
        data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-file-invoice-dollar"></span> Invoices
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
              <a class="dropdown-item" href="create_invoice.php">Create Invoice</a>
              <a class="dropdown-item" href="invoice.php">Manage Invoices</a>
            </div>
          </li>
          <?php if($_SESSION['user_role']=="Admin"): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-users"></span> Users
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="user.php">Manage Users</a>
            </div>
          </li>
          <?php endif; ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="fas fa-user"></span> <?php echo $_SESSION['user_full_name']; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
              <a class="dropdown-item" href="account.php"> Settings</a>
              <a class="dropdown-item" href="logout.php"> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>