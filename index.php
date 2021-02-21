<?php

/**
* @author Martin Reinoso
* @date Jan 2021
* @desc Automatic load of all classess and Routes
*/

require_once('Routes/Routes.php');

function __autoload($class_name){

	if(file_exists('classes/'.$class_name.'.php')){

		require_once 'classes/'.$class_name.'.php';

	}else if (file_exists('controllers/'.$class_name.'.php')){

		require_once 'controllers/'.$class_name.'.php';
	}
}

?>