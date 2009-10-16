<?php 
/*
 * IMGbay
 * img vs img
 * images have rank
 * some sort of numeric value
 */

require('../config/database.php');
require('user.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// upload file
if ($_FILE) {
  $photo = new Photo($_FILES['photo']);
  // move_uploaded_file($photo->tmp_name, $photo_dir."/".$photo->name);
  move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/".$_FILES["photo"]["name"]);
  unset($photo->tmp_name);
}

?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>


<form action="<?= $base_url ?>/photos.php" method="post" enctype="multipart/form-data">
<fieldset>
  <label for="upload[file]">File</label>
  <input type="file" id="upload[file]" name="photo" />
</fieldset>
<div class="buttons">
  <button type="submit">upload</button>
</div>
</form>


<?php include('views/_debug.php');?>

<?php include('views/_footer.php');?>
