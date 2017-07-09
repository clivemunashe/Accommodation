<?php require_once('Connections/localhost.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (FirstName, LastName, Sex, Email, PhoneNumber, Username, Password) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['FirstName'], "text"),
                       GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['PhoneNumber'], "text"),
                       GetSQLValueString($_POST['UserName'], "text"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());

  $insertGoTo = "SuccessReg.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_RegisterUsers = "SELECT * FROM users";
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
<title>Student Registration</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>

<div id="Holder">
<div id="Header"></div>
<div id="Navbar">
		<nav>
        
        <ul>
        
        <li><a href="index.php">Home</a></li>
        <li><a href="Login.php">Login</a></li>
        <li><a href="UserRegistration.php">Register</a></li>
        <li></li>
        
        </ul>
        </nav>
  </div>
        
<div id="Content">
		<div id="PageHeading">
		  <h1>Student Registration</h1>
		</div>
	<div id="ContentLeft">
	  <h6>&nbsp;</h6>
	  <h2>share on</h2>
	  <h6>Facebook | Twitter | Google+ | Whatsapp<br/>
      </h6>
	</div>
    <div id="ContentRight">
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="250" border="0" align="center">
          <tr>
            <td><h6>First Name: </h6>
              <span id="sprytextfield1">
              <label for="FirstName"></label>
              <input name="FirstName" type="text" class="StyleTxtField" id="FirstName" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Last Name:  </h6>
              <span id="sprytextfield2">
              <label for="LastName"></label>
              <input name="LastName" type="text" class="StyleTxtField" id="LastName" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Sex: </h6>
              <span id="sprytextfield3">
              <label for="Sex"></label>
              <input name="Sex" type="text" class="StyleTxtField" id="Sex" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Email: </h6>
              <span id="sprytextfield4">
              <label for="Email"></label>
              <input name="Email" type="text" class="StyleTxtField" id="Email" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Phone Number: </h6>
              <span id="sprytextfield5">
              <label for="PhoneNumber"></label>
              <input name="PhoneNumber" type="text" class="StyleTxtField" id="PhoneNumber" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Username: </h6>
              <span id="sprytextfield6">
              <label for="UserName"></label>
              <input name="UserName" type="text" class="StyleTxtField" id="UserName" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Password: </h6>
              <span id="sprytextfield7">
              <label for="Password"></label>
              <input name="Password" type="password" class="StyleTxtField" id="Password" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><input type="submit" name="SubmitUserForm" id="SubmitUserForm" value="Register" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
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
