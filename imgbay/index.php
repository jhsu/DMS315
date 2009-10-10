<?php 
/*
 * IMGbay
 * img vs img
 * images have rank
 * some sort of numeric value
 */

require('../config/database.php');
require('user.php');
?>
<?php include('../views/_header.php');?>
<div id="login">
<?php include('../views/_login.php');?>
</div>

<h1>You vs. Me</h1>

<textarea>
<?php 
$user = new User();
print_r($user);
?>
</textarea>

<?php include('../views/_footer.php');?>
