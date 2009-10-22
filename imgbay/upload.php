<?php
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
  $params = $_FILES['photo'];
  $photo = new Photo($params);
  $photo->user = current_user();
  $photo->save();
}
if ($_SERVER['HTTP_REFERER']) {
  $goto = $_SERVER['HTTP_REFERER'];
} else {
  $goto = $base_url;
}
header("Location: ".$goto, true, 302);
?>
