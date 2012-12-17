<?php 

/**
 * Set variable Page view on the top
 * and the page auto set page
 */
$page_view = "Guest Log In to Booking System";

?>



<?php

/**
 * Include header template
 */
include ('header.tpl.php'); 

?>


<section class="center">

    <section id="content">
        <h1>Guest Log In</h1>
        <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="24%">Email</td>
              <td width="6%">:</td>
              <td width="70%"><label for="email"></label>
              <input type="text" name="email" id="email" /></td>
            </tr>
            <tr>
              <td>Password</td>
              <td>:</td>
              <td><label for="password"></label>
              <input type="password" name="password" id="password" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><input type="submit" name="button" id="button" value="Register" /></td>
            </tr>
          </table>
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


?>