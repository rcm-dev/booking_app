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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO booking_detail (pax_adult, pax_child) VALUES (%s, %s)",
                       GetSQLValueString($_POST['pax_adult'], "int"),
                       GetSQLValueString($_POST['pax_child'], "int"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($insertSQL, $bookingAppCon) or die(mysql_error());
}

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_booking_detail = "SELECT * FROM booking_detail";
$booking_detail = mysql_query($query_booking_detail, $bookingAppCon) or die(mysql_error());
$row_booking_detail = mysql_fetch_assoc($booking_detail);
$totalRows_booking_detail = mysql_num_rows($booking_detail);
 

/**
 * Set variable Page view on the top
 * and the page auto set page
 */
$page_view = "booking system | Booking System";

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>amannagappa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
     <link href="css/normalize.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
   <link href="css/bootstrap.css" rel="stylesheet">
    
    <style>
  
	  th, thead { background: #eee; color: #eee; border: 1px solid #000; }
	  tbody tr:nth-child(even) td, tbody tr.even td {background:#e5ecf9;}
	  tr:nth-child(odd)  {background-color: #eee;}
      tr:nth-child(even) {background-color: #fff;}
      body {
        padding-top: 30px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    .center #content #form1 div table tr td {
	color: #000;
}
    </style>
   
    </head>
    <body>
<?php

/**
 * Include header template
 */
include ('header.tpl.php'); 

?>


<section class="center">

    <section id="content">
        <h1>Booking Details</h1>
        <?php
        
	
	 $MatoaPrice = '700.00';
	 $PataoPrice = '800.00';
	 $ArungPrice = '600.00';
	 	/*function calculate_total(){
	 
	 */
	 ?>
        <label><p><strong>Remarks:</strong> </p>
        <ul>
        <ul>
          <li>Children 13 years old and above is at full Adult rate</li>
          <li>Children 8-12 years old is at 50% of Adult rate</li>
          <li>FREE OF CHARGE: Children 7 years old and below (sharing room  with parent)</li>
          <li>Additional Night includes 3 daily meals</li>
        </ul> </label>
      <form id="form1" name="form1" method="post" action="booking_detail.php">
          <div align="center">
            <table width="935" height="151" border="1">
              <tr>
                <td width="217" rowspan="2"><div align="center"><strong>Room Name</strong></div></td>
                <td height="23" colspan="2"><div align="center"><strong>Pax</strong></div></td>
                <td width="227" rowspan="2"><div align="center">
                  <p><strong>Price Package</strong></p>
                  <p> (3 days 2 night)</p>
                </div></td>
                <td width="210" rowspan="2"><div align="center"><strong>Additional Night</strong></div></td>
                <td width="171" rowspan="2"><div align="center"><strong>Total</strong></div></td>
              </tr>
              <tr>
                <td width="95" height="23"><strong>Adult</strong></td>
                <td width="73"><strong>Child</strong></td>
              </tr>
              <tr>
                <td height="39"align ="center" ><?php foreach ($_POST['room'] as $value)
										{
										
										echo"<li>$value</li> \n";
                						
              							} 
										?>										            </td>
                <td><label>
                  <div align="center">
                    <select name="pax_adult" id="pax_adult">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </label></td>
                <td><label>
                  <div align="center">
                    <select name="pax_child" id="pax_child">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </label></td>
                 <td><input name="price_package" border="0" type="text" value="<?php if ($value == "M101" || $value == "M102"){
								 echo $MatoaPrice;  
					}elseif ( $value == "P101" ||  $value == "P102" || $value == "P103" || $value == "P104" || $value == "P105"){
							  echo $PatoaPrice;
							  } elseif ($value == "A101" ||  $value == "A102" || $value == "A103" ){
							  echo $ArungPrice;  
                                  }    ?>" readonly="true"></td></td>
                <td><label>
                  <div align="center">
                    <select name="additional_night" id="additional_night">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                </label></td>
                <td>
                 <?php
				  global $total;
				  $MatoaPrice = '700.00';
				 $PataoPrice = '800.00';
	 			$ArungPrice = '600.00';
	 if ($value == "M101" || $value == "M102"){
	 $AddNitePrice = 350 * $_POST['Additional_night'];
	 $PriceChild = ($MatoaPrice *0.5) * $_POST['pax_child'];
	 $noofAdult =$_POST['pax_adult'];
	 $total = ($MatoaPrice * $noofAdult) + $priceChild + $AddNitePrice; 
	 
	 }
	 elseif ($value == "P101" || $value == "P102" || $value == "P103" || $value == "P104" || $value == "P105"){ 
	 	$AddNitePrice = 350 * $_POST['Additional_night'];
	 $PriceChild = ($PataoPrice *0.5) * $_POST['pax_child'];
	 $noofAdult =$_POST['pax_adult'];
	 $total = ($PataoPrice * $noofAdult) + $PriceChild + $AddNitePrice; 
	 
	  }
	 elseif ($value == "A101" || $value == "A102" || $value == "A103"){ 
	 	$AddNitePrice = 350 * $_POST['Additional_night'];
	 $PriceChild = ($ArungPrice *0.5) * $_POST['pax_child'];
	 $noofAdult =$_POST['pax_adult'];
	 $total = ($ArungPrice * $noofAdult) + $PriceChild + $AddNitePrice;
	 
	 
				           						  
	 } echo "$total";
	  ?></td>
              </tr>
              <tr>
                <td height="26">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="26">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <p><br />
            </p>
          </div>
          <div align="center">
            <input type="hidden" name="MM_insert" value="form2" />
            <input type="submit" value="confirm" />
          </div>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
<p>&nbsp;</p>
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



mysql_free_result($booking_detail);
?>
  </body>
</html>