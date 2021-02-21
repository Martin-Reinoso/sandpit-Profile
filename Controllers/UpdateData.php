<?php

/**
* @author Martin Reinoso
* @date Jan 2021
* @desc Controller to download profiles from https://randomuser.me/ and add to a Department.
*/

class UpdateData
{
	public static function Update($totalStaff){
	
		$TOTAL_NUMBER_OF_STAFF = $totalStaff;

		$DEPARTAMENTS = array( //Descriptions and names of the Departmets in the company
			new Department ("Hardware",
				"Our engineers have created some tough acts to follow, and they continue to lead us to innovative breakthroughs. Because they’re driven not by what would be easy, but by what would be amazing."),
			new Department ("Software and Services",
				"Our engineers have always focused on one person when they build software — the person who will use it. Working with them, you’ll see why every Apple product and service feels intuitive and simple, and why every aspect of this group’s work is built around a respect for the customer’s needs."),
			new Department ("Design",
				"Our products work beautifully because our designers maintain an intense focus on simplicity and usability. They judge the success of their work not by everything they put into it, but by everything the user gets out of it."),
			new Department ("Operations",
				"Build to the highest standards. Deliver on the highest expectations."),
			new Department ("Marketing",
				"The people of Marketing work directly with our designers and engineers as products are developed. It’s a level of collaboration that strengthens their commitment to the complete product vision, uniting this team’s wide range of talent around a singular focus: ensuring that the whole world feels as passionately about our products as we do."),
			new Department ("Retail",
				"Whether they’re serving consumers or businesses, these teams introduce customers to the creativity and productivity of Our products and services. And then they work to make those connections last."),
			new Department ("Sales",
				"The team focused on delivering great customer experiences, you’ll introduce people to the Our products that help them do what they love in new ways.")
		);

		//Get staff profiles from https://randomuser.me

		$curl = curl_init();
		curl_setopt_array($curl, array( 
		  CURLOPT_URL => "https://randomuser.me/api/?results=".$TOTAL_NUMBER_OF_STAFF,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);


		$obj = json_decode($response, true);

		//Add in random profiles to deiferent departments.
		//I only keep the name, email and photo

		foreach ($obj['results'] as $value) {
		    $name = $value['name']['first'] . " " . $value['name']['last'];
			$email = $value['email'];
			$photo = $value['picture']['large'];

			$person= new Person($name, $email, $photo);

			$DEPARTAMENTS[rand(0,count($DEPARTAMENTS)-1)]->add_person($person);
		}

		echo '<pre>'; print_r($DEPARTAMENTS); echo '</pre>'; // Print the data file

		$jsonData = serialize($DEPARTAMENTS);
		 file_put_contents('./Model/data', $jsonData); //Store informaiton in a file on the server
		}

}

?>