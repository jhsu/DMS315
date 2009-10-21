<?php 
/*
 * IMGbay
 * img vs img
 * images have rank
 * some sort of numeric value
 */

require('../config/database.php');
require('user.php');
require('photo.php');

// start session
session_start();
require('helpers.php'); // some helpers require sessions

// must be authorized to view this page
must_be_authorized();

// upload file
if ($_FILES) {
  $params = array_merge($_FILES['photo'], $_POST['photo']);
  $photo = new Photo($params);
  $photo->save();
}

$photos = Photo::all();

?>

<?php include('views/_header.php');?>

<?php include('views/_navi.php');?>

<form action="<?= $base_url ?>/photos.php" method="post" enctype="multipart/form-data">
<fieldset>
  <input type="hidden" name="photo[user_id]" value="<?= current_user()->id; ?>" />
  <label for="upload[file]">File</label>
  <input type="file" id="upload[file]" name="photo" />
</fieldset>
<div class="buttons">
  <button type="submit">upload</button>
</div>
</form>

<?php foreach($photos as $photo) { ?>
<img src="/imgbay/<?= $photo->src ?>" />
<?php } ?>

<pre>
<?php print_r($photos) ?>
</pre>

<?php include('views/_debug.php');?>

<?php include('views/_footer.php');?>
