<?php
// *** Logout the current user.
$logoutGoTo = "index.php";
if (!isset($_SESSION)) {
  session_start();
}
$_SESSION['MM_Username'] = NULL;
$_SESSION['MM_UserGroup'] = NULL;
unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);
if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logout</title>
</head>

<body>

<div id="Holder">
<div id="Header"></div>
<div id="Navbar">
		<nav>
        
        <ul>
        
        <li><a href="Login.php">Login</a></li>
        <li><a href="UserRegistration.php">Register</a></li>
        <li><a href="ForgotPassword.php">Forgot Password</a></li>
        
        </ul>
        </nav>
        </div>
        
<div id="Content">
		<div id="PageHeading">
		  <h1>Logout</h1>
		</div>
	<div id="ContentLeft">
	  <h2>Your Message Here</h2>
	  <h6><br/>
	    Your Message<br/>
      </h6>
	</div>
    <div id="ContentRight"></div>

</div>
<div id="Footer"></div>
</div>


</body>
</html>
