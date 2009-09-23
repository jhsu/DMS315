<?php 

include('config/database.php');

class AR {
	protected $self = array();
	const table_name = 'Country';
	const primary_key = 'id';

	public function all() {
		$result = mysql_query("select * from ". self::table_name ." limit 10");
		return mysql_fetch_array($result);
	}

	public function find($id) {
		$result = mysql_query("select * from ". self::table_name ." where ". self::primary_key ."='$id' limit 1");
		return mysql_fetch_array($result);
	}

	public function create() {
	}

	public function save() {
	}

	public function update() {
	}

	public function destroy() {
	}
}

?>
