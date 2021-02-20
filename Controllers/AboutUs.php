<?php

class AboutUs
{
	public static function CreateView($viewName){
			require_once("./Views/$viewName.php");
	}

	public static function scriptFile(){
			require_once("./Views/js/script.js");
	}

}

?>