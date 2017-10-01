<?php
	
	// Faz o check nos Array informados
	function checkArray($array, $key){

		// Verifica se o $key existe no $array
		if(isset($array[$key]) && !empty($array[$key])){
			return $array[$key];
		}

		return null;
	}

	function __autoload($class){
		$file = ROOT . '/lib/class-' . $class . '.php';

		if(!file_exists($file)){
			require_once ROOT . '/404.php';
			return;
		}

		require_once $file;
	}

?>