<?php

class FileParsing {

	public static function parseFileName($fileName) {

		$pattern = '/^count\.{1}\w*$/';

		return preg_match($pattern, $fileName);

	}

	public static function parseNumber($fileName) {

		$arrResult = [];

		$handle = @fopen($fileName, "r");

		if ($handle) {

		    while (($buffer = fgets($handle, 4096)) !== false) {

		    	$result = preg_replace("/[^,.0-9]/", ' ', trim($buffer));
		    	$result = preg_replace("/\s+/", ' ', $result);
		    	$result = preg_replace("/\s{1}\.\s{1}/", ' ', $result);
		    	$result = preg_replace("/\s{1}\,\s{1}/", ' ', $result);

		    	$arr = explode(' ', $result);

		        $arrResult = array_merge($arrResult, $arr);
		    
		    }

		    if (!feof($handle)) {

		        echo "Ошибка: fgets() неожиданно потерпел неудачу\n";

		    }

		    fclose($handle);
		    
		}

		return $arrResult;

	}

	public static function getFileSum($arr) {

		$res = 0;

		foreach ($arr as $key => $value) {

    		$res += $value;

    	}

    	return $res;

	}

}