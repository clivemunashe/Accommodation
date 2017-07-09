<?php require_once('Connections/localhost.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "Login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_POST['UserID'])) && ($_POST['UserID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM users WHERE UserID=%s",
                       GetSQLValueString($_POST['UserID'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($deleteSQL, $localhost) or die(mysql_error());

  $deleteGoTo = "ManageUsers.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_ManageUser = "SELECT * FROM users WHERE UserLevel = 0 ORDER BY RegDate ASC";
$ManageUser = mysql_query($query_ManageUser, $localhost) or die(mysql_error());
$row_ManageUser = mysql_fetch_assoc($ManageUser);
$totalRows_ManageUser = mysql_num_rows($ManageUser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Account</title>
</head>

<body>

<div id="Holder">
<div id="Header"></div>
<div id="Navbar">
		<nav>
        
        <ul>
        
        <li><a href="Admin.php">Go Back</a></li>
        
        
        </ul>
        </nav>
        </div>
        
<div id="Content">
		<div id="PageHeading">
		  <h1>User Manager</h1>
		</div>
	<div id="ContentLeft">
	  <h2>&nbsp;</h2>
	  <h6><br/>
	    <br/>
      </h6>
	</div>
    <div id="ContentRight">
      <?php if ($totalRows_ManageUser > 0) { // Show if recordset not empty ?>
        <?php do { ?>
          <table width="600" border="0" align="center">
              <tr>
                <td><form id="ManageUsers" name="ManageUsers" method="post" action="">
                  <table width="400" border="0">
                    <tr>
                      <td>Username: <?php echo $row_ManageUser['FirstName']; ?></td>
                    </tr>
                    <tr>
                      <td><input type="submit" name="Delete" id="Delete" value="Delete User" />
                        <input name="UserID" type="hidden" id="UserID" value="<?php echo $row_ManageUser['UserID']; ?>" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form></td>
              </tr>
          </table>
          <?php } while ($row_ManageUser = mysql_fetch_assoc($ManageUser)); ?>
        <?php } // Show if recordset not empty ?>
    </div>

</div>
<div id="Footer"></div>
</div>


</body>
</html>
<?php
mysql_free_result($ManageUser);
?>
