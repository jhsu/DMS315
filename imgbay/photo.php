<?php
class Photo {

  public __set($attr, $value) {
	if ($attr == 'file') {
		// check format
		move_uploaded_file($this->tmp_name, $photo_dir.$value);
		unset($this->tmp_name);
	} else {
	 $this->$attr = $value;
	}
  }

  public function __construct($params) {
	  $photo = new self();
	  foreach($params as $attr => $value) {
		  $photo->$attr = $value;
	  }
	  return $photo;
  }

  public function save() {

  }

  public function user() {
  	$user_id = (int) $this->user_id;

  	$query = sprintf("select * from users where id = %s", $user_id);
  }

  public function create($params) {
  }
}

?>
