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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "SBookID")) {
  $insertSQL = sprintf("INSERT INTO bookings (Name, Surname, Sex, Email, CellN, Address, Campus, MoveInDate, MoveOutDate) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Surname'], "text"),
                       GetSQLValueString($_POST['Sex'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Cellnumber'], "text"),
                       GetSQLValueString($_POST['Address'], "text"),
                       GetSQLValueString($_POST['Campus'], "text"),
                       GetSQLValueString($_POST['ExpectedDateIn'], "text"),
                       GetSQLValueString($_POST['ExpectedDateOut'], "text"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($insertSQL, $localhost) or die(mysql_error());

  $insertGoTo = "Success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_BookUser = "SELECT * FROM bookings";
$BookUser = mysql_query($query_BookUser, $localhost) or die(mysql_error());
$row_BookUser = mysql_fetch_assoc($BookUser);
$totalRows_BookUser = mysql_num_rows($BookUser);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Index</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>

<div id="Holder">
<div id="Header"></div>
<div id="Navbar">
		<nav>
        
        <ul>
        
        <li><a href="index.php">Home Page</a></li>
        <li><a href="ControlPanel.php">Go Back</a></li>
        
        
        </ul>
        </nav>
  </div>
        
<div id="Content">
		<div id="PageHeading">
		  <h1>Student Bookings</h1>
		</div>
	<div id="ContentLeft">
	  <h2>&nbsp;</h2>
	  <h6><br/>
	    <br/>
      </h6>
	</div>
    <div id="ContentRight">
      <form id="SBookID" name="SBookID" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="400" border="0" align="center">
          <tr>
            <td>Name:              <span id="sprytextfield1">
              <label for="Name"></label>
              <input name="Name" type="text" class="StyleTxtField" id="Name" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>Surname:              <span id="sprytextfield2">
              <label for="Surname"></label>
              <input name="Surname" type="text" class="StyleTxtField" id="Surname" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>Sex:              <span id="sprytextfield3">
            <label for="Sex"></label>
            <input name="Sex" type="text" class="StyleTxtField" id="Sex" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>Email:<span id="sprytextfield8">
            <label for="Email"></label>
            <input name="Email" type="text" class="StyleTxtField" id="Email" />
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>
          <tr>
            <td>Cell Number:
              <span id="sprytextfield9">
              <label for="Cellnumber"></label>
              <input name="Cellnumber" type="text" class="StyleTxtField" id="Cellnumber" />
            <span class="textfieldRequiredMsg">A value is required.</span></span>              <h6>&nbsp;</h6></td>
          </tr>
          <tr>
            <td>Address:              <span id="sprytextfield4">
              <label for="Address"></label>
              <input name="Address" type="text" class="StyleTxtField" id="Address" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Campus: </h6>
              <span id="sprytextfield5">
              <label for="Campus"></label>
              <input name="Campus" type="text" class="StyleTxtField" id="Campus" />
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Expected Date To Move In (mm/dd/yyyy): </h6>
              <span id="sprytextfield6">
              <label for="ExpectedDateIn"></label>
              <input name="ExpectedDateIn" type="text" class="StyleTxtField" id="ExpectedDateIn" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><h6>Expected Date To Move Out: </h6>
              <span id="sprytextfield7">
              <label for="ExpectedDateOut"></label>
              <input name="ExpectedDateOut" type="text" class="StyleTxtField" id="ExpectedDateOut" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
          </tr>
          <tr>
            <td><input type="submit" name="BookButton" id="BookButton" value="Book" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="SBookID" />
      </form>
    </div>

</div>
<div id="Footer"></div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "date", {format:"mm/dd/yyyy"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "date", {format:"mm/dd/yyyy"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "email");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
</script>
</body>
</html>
<?php
mysql_free_result($BookUser);
?>
