<textarea rows="30" cols="80">
session['user_id'] = <?php print_r($_SESSION['user_id']) ?>

POST:
<?php 
print_r($_POST);
?>

FILE:
<?php 
print_r($_FILES);
?>

GET:
<?php 
print_r($_GET);
?>

<?php 
print_r($user);
?>
</textarea>
