<?php
  include_once 'includes/db_connect.php';
  include_once 'includes/functions.php';
 
  sec_session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This website is my development platform for web technologies and home automation">
    <meta name="author" content="Chad Hobbs">

    <title>Hobbs Home Automation Server</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Specific stylesheet for my template -->
    <link href="/css/mainsite.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hobbs Home Automation Server</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php include 'user_menu.php'; ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <?php include 'context_menu.php'; ?>
          </ul>
          <ul class="nav nav-sidebar">
            <li></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Home</h1>

          <h2 class="sub-header">Welcome to Chad's Home Automation Server</h2>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>This website is being served from a Beaglebone Black and is the same device that controls various functions around the house.</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/docs.min.js"></script>
  </body>
</html>
