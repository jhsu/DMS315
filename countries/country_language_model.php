<?php

class CountryLanguage extends AR {
	const table_name = 'CountryLanguage';
	const primary_key = 'CountryCode';

	public function __construct(/* array */) {
	}

	public function all() {
		$result = mysql_query("select * from ". self::table_name . " order by CountryCode");
		$countrylanguages = array();
		while($row = mysql_fetch_assoc($result)) {
			$countrylanguage = new Country();
			foreach($row as $index => $value) {
				$attr = strtolower($index);
				$countrylanguage->$attr = $value;
			}
			$countrylanguages[] = $countrylanguage;
		}
		mysql_free_result($result);
		return $countrylanguages;
	}

	public function find_by_code($code) {
		$result = mysql_query("select * from ". self::table_name ." where CountryCode='$code' limit 1");
		$row = mysql_fetch_assoc($result);
		foreach($row as $index => $value) {
			$attr = strtolower($index);
			$this->$attr = $value;
		}
		return $row;
	}

}
?>
