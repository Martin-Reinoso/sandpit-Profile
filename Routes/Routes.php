<?php

/**
* @author Martin Reinoso
* @date Jan 2021
* @desc Routes the application use. 
*/


Route::set('update-data', function(){
	
	if (isset($_GET["totalStaff"])){
		UpdateData::Update($_GET["totalStaff"]);
    }else{
    	UpdateData::Update(50);
    }

}); 

Route::set('index.php', function(){ // Dirrect user in the root to the about-us page
	AboutUs::CreateView('AboutUs'); 
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


// The following routes are used to rrequest the information
// they return a JSON file with information  


// Return only deparment Names and descritions, no staff profiles
Route::set('get-data-departments', function(){ 
	GetData::GetAllDepartments(); 
});


// Return profiles from Department Dep, Startin in profile S until Profile E
Route::set('get-data-range', function(){
	GetData::GetStaffRange($_GET["Dep"],$_GET["S"],$_GET["E"]);
});


?>