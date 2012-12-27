
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
  $insertSQL = sprintf("INSERT INTO booking (date_check_in, date_check_out) VALUES (%s, %s)",
                       GetSQLValueString($_POST['date_check_in'], "date"),
                       GetSQLValueString($_POST['date_check_out'], "date"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($insertSQL, $bookingAppCon) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO booking (date_check_out, date_check_in) VALUES (%s, %s)",
                       GetSQLValueString($_POST['date_check_out'], "date"),
                       GetSQLValueString($_POST['date_check_in'], "date"));

  mysql_select_db($database_bookingAppCon, $bookingAppCon);
  $Result1 = mysql_query($insertSQL, $bookingAppCon) or die(mysql_error());

  $insertGoTo = "Reservation.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_rsStep1 = "SELECT date_check_in, date_check_out FROM booking";
$rsStep1 = mysql_query($query_rsStep1, $bookingAppCon) or die(mysql_error());
$row_rsStep1 = mysql_fetch_assoc($rsStep1);
$totalRows_rsStep1 = mysql_num_rows($rsStep1);

mysql_select_db($database_bookingAppCon, $bookingAppCon);
$query_rsStep2 = "Select   booking.date_check_in,   booking.date_check_out,   room.room_name,   room.room_number,   room.room_type,   guest_info.firstName,   guest_info.lastName,   guest_info.Email,   guest_info.phone_no From   booking Inner Join   room On room.room_id = booking.room_id_fk Inner Join   guest_info On guest_info.guest_id = booking.guest_id_fk";
$rsStep2 = mysql_query($query_rsStep2, $bookingAppCon) or die(mysql_error());
$row_rsStep2 = mysql_fetch_assoc($rsStep2);
$totalRows_rsStep2 = mysql_num_rows($rsStep2);

/**
 * Set variable Page view on the top
 * and the page auto set page
 */
$page_view = "Reservation";

?>



<?php

/**
 * Include header template
 */
include ('header.tpl.php'); 

?>
 

	
	
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css">
<link href="jquery-ui-1.9.2.custom/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-1.8.3.js"></script>
<script type ="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript">
$("document").ready(function(){
$("#dateCheckIn").datepicker ({
})
$("#dateCheckOut").datepicker ({
})
});
</script>

<body>    
<section class="center">

  <section id="content">
  


    <h1 align="right"><?php echo $_SESSION['']; ?> </h1>
    <h1>Reservation</h1>
    <p><strong> Step1 :Choose your stay period and then Click Next </strong> </p>
     <form method="post" name="form1" action="<?php echo $editFormAction; ?>" >
       <table align="center">
         <tr valign="baseline">
           <td width="49" align="right" nowrap>Arrive :</td>
           <td width="275"><input type="text" id="dateCheckIn" name="date_check_in"   ></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="right">Depart :</td>
           <td><input type="text" id="dateCheckOut" name="date_check_out" ></td>
         </tr>
         <tr valign="baseline">
           <td nowrap align="right">&nbsp;</td>
           <td><input type="submit" value="Next"></td>
         </tr>
       </table>
       <input type="hidden" name="MM_insert" value="form1">
    </form>
     <p><strong>Step2 : Choose your preferred Package</strong></p>
     <div id="Accordion1" class="Accordion" tabindex="0" >
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">MATOA  Duplex Villas</div>
         <div class="AccordionPanelContent">
           <table width="800" border="0">
             <tr>
               <td width="520"><div align="center">
                   <p>&nbsp;</p>
                 <p><img src="img/room_type/m101.jpg" width="400" height="320" border="2"></p>
               </div></td>
               <td width="270"><p><strong>Description</strong> </p>
                   <p align="justify">Colonial  semi-detached concrete villas with Malay-styled framed rooftop, closer to the  beach and TV lounge area, 2 queen-size beds, air conditioning, attached outdoor  bathroom and standing shower. Spectacular seaview balcony.</p>
                 <p align="justify"><strong>3 Days 2 Nights</strong> = RM700.00</p>
                 <p align="justify"><strong>Additional Night</strong> = RM350.00</p></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>
                   <form name="form2" method="post" action="booking_detail.php">
                     <p><b> Room Available:</b></p>
                     <p>
                       <input type="checkbox" name="room[]" value="M101" />M101 
                       <input type="checkbox" name="room[]" value="M102" /> M102 </p>
                     <label>
                     <input type="submit" name="btnSubmit1" id="btnSubmit1" value="Book" >
                     </label>
                 </form>
                 <p>&nbsp;</p></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
           </table>
         </div>
         <form name="form3" method="post" action="booking_detail.php">
         </form>
       </div>
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">PATAO  Chalet </div>
         <div class="AccordionPanelContent">
           <table width="800" border="0">
             <tr>
               <td width="520"><div align="center">
                   <p>&nbsp;</p>
                 <p><img src="img/room_type/p101.jpg" width="400" height="320" border="2"></p>
               </div></td>
               <td width="270"><p><strong>Description</strong> </p>
                   <p align="justify">Rustic  Malay-styled wooden chalets equipped with air conditioning, attached outdoor  bathroom and standing shower, 2 queen-size beds, sea view balcony.</p>
                 <p align="justify">&nbsp;</p>
                 <p align="justify"><strong>3 Days 2 Nights</strong> = RM800.00</p>
                 <p align="justify"><strong>Additional Night</strong> = RM400.00</p></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td><p>Room Available : </p>
                   <form name="form4" method="post" action="booking_detail.php">
                     <p><b> Room Available:</b></p>
                     <p>
                      <input type="checkbox" name="room[]2" value="P101" /> 
                      P101
                      <input type="checkbox" name="room[]" value="P102" /> P102
                       <input type="checkbox" name="room[]" value="P103" /> P103  </br>
                       <input type="checkbox" name="room[]" value="P104" /> P104
                       <input type="checkbox" name="room[]" value="P105" /> P105 </p>
                                            
              <label>
                     <input type="submit" name="btnSubmit2" id="btnSubmit2" value="Book">
                     </label> 
                         
                     </p>
                     <p>&nbsp;</p>
                   </form></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
           </table>
         </div>
       </div>
       <div class="AccordionPanel">
         <div class="AccordionPanelTab">ARUNG  Terrace </div>
         <div class="AccordionPanelContent">
           <table width="800" border="0">
             <tr>
               <td width="520"><div align="center"><img src="img/room_type/a102.jpg" width="400" height="320" border="2"></div></td>
               <td width="270"><p><strong>Description</strong></br>
               </p>
               <p align="justify">                 Wooden longhouse terraced guest rooms. Twin, triple or quad-sharing basis. Air conditioned rooms, attached outdoor bathroom with standing shower. Seaview balcony.</p>
               <p align="justify">&nbsp;</p>
               <p align="justify">.<strong>3 Days 2 Nights</strong> = RM600.00</p>
               <p align="justify"><strong>Additional Night</strong> = RM 300.00</p></td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td><p>Room Available :</p>
                 <form name="form5" method="post" action="booking_detail.php">
                   <p><b> Room Available:</b></p>
                     <p>
                       <input type="checkbox" name="room[]" value="A101" /> A101
                       <input type="checkbox" name="room[]" value="A102" /> A102
                       <input type="checkbox" name="room[]" value="A103" /> A103
                        </p></label>
                   </p><input type="submit" name="btnSubmit3" id="btnSubmit3" value="Book">
                     </label>
                 </form>               <p>&nbsp;</p>
                   <label>
                     </td>
             </tr>
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
           </table>
         </div>
       </div>
    </div>
     <p>&nbsp;</p>
     <?php echo $row_rsStep2['room_name']; ?><p>&nbsp;</p>
     <div align="right"></div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    
    <?php
mysql_free_result($rsStep1);

mysql_free_result($rsStep2);
?>
</section>
    <!-- #content -->
</section>
<p>
  <!-- <section class="container center"></section> -->
  <?php 

/**
 * Include footer template
 */

include ('footer.tpl.php'); 


?>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
 
</html>
