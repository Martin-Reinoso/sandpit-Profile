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

Route::set('script.js', function(){
	AboutUs::scriptFile();
});

Route::set('styles.css', function(){
	AboutUs::cssFile();
});

Route::set('get-data', function(){
	GetData::GetAllStaff();
});

Route::set('get-data-range', function(){
	GetData::GetStaffRange($_GET["Dep"],$_GET["S"],$_GET["E"]);
});

Route::set('get-data-departments', function(){
	GetData::GetAllDepartments();
});

?>