<?php
include_once '../includes/register.inc.php';
include_once '../includes/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Secure Login: Registration Form</title>
<script type="text/JavaScript" src="/js/sha512.js"></script> 
<script type="text/JavaScript" src="/js/forms.js"></script>
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
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
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
        <p>Return to the <a href="index.php">login page</a>.</p>
        </div>
        <div id="content_bottom"></div>
            
        <div id="footer"><h3>Footer Stuff</h3></div>
    </div>
</div>
</body>
</html>