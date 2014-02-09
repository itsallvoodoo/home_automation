<?php
    require '../includes/db_secure_connect.php';
    require '../includes/functions.php';
     
    sec_session_start();

    if (login_check($mysqli) == true) {
        echo "logged in"; // -----------------------TESTING -----------------------
        $logged = 'in';
    } else {
        echo "logged out"; // -----------------------TESTING -----------------------
        $logged = 'out';
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/JavaScript" src="/js/sha512.js"></script> 
    <script type="text/JavaScript" src="/js/forms.js"></script>
<title>Hobbs Home Automation Server Login</title>
</head>

<body>
<div id="container">
    <div id="header">
        <h1>Hobbs Home Automation Server</span></h1>
        <h2></h2>
    </div>   
        
    <div id="menu">
        <ul>
            <li class="menuitem"><a href="/index.php">Home</a></li>
            <li class="menuitem"><a href="/access/access.php">Access Control</a></li>
            <li class="menuitem"><a href="/security/security.php">Security</a></li>
            <li class="menuitem"><a href="/hvac/hvac.php">HVAC</a></li>
        </ul>
    </div>
        
    <div id="leftmenu">

    <div id="leftmenu_top">
    </div>

        <div id="leftmenu_main">    
            
            <h3>Links</h3>
                    
            <ul>
                <?php if (login_check($mysqli) == true) : ?>
                    <li><a href="logout.php">Log out</a></li>
                <?php else : ?>
                    <li><a href="login.php">Log in</a></li>
                <?php endif; ?>    
                <li><a href="#">Side2</a></li>
                <li><a href="#">Side3</a></li>
                <li><a href="#"></a></li>

            </ul>
        </div>
            
        <div id="leftmenu_bottom">
        </div>
    </div>
          
    <div id="content">
            
        <div id="content_top"></div>
        <div id="content_main">
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">Error Logging In!</p>';
                }
            ?> 
            <form action="process_login.php" method="post" name="login_form">                      
                Email: <input type="text" name="email" />
                Password: <input type="password" 
                                 name="password" 
                                 id="password"/>
                <input type="button" 
                       value="Login" 
                       onclick="formhash(this.form, this.form.password);" /> 
            </form>
            <p>If you don't have a login, please <a href="/register.php">register</a></p>
            <p>If you are done, please <a href="/logout.php">log out</a>.</p>
            <p>You are currently logged <?php echo $logged ?>.</p>
        </div>
        <div id="content_bottom"></div>
            
        <div id="footer"><h3>Footer Stuff</h3></div>
    </div>
</div>
</body>
</html>