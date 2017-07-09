<?php require_once('Connections/localhost.php'); ?>
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

if ((isset($_POST['BookID'])) && ($_POST['BookID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM bookings WHERE BookID=%s",
                       GetSQLValueString($_POST['BookID'], "int"));

  mysql_select_db($database_localhost, $localhost);
  $Result1 = mysql_query($deleteSQL, $localhost) or die(mysql_error());

  $deleteGoTo = "ViewBookings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_localhost, $localhost);
$query_ViewBookings = "SELECT * FROM bookings ORDER BY `Date` ASC";
$ViewBookings = mysql_query($query_ViewBookings, $localhost) or die(mysql_error());
$row_ViewBookings = mysql_fetch_assoc($ViewBookings);
$totalRows_ViewBookings = mysql_num_rows($ViewBookings);
$query_ViewBookings = "SELECT * FROM bookings ORDER BY `Date` ASC";
$ViewBookings = mysql_query($query_ViewBookings, $localhost) or die(mysql_error());
$row_ViewBookings = mysql_fetch_assoc($ViewBookings);
$totalRows_ViewBookings = mysql_num_rows($ViewBookings);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css" />
<link href="CSS/Menu.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bookings Made</title>
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
		  <h1>Bookings</h1>
		  
		  <p>&nbsp;</p>
          <?php if ($totalRows_ViewBookings > 0) { // Show if recordset not empty ?>
            <?php do { ?>
          <table width="1250" border="0">
            <tr>
              <td><form id="BookingFormView" name="BookingFormView" method="post" action="">
                  <table width="1200" align="left" cellpadding="5">
                    <tr>
                      <td><strong>Name</strong></td>
                      <td><strong>Surname</strong></td>
                      <td><strong>Sex</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Cell Number</strong></td>
                      <td><strong>Address</strong></td>
                      <td><strong>Campus</strong></td>
                      <td><strong>Date</strong></td>
                      <td><strong>Expected Move In Date</strong></td>
                      <td><strong>Expected Move Out Date</strong></td>
                    </tr>
                    <tr>
                      <td><?php echo $row_ViewBookings['Name']; ?></td>
                      <td><?php echo $row_ViewBookings['Surname']; ?></td>
                      <td><?php echo $row_ViewBookings['Sex']; ?></td>
                      <td><?php echo $row_ViewBookings['Email']; ?></td>
                      <td><?php echo $row_ViewBookings['CellN']; ?></td>
                      <td><?php echo $row_ViewBookings['Address']; ?></td>
                      <td><?php echo $row_ViewBookings['Campus']; ?></td>
                      <td><?php echo $row_ViewBookings['Date']; ?></td>
                      <td><?php echo $row_ViewBookings['MoveInDate']; ?></td>
                      <td><?php echo $row_ViewBookings['MoveOutDate']; ?></td>
                    </tr>
                    <tr>
                      <td><input type="submit" name="DeleteBookingButton" id="DeleteBookingButton" value="Delete" />
                      <input name="BookID" type="hidden" id="BookID" value="<?php echo $row_ViewBookings['BookID']; ?>" /></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
              </form></td>
            </tr>
          </table>
          <?php } while ($row_ViewBookings = mysql_fetch_assoc($ViewBookings)); ?>
            <?php } // Show if recordset not empty ?>
<p>&nbsp;</p>
		</div>
	

</div>
<div id="Footer"></div>
</div>


</body>
</html>
<?php
mysql_free_result($ViewBookings);
?>
