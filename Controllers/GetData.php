<?php

/**
* @author Martin Reinoso
* @date Jan 2021
* @desc Controller that manage the data in hte server
* returns a JSON file with what was requested
*/

class GetData
{
	public static function GetStaffRange($DepartmentID, $start, $end ){

		//Return a JSON with profiles of Stuff in the selected Deparment 
		//Start is the id of the first one to return
		//End is the id of the last profile to return

		$JsonReturn = array();

		$data = file_get_contents('./Model/data');
		$dataArray = unserialize($data);
		

		if(count($dataArray)-1 < $DepartmentID or $DepartmentID < 0 ){
			echo 'Department Out of Range';
			return;
		}

		$Department = $dataArray[$DepartmentID];
		$PeopleInDepartment = $Department->people;

		if(count($PeopleInDepartment)-1 < $start or $start < 0){
			echo 'Start Out of Range';
			return;
		}

		if($start > $end){
			echo 'End Out of Range';
			return;
		}

		if(count($PeopleInDepartment)-1 < $end){
			$end = count($PeopleInDepartment); // return until the last profile in the data
		}

		for ($i= $start; $i < $end ; $i++) { 
			array_push($JsonReturn, $PeopleInDepartment[$i]);
		}

		header('Content-Type: application/json');
		echo json_encode($JsonReturn);
	}

	public static function GetAllDepartments(){

		// Return All Department names and Descriptions with not staff profiles 

		$JsonReturn = array();

		$data = file_get_contents('./Model/data');
		$dataArray = unserialize($data);
		
		foreach ($dataArray as $Department) {
			array_push($JsonReturn, new Department ($Department->name, $Department->description));
		}

		header('Content-Type: application/json');
		echo json_encode($JsonReturn);
	}

}

?>

