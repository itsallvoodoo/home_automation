<?php
  include 'includes/db_connect.php';
  include 'includes/functions.php';
 
  sec_session_start();
?>

<!DOCTYPE html>
<html lang="en" ng-app="mainApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This website is my development platform for web technologies and home automation">
    <meta name="author" content="Chad Hobbs">
    <base href="/">

    <title>Hobbs Home Automation Server</title>

    <!-- Website functionality JS -->
    <script src="/js/angular.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="/js/Chart/Chart.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.10/angular-route.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Specific stylesheet for my template -->
    <link href="/css/mainsite.css" rel="stylesheet">
  </head>

  <body ng-controller="mainController">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Hobbs Home Automation Server</a>
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
            <li ng-class="{active:isActive('/home')}"><a href="#home">Home</a></li><!-- --> 
            <li ng-class="{active:isActive('/access')}"><a href="#access">Access Control</a></li><!-- --> 
            <li ng-class="{active:isActive('/security')}"><a href="#security">Security</a></li><!-- -->
            <li ng-class="{active:isActive('/hvac')}"><a href="#hvac">HVAC</a></li> <!-- --> 
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div id="main">

            <div ng-view></div>
          </div>

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
