<?php

class Country {
	const table_name = 'Country';
	const primary_key = 'code';
	var $languages = array();

	public function __construct(/* array */) {
	}

	public function query($query) { $result = mysql_query($query);
		// return mysql_fetch_array($result);
		while($row = mysql_fetch_assoc($result) ) {
			$this->data_array[] = $row;
		}
		mysql_free_result($result);
		return $this->data_array;
	}

	public function all() {
		$result = mysql_query("select * from ". self::table_name . " order by Continent, Region, Name");
		$countries = array();
		while($row = mysql_fetch_assoc($result)) {
			$country = new Country();
			foreach($row as $index => $value) {
				$attr = strtolower($index);
				$country->$attr = $value;
			}
			$countries[] = $country;
		}
		mysql_free_result($result);
		return $countries;

	}

	public function find_by_code($code) {
		$result = mysql_query("select Country.*,CountryLanguage.Language from ". self::table_name ." left outer join CountryLanguage on Country.code = CountryLanguage.CountryCode where Country.code='$code' limit 1");
		$row = mysql_fetch_assoc($result);
		foreach($row as $index => $value) {
			$attr = strtolower($index);
			$this->$attr = $value;
			// $this->languages[] = ;
		}
		return $row;
	}


}
?>
