<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       woo.com
 * @since      1.0.0
 *
 * @package    Woo
 * @subpackage Woo/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h5>AWESOMESS</h5>

<form action="" id="personal-data" method="POST">
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <button type="submit">Submit</button>
</form> 

<!-- SEND AJAX REQUEST -->
<button id="ajax-request">SEND AJAX</button>