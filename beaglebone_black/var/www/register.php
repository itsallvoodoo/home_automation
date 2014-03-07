<?php
    include_once 'includes/register.inc.php';
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
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>

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
          <h1 class="page-header">Registration</h1>

          <h1>Register with us</h1>
            <?php
            if (!empty($error_msg)) {
                echo $error_msg;
            }
            ?>
            <ul>
                <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
                <li>Emails must have a valid email format</li>
                <li>Passwords must be at least 6 characters long</li>
                <li>Passwords must contain
                    <ul>
                        <li>At least one upper case letter (A..Z)</li>
                        <li>At least one lower case letter (a..z)</li>
                        <li>At least one number (0..9)</li>
                    </ul>
                </li>
                <li>Your password and confirmation must match exactly</li>
            </ul>
            <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                    method="post" 
                    name="registration_form">
                Username: <input type='text' 
                    name='username' 
                    id='username' /><br>
                Email: <input type="text" name="email" id="email" /><br>
                Password: <input type="password"
                                 name="password" 
                                 id="password"/><br>
                Confirm password: <input type="password" 
                                         name="confirmpwd" 
                                         id="confirmpwd" /><br>
                <input type="button" 
                       value="Register" 
                       onclick="return regformhash(this.form,
                                       this.form.username,
                                       this.form.email,
                                       this.form.password,
                                       this.form.confirmpwd);" /> 
            </form>
            <p>Return <a href="index.php">home</a>.</p>

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
