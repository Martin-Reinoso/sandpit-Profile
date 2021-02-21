/**
* @author Martin Reinoso
* @date Jan 2021
* @desc Scripts that loads with Ajax and animate the interaction
*  
**/

//Variables

var localData = []; //Store the current number of ContactCards with id of the department
var notVisiblePersonCardHolder = [] // Store the object that can be scrolled but have nto been seen on the screen

// Templates for the Department and profile (ContactCard)

const DepartmentCard = ({ id,name, description }) => `
  <div class="row mb-5" id="Department${id}" >
  		<div class="col">
			<h1 id="temp">${name}</h1>
			<p class="mt-3"> ${description} </p>
		</div>
	</div>
	<div class="scrolling-wrapper row flex-row flex-nowrap mt-4 pb-3 pt-2" id="DepartmentCards${id}" onscroll="scrollCards(${id})">

	</div>
`;


const ContactCard = ({ name, email, photo, id }) => `
  <div class="col-lg-3 col-md-6" id="Person${id}" onclick="ClickScroll(Person${id})">
    <div class="card" >
      <div class="card-body">
        <img src="${photo}" alt="" class="img-fluid rounded-circle w-50 mb-3">
        <h3>${name}</h3>
        <p>${email}</p>
      </div>
    </div>
  </div>
`;

$(document).ready(function(){
  // Runs after the page is load.
  // Uses Ajax to get a JSON file with the depsrtaments names and descriptions
  getDepartmentsAjax();
});

function getDepartmentsAjax(){
  // Get the Department information from the server and display in HTML

  data_url = getBaseURL()+"/get-data-departments";
  
  $.getJSON( data_url, function( data ) { // Gets the information of all departments (name, description)
    
    data.map((item, id) => Object.assign(item, { id })) // Add an Id to each Department

    $('#holdDepartment').append(data.map(DepartmentCard)); // Usin Templates for DepartmentCards

    for (i = 0; i < data.length; i++) {


      localData.push(0); 
      notVisiblePersonCardHolder.push(i);

      getPersonCardAjax(i);

    }

    CheckVIsibleToAnimate();

  });
}

function getPersonCardAjax(dep){

  // Get from server the next 5 ContactCards and add them to the HTML

  var NUM_LOAD_CARDS = 5; //Min 5 becuase a scroll is needed to load more cards
  var currentLastId = localData[dep];

    data_url = getBaseURL()+"/get-data-range?Dep="+dep+"&S="+currentLastId+"&E="+(currentLastId+NUM_LOAD_CARDS);  
    
    $.getJSON( data_url, function( data ) {
      localData[dep] = localData[dep]+(data.length);

      for (i = 0; i < data.length; i++) {
        data[i].id = dep+"_"+(currentLastId+i); //Adds an ID to the object
      }

      $('#DepartmentCards'+dep).append(data.map(ContactCard)); // Adds the template

      if (currentLastId != 0){

        //Animation to show there are more cards
        //After adding the new downloaded cards scroll to show the border

        var currentScroll = $('#DepartmentCards'+dep).scrollLeft();
        var extraScroll = 30;
        $('#DepartmentCards'+dep).animate({scrollLeft: currentScroll + extraScroll}, 750);
      }

  });
}


function ClickScroll( CardId){

  // When a contactCard is click, move the scroller to center that card on the screen

  var currentScroll= $(CardId).parent().scrollLeft();
  var scrollerWidth = $(CardId).parent().outerWidth();
  var positionLeftCard = $(CardId).position().left

  var centeredCard = scrollerWidth/2- $(CardId).width()/2;

  var moveVal = 0;

  if(centeredCard < positionLeftCard){
    moveVal = positionLeftCard - centeredCard;
  }else{
    moveVal = -1* (centeredCard - positionLeftCard);
  }

  $(CardId).parent().animate({scrollLeft: currentScroll + moveVal}, 750);
}


function scrollCards( DepartmentId){
  //Function thet rin when scrolling the contact Cards
  //When detect a limit ask form more cards to the server

  var scrollDepartment = "#DepartmentCards"+DepartmentId;

  var currentScroll= $(scrollDepartment).scrollLeft();
  var maxScroll = $(scrollDepartment)[0].scrollWidth - $(scrollDepartment).outerWidth();

  if(currentScroll == maxScroll ){
    getPersonCardAjax(DepartmentId); //On the scroll limit request for more cards from this Department
  }
}


function CheckVIsibleToAnimate(){
  // look for the scroll area and wait until is on the screen to move it

  if (notVisiblePersonCardHolder.length !=0 && $('#DepartmentCards'+notVisiblePersonCardHolder[0]).visible(true)) {
      var currentScroll = $('#DepartmentCards'+notVisiblePersonCardHolder[0]).scrollLeft();
      var extraScroll = 30;
      $('#DepartmentCards'+notVisiblePersonCardHolder[0]).animate({scrollLeft: currentScroll + extraScroll}, 750);
      notVisiblePersonCardHolder.splice(0,1);
  } 
}


$(window).scroll(function(event) {
  // Check if there is a vertical scroll and animate ContactCards if the are new 
  CheckVIsibleToAnimate();
});



//HELPER FUNCTIONS

function getBaseURL(){
  var data_url = document.location.href.split('/');
    data_url.pop();
    return data_url.join('/');
}


(function($) {

  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  $.fn.visible = function(partial) {
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);