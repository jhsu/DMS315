<?php
define('ABSPATH', dirname(__FILE__).'/');
class Photo {

  public $attrs = array('filename');

  public function __set($attr, $value) {
	if ($attr == "name") {
	  $this->filename = time()."_".$value;
	  unset($this->name);
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
        return true;
    } else {
        return false;
    }
  }

  public function save() {
	$attrs = $this->attrs;
	$fields = implode(",", $attrs);
	$values = array();
	foreach($attrs as $attr) {
	    $values[] = "'".$this->$attr."'";
	}
	$values = implode(",", $values);
	if($this->filesave()) {
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


  public function delete_all() {
	mysql_query('truncate photos');
  }

  public function user() {
  	$user_id = (int) $this->user_id;

  	$query = sprintf("select * from users where id = %s", $user_id);
  }

  public function create($params) {
  }
}

?>
