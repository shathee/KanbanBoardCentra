<?php
namespace KanbanBoard;

class Utilities
{
	private function __construct() {

	}

	/**
	 * Loads the parameter values from .env file to $_ENV global  
	 * @param type $file_path 
	 * @return 
	*/
	

	public static function load_env_file($file_path) {
		
		if(!file_exists($file_path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $file_path));
        }else{
        	if (!is_readable($file_path)) {
            	throw new \RuntimeException(sprintf('%s file is not readable', $file_path));
        	}
        	$lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	        foreach ($lines as $line) {

	            if (strpos(trim($line), '#') === 0) {
	                continue;
	            }
	            list($env_var_name, $env_var_value) = explode('=', $line, 2);
	            $env_var_name = trim($env_var_name);
	            $env_var_value = trim($env_var_value);

	            if (!array_key_exists($env_var_name, $_SERVER) && !array_key_exists($env_var_name, $_ENV)) {
	                putenv(sprintf('%s=%s', $env_var_name, $env_var_value));
	                $_ENV[$env_var_name] = $env_var_value;
	                $_SERVER[$env_var_name] = $env_var_value;
	            }
	        }
        }
        return $_ENV;
	}

	/**
	 * gets the value of the environment parameter 
	 * @param type $name 
	 * @param type|null $default 
	 * @return 
	 */
	
	public static function env($name, $default = NULL) {
		$value = getenv($name);
		if($default !== NULL) {
			if(!empty($value))
				return $value;
			return $default;
		}
		return $value;
	}

	public static function hasValue($array, $key) {
		return is_array($array) && array_key_exists($key, $array) && !empty($array[$key]);
	}

	public static function dump($data) {
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}
}