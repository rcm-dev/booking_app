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

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_login = "SELECT Email, password FROM guest_info";
$login = mysql_query($query_login, $bookingAppCon) or die(mysql_error());
$row_login = mysql_fetch_assoc($login);
$totalRows_login = mysql_num_rows($login);


/**
 * Include header template
 */
include ('header.tpl.php'); 

?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Email2'])) {
  $loginUsername=$_POST['Email2'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  
  $LoginRS__query=sprintf("SELECT Email, password FROM guest_info WHERE Email=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $bookingAppCon) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">



<section class="center">

    <section id="content">
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<h1>Guest Log in</h1>
<form name="form3" method="POST" action="<?php echo $loginFormAction; ?>">
<label><br>
          </label>
          <table width="278" height="184" border="0">
            <tr>
              <td width="109">Email</td>
              <td width="24">:</td>
              <td width="131"><span id="sprytextfield2">
                <label>
                  <input type="text" name="Email2" id="Email2">
                </label>
              <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>password</td>
              <td>:</td>
              <td><span id="sprypassword1">
                <label>
                  <input type="password" name="password" id="password">
                </label>
              <span class="passwordRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" name="Login" id="Login" value="Submit"></td>
            </tr>
          </table>
          <label><br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
</label>
        </form>
        <p>&nbsp;</p>
    </section>
    <!-- #content -->

</section>
<!-- <section class="container center"></section> -->




<?php 

/**
 * Include footer template
 */

include ('footer.tpl.php'); 



mysql_free_result($login);
?>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
//-->
</script>
