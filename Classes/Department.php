<?php
class Department{
	// Properties
  public $name;
  public $description;
  public $people = array( );

  // Methods
  function __construct($name, $description) {
    $this->name = $name; 
    $this->description = $description; 
  }

  function add_person($person){
  	array_push($this->people, $person);
  }

}

?>