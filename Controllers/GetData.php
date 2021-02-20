<?php

class GetData
{
	public static function GetAllStaff(){

		$data = file_get_contents('./Model/data');
		$dataArray = unserialize($data);
		$JsonReturn = array();

		foreach ($dataArray as $Department) {
			foreach ($Department->people as $person) {
				array_push($JsonReturn, $person);
			}
		}
		header('Content-Type: application/json');
		echo json_encode($JsonReturn);
	}

	public static function GetStaffRange($DepartmentID, $start, $end ){

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
			$end = count($PeopleInDepartment);
		}

		for ($i= $start; $i < $end ; $i++) { 
			array_push($JsonReturn, $PeopleInDepartment[$i]);
		}

		header('Content-Type: application/json');
		echo json_encode($JsonReturn);
	}

	public static function GetAllDepartments(){

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

