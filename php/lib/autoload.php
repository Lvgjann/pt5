<?php
/*function __autoload($class) {
	$fichier = 'modeles/dto/' . lcfirst($class) . '.php';
	if(is_file($fichier) && is_readable($fichier)){
		require_once $fichier;
	}
}
*/
spl_autoload_register('Autoloader::autoloadDao');
spl_autoload_register('Autoloader::autoloadLib');
spl_autoload_register('Autoloader::autoloadTraits');
spl_autoload_register('Autoloader::autoloadDto');
class Autoloader{


	static function autoloadLib($class){
		$file = 'lib/' . lcfirst($class) . '.php';
		if(is_file($file)&& is_readable($file)){
			require $file;
		}
	}

	static function autoloadDao($class){
		$file = 'model/DAO/' . lcfirst($class) . '.php';
		if(is_file($file)&& is_readable($file)){
			require $file;
		}
	}

	static function autoloadTraits($class){
		$file = 'model/traits/' . lcfirst($class) . '.php';
		if(is_file($file)&& is_readable($file)){
			require $file;
		}
	}
	static function autoloadDto($class){
		$file = 'model/DTO/' . lcfirst($class) . '.php';
		if(is_file($file)&& is_readable($file)){
			require $file;
		}
	}

}

