<!-- 
* @author Martin Reinoso
* @date Jan 2021
* @desc Basic HTMl inports Bootstrap, JQuery, our script.js and styles.css
*/
-->

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


	<link rel="stylesheet" type="text/css" href="styles.css">

    <!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="script.js"></script>


    <title>About Us!</title>
  </head>
  <body>

  	<section id= "team">
  		<div class="container my-3 py-5 text-center">
  			<div class="row mb-5" id = "holdDepartment">
  				<!-- Here the script loads the departments from an AJAX call to the server  -->
  				<!-- Everthing else is done in the script file -->
  			</div>
  		</div>
  	</section>

  </body>
</html>