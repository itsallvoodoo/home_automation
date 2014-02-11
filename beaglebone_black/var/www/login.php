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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    <title>Hobbs Home Automation Server</title>
</head>

<body>
<div id="container">
    <div id="header">
        <h1>Secure Login: Log In</span></h1>
        <h2></h2>
    </div>   
        
    <div id="menu">
            <?php include 'top_menu.php'; ?>
    </div>
        
    <div id="leftmenu">

        <div id="leftmenu_top"></div>
        <div id="leftmenu_main">    
            <?php include 'leftmenu_main.php'; ?>
        </div>
            
        <div id="leftmenu_bottom"></div>
    </div>
          
    <div id="content">
            
        <div id="content_top"></div>
        <div id="content_main">

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
        <div id="content_bottom"></div>
            
        <div id="footer"><h3>Footer Stuff</h3></div>
    </div>
</div>
</body>
</html>