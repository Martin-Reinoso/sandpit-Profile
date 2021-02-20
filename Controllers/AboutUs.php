<?php

class AboutUs
{
	public static function CreateView($viewName){
		require_once("./Views/$viewName.php");
	}

	public static function scriptFile(){
		header('Content-Type: text/javascript');
		require_once("./Views/script.js");
	}

	public static function cssFile(){
		header('Content-Type: text/css');
		require_once("./Views/styles.css");
	}

}

?>