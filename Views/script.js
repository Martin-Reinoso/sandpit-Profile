

const ContactCard = ({ name, email, photo, id }) => `
  <div class="col-lg-3 col-md-6" style="display: none;" id="Person${id}">
		<div class="card">
			<div class="card-body">
				<img src="${photo}" alt="" class="img-fluid rounded-circle w-50 mb-3">
				<h3>${name}</h3>
				<p>${email}</p>
			</div>
		</div>
	</div>
`;



const DepartmentCard = ({ id,name, description }) => `
  <div class="row mb-5" id="Department${id}" style="display: none;" onclick="getPersonCardAjax(${id})">
  		<div class="col">
			<h1 id="temp">${name}</h1>
			<p class="mt-3"> ${description} </p>
		</div>
	</div>
	<div class="row" id="DepartmentCards${id}">

	</div>
`;


function getBaseURL(){
	var data_url = document.location.href.split('/');
    data_url.pop();
    return data_url.join('/');
}

function getPersonCardAjax(dep){
  	data_url = getBaseURL()+"/get-data-range?Dep="+dep+"&S="+0+"&E="+4;	
  	$.getJSON( data_url, function( data ) {

  		var arrayid = []
  		for (i = 0; i < data.length; i++) {
  			data[i].id = dep+"-"+i
		}

  		//data.map((item, id) => Object.assign(item, { id })) // Add an Id to each person
  		$('#DepartmentCards'+dep).append(data.map(ContactCard));

  		for (var i = data.length - 1; i >= 0; i--) {
  			$('#Person'+dep+"-"+i).delay(i*1000).show('slow');
  		}
	});
}

$(document).ready(function(){

	data_url = getBaseURL()+"/get-data-departments";
	$.getJSON( data_url, function( data ) {

		data.map((item, id) => Object.assign(item, { id })) // Add an Id to each Department

		console.log(data);

  		$('#holdDepartment').append(data.map(DepartmentCard));

  		for (var i = data.length - 1; i >= 0; i--) {
  			$('#Department'+i).delay(i*1000).show('slow');
  		}
  		

	});

  $("button").click(function(){  
  	var dep = 0
  	data_url = getBaseURL()+"/get-data-range?Dep="+dep+"&S="+0+"&E="+4;	
  	$.getJSON( data_url, function( data ) {
  		data.map((item, id) => Object.assign(item, { id })) // Add an Id to each person
  		$('#DepartmentCards'+dep).append(data.map(ContactCard));

  		for (var i = data.length - 1; i >= 0; i--) {
  			$('#Person'+i).delay(i*1000).show('slow');
  		}
	});

    
  });
});