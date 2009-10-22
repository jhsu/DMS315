<?php
define('ABSPATH', dirname(__FILE__).'/');
class Photo {

  public $attrs = array('user_id', 'filename', 'thumbnail');

  public function __set($attr, $value) {
	if ($attr == "name") {
	  $value = preg_replace('/\W[^(\.\w{3})$]/', '', $value);
	  $value = preg_replace('/\s+/', '_', $value);
	  $this->filename = time()."_".$value;
	  unset($this->name);
	} else if ($attr == "user") {
	  $this->user_id = $value->id;
	} else {
	  $this->$attr = $value;
	}
  }

  public function __construct($params) {
	  foreach($params as $attr => $value) {
		  $this->$attr = $value;
	  }

	  $this->path = ABSPATH."photos";
	  $this->src = "/photos/".$this->filename;

	  return $this;
  }

  public function filesave() {
    if (move_uploaded_file($this->tmp_name, $this->path.'/'.$this->filename)) {
	  $photo = new Imagick($this->path.'/'.$this->filename);
	  $photo->thumbnailImage(800, null);
	  $photo->writeImage($this->path.'/'.$this->filename);

	  $thumb = new Imagick($this->path.'/'.$this->filename);
	  $thumb->thumbnailImage(300, null);
	  $thumb->writeImage($this->path.'/thumb_'.$this->filename);
	  
	  $this->thumbnail ='thumb_'.$this->filename;
      return true;
    } else {
      return false;
    }
  }

  public function save() {
	if($this->filesave()) {
	  $attrs = $this->attrs;
	  $fields = implode(",", $attrs);
	  $values = array();
	  foreach($attrs as $attr) {
	  	$values[] = "'".$this->$attr."'";
	  }
	  $values = implode(",", $values);

	  $query = "insert into photos (".$fields.") values(".$values.")";
	  mysql_query($query);
	  unset($this->errors);
	} else {
	  $this->errors = "Unable to save photo";
	}
	return $this;
  }

  public function all($options=array()) {
	$photos = array();
	$modifiers = array();
	foreach($options as $opt => $value) {
	  $modifiers[] = "$opt $value";
	}
	$modifiers = " ".implode(' ', $modifiers);
	
	$query = mysql_query("select * from photos$modifiers");
	while($photo = mysql_fetch_assoc($query)) {
	  $photos[] = new Photo($photo);
	}
	return $photos;
  }

  public function find($id) {
	$result = mysql_query("select * from photos where id='$id'");
	if (mysql_num_rows($result) == 0) {
	  return NULL;
	} else {
	  $photo = new self(mysql_fetch_assoc($result));
	  return $photo;
	}
  }

  public function find_by_username($username) {
	$result = mysql_query("select users.*,photos.* from users left outer join photos on users.id = photos.user_id where username='".trim($username)."'");
	$photos = array();
	if (mysql_num_rows($result) > 0) { 
	  while($photo = mysql_fetch_assoc($result)) {
	  	$photos[] = $photo;
	  }
	}
	return array_reverse($photos);
  }

  public function delete_all() {
	  $photos = mysql_query("select filename,thumbnail from photos where user_id='".current_user()->id."'");
	  $filenames = array();
	  while($photo = mysql_fetch_assoc($photos)) {
		$filenames[] = "photos/".$photo['filename'];
		$filenames[] = "photos/".$photo['thumbnail'];
	  }
	  foreach($filenames as $file) {
		unlink($file);
	  }
	  mysql_query("delete from photos where user_id='".current_user()->id."'");
  }

  public function top() {
	$query = mysql_query('select * from photos order by score DESC limit 10');
	$photos = array();
	while($item = mysql_fetch_assoc($query)) {
		$photos[] = new self($item);
	}
	return $photos;
  }

  public function vote() {
	$score = (int) $this->score + 1;
	mysql_query("update photos set score='".$score."' where id='".$this->id."' limit 1");
  }


  public function random_vs() {
	$query = mysql_query("select * from photos order by rand() limit 2");
	$photos = array();
	while($photo = mysql_fetch_assoc($query)) {
		$photos[] = new self($photo);
	}
	return $photos;
  }

  public function user() {
  	$user_id = (int) $this->user_id;
  	$query = sprintf("select * from users where id = %s", $user_id);
	$user = mysql_fetch_assoc($query);
	return $user;
  }

  public function create($params) {
  }
}

?>
