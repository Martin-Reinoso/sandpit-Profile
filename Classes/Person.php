<?php

class Person {
  // Properties
  public $name;
  public $email;
  public $photo;

  //Constructor
  function __construct($name, $email, $photo) {
    $this->name = $name; 
    $this->email = $email; 
    $this->photo = $photo; 
  }

}

?>