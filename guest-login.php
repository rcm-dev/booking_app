<?php require_once('Connections/bookingAppCon.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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
  $insertSQL = sprintf("INSERT INTO guest_info (Email, password) VALUES (%s, %s)",
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

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
$query_rsLogin = "SELECT Email, password FROM guest_info";
$rsLogin = mysql_query($query_rsLogin, $bookingAppCon) or die(mysql_error());
$row_rsLogin = mysql_fetch_assoc($rsLogin);
$totalRows_rsLogin = mysql_num_rows($rsLogin);
 

/**
 * Set variable Page view on the top
 * and the page auto set page
 */
$page_view = "Welcome to Booking System";

?>



<?php

/**
 * Include header template
 */
include ('header.tpl.php'); 

?>
</p>
<h1>Guest Log In</h1>


<p>
  <section class="center">
    
    <section id="content">  
    
    
    
    
      </section>
    <!-- #content -->
  </section>
  <!-- <section class="container center"></section> -->
  
  
  
  
  <?php 

/**
 * Include footer template
 */

include ('footer.tpl.php'); 


?>
</p>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="Email" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Login" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
<?php
mysql_free_result($rsLogin);
?>
