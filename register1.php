<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css">
<p>&nbsp;</p>
<?php require_once('Connections/bookingAppCon.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO guest_info (Email, password, confirm_password) VALUES (%s, md5(%s), md5(%s))",
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['confirm_password'], "text"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($insertSQL, $bookingAppCon) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_register = "SELECT Email, password, confirm_password FROM guest_info";
$register = mysql_query($query_register, $bookingAppCon) or die(mysql_error());
$row_register = mysql_fetch_assoc($register);
$totalRows_register = mysql_num_rows($register);
 

/**
 * Set variable Page view on the top
 * and the page auto set page
 */
$page_view = "Register to Booking System";

?>
<?php

/**
 * Include header template
 */
include ('header.tpl.php'); 

?>
<section class="center">
  <section id="content"> 
  
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><span id="sprytextfield1">
        <label>
          <input type="text" name="Email" id="Email">
        </label>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><span id="sprypassword1">
        <label>
          <input type="password" name="password" id="password">
        </label>
        <span class="passwordRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Confirm_password:</td>
      <td><span id="spryconfirm1">
        <label>
          <input type="password" name="confirm_password" id="confirm_password">
        </label>
        <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Register"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
  </section>
  <!-- #content -->
</section>
<?php 

/**
 * Include footer template
 */

include ('footer.tpl.php'); 



mysql_free_result($register);
?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password");
//-->
</script>
