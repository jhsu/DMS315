<?php
if ($_POST) {
/*
 *
 * username
 */
}
require('user.php');

$params = array("username" => "jhsu", "password" => "t3st1ng", "email" => "jshsu@buffalo.edu");
$user = User::create($params);

?>
<textarea cols="50" rows="40">
<?php print_r($user); ?>
</textarea>
