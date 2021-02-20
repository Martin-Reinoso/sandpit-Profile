<?php

Route::set('update-data', function(){
	
	if (isset($_GET["totalStaff"])){
		UpdateData::Update($_GET["totalStaff"]);
    }else{
    	UpdateData::Update(50);
    }

}); 

Route::set('about-us', function(){
	AboutUs::CreateView('AboutUs');

}); 

Route::set('get-data', function(){
	GetData::GetAllStaff();
});

Route::set('get-data-Range', function(){
	GetData::GetStaffRange($_GET["Dep"],$_GET["S"],$_GET["E"]);
});

Route::set('get-data-Departments', function(){
	GetData::GetAllDepartments();
});

?>