<?php
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
     
    sec_session_start();

    if (login_check($mysqli) == true) {
        $logged = 'in';
    } else {
        $logged = 'out';
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This website is my development platform for web technologies and home automation">
    <meta name="author" content="Chad Hobbs">
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>

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
          <h1 class="page-header">Login</h1>

          <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">Error Logging In!</p>';
                }
            ?> 
            <form action="includes/process_login.php" method="post" name="login_form">                      
                Email: <input type="text" name="email" />
                Password: <input type="password" 
                             name="password" 
                             id="password"/>
                <input type="button" 
                    value="Login" 
                    onclick="formhash(this.form, this.form.password);" /> 
            </form>
        <p>If you don't have a login, please <a href="/register.php">register</a>.</p>
        <p>If you are done, please <a href="includes/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>

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
