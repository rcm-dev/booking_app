<?php require_once('Connections/bookingAppCon.php'); ?>  <?php
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
  $insertSQL = sprintf("INSERT INTO guest_info (firstName, lastName, Email, phone_no) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['firstName'], "text"),
                       GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['phone_no'], "int"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($insertSQL, $bookingAppCon) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE guest_info SET guest_id=%s, firstName=%s, lastName=%s, phone_no=%s WHERE Email=%s",
                       GetSQLValueString($_POST['guest_id'], "int"),
                       GetSQLValueString($_POST['firstName'], "text"),
                       GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['phone_no'], "int"),
                       GetSQLValueString($_POST['Email'], "text"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($updateSQL, $bookingAppCon) or die(mysql_error());

  $updateGoTo = "guest-dashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_update = "SELECT firstName, lastName, Email, phone_no FROM guest_info";
$update = mysql_query($query_update, $bookingAppCon) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = "-1";
if (isset($_GET['Email'])) {
  $totalRows_update = $_GET['Email'];
}
$colname_update = "-1";
$colname_update = "-1";
if (isset($_GET['Email'])) {
  $colname_update = $_GET['Email'];
}
mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_update = sprintf("SELECT * FROM guest_info WHERE Email = %s", GetSQLValueString($colname_update, "text"));
$update = mysql_query($query_update, $bookingAppCon) or die(mysql_error());
$row_update = mysql_fetch_assoc($update);
$totalRows_update = mysql_num_rows($update);


/**
 * Include header template
 */
include ('header.tpl.php'); 

?>

<section class="center">
  <section id="content"> 
  
  </p>
<h1>UPDATE PROFILE</h1>

<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Guest_id:</td>
      <td><input type="text" name="guest_id" value="<?php echo htmlentities($row_update['guest_id'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">FirstName:</td>
      <td><input type="text" name="firstName" value="<?php echo htmlentities($row_update['firstName'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">LastName:</td>
      <td><input type="text" name="lastName" value="<?php echo htmlentities($row_update['lastName'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><?php echo $row_update['Email']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone_no:</td>
      <td><input type="text" name="phone_no" value="<?php echo htmlentities($row_update['phone_no'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="Email" value="<?php echo $row_update['Email']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
    </section>
  <!-- #content -->
</section>
<?php 


mysql_free_result($update);
?>
  