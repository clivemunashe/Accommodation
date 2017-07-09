<?php @session_start (); ?>

<?php require_once('Connections/localhost.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "0,1";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE users SET FirstName=%s, LastName=%s, Sex=%s, Email=%s, PhoneNumber=%s, Username=%s, Password=%s WHERE UserID=%s",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['PhoneNumber'], "text"),
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['UserID'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($updateSQL, $localhost) or die(mysql_error());

  $updateGoTo = "Update.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RegisterUsers = "-1";
if (isset($_GET['Username'])) {
  $colname_RegisterUsers = $_GET['Username'];
}
mysql_select_db($database_localhost, $localhost);
$query_RegisterUsers = sprintf("SELECT * FROM users WHERE Username = %s", GetSQLValueString($colname_RegisterUsers, "text"));
$RegisterUsers = mysql_query($query_RegisterUsers, $localhost) or die(mysql_error());
$row_RegisterUsers = mysql_fetch_assoc($RegisterUsers);
$totalRows_RegisterUsers = mysql_num_rows($RegisterUsers);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Student Registration</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>

<div id="Holder">
<div id="Header"></div>
<div id="Navbar">
		<nav>
        
        <ul>
        
        <li><a href="ControlPanel.php">Go Back</a></li>
        
        
        </ul>
        </nav>
  </div>
        
<div id="Content">
		<div id="PageHeading">
		  <h1>Update Student Details</h1>
		</div>
	<div id="ContentLeft">
	  <h2>Hi, <?php echo $row_RegisterUsers['FirstName']; ?> <?php echo $row_RegisterUsers['LastName']; ?></h2>
	  <h6><br/>
	    <br/>
      </h6>
	</div>
    <div id="ContentRight">
      <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
        <table width="600" border="0">
          <tr>
            <td><h6>First Name: </h6>
              <span id="sprytextfield1">
              <label for="FirstName"></label>
              <input name="FirstName" type="text" class="StyleTxtField" id="FirstName" value="<?php echo $row_RegisterUsers['FirstName']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Last Name:  </h6>
              <span id="sprytextfield2">
              <label for="LastName"></label>
              <input name="LastName" type="text" class="StyleTxtField" id="LastName" value="<?php echo $row_RegisterUsers['LastName']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Sex: </h6>
              <span id="sprytextfield3">
              <label for="Sex"></label>
              <input name="Sex" type="text" class="StyleTxtField" id="Sex" value="<?php echo $row_RegisterUsers['Sex']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Email: </h6>
              <span id="sprytextfield4">
              <label for="Email"></label>
              <input name="Email" type="text" class="StyleTxtField" id="Email" value="<?php echo $row_RegisterUsers['Email']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Phone Number: </h6>
              <span id="sprytextfield5">
              <label for="PhoneNumber"></label>
              <input name="PhoneNumber" type="text" class="StyleTxtField" id="PhoneNumber" value="<?php echo $row_RegisterUsers['PhoneNumber']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Username: </h6>
              <span id="sprytextfield6">
              <label for="UserName"></label>
              <input name="UserName" type="text" class="StyleTxtField" id="UserName" value="<?php echo $row_RegisterUsers['Username']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Password: </h6>
              <span id="sprytextfield7">
              <label for="Password"></label>
              <input name="Password" type="password" class="StyleTxtField" id="Password" value="<?php echo $row_RegisterUsers['Password']; ?>" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td><input name="UserID" type="hidden" id="UserID" value="<?php echo $row_RegisterUsers['UserID']; ?>" /></td>
          </tr>
          <tr>
            <td><input type="submit" name="SubmitUserForm" id="SubmitUserForm" value="Update" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
    </div>

</div>
<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
</script>
</body>
</html>
<?php
mysql_free_result($RegisterUsers);
?>
