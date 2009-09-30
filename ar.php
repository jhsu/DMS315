<?php 
class AR {
	protected $self = array();
	const table_name = 'Country';
	const primary_key = 'id';

		public function all() {
			$result = mysql_query("select * from ". self::table_name ." limit 10");
			return mysql_fetch_array($result);
		}

	public function find($id) {
		$id = mysql_real_escape_string($id);
		$result = mysql_query("select * from ". self::table_name ." where ". self::primary_key ."='$id' limit 1");
		$result = mysql_fetch_object($result, get_class($this));
		foreach(get_object_vars($result) as $attr => $value ) $this->$attr = $value;
		return $this;
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
