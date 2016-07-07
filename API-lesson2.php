<?php

/*****************************************************************
* Below we have an API call for featured lsitings.
* We will set the API endpoint url and the required headers
* We will use cURL to return json.
* If the call is successful and return 200 as the http status code we will run json_decode()
* At the end we dump out the resonse
******************************************************************/

// access URL and request method
$url = 'https://api.idxbroker.com/clients/featured';

// method is GET as we are reading data not creating, updating, or deleting any data
$method = 'GET';

// headers (required and optional)
$headers = array(
    // required content type our servers expect
	'Content-Type: application/x-www-form-urlencoded',
	// required - replace with your own
	'accesskey: YOURAPIKEYHERE',
	// optional - overrides the preferences in our API control page
	'outputtype: json'
);

// set up cURL and add the url endpoint and any required headers
$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

// exec the cURL request and returned information.e
$response = curl_exec($handle);

//Store the returned HTTP code in $code for later referenc
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

//evaluate if the returned code is 200 which is the standard everything went OK response
if ($code >= 200 || $code < 300)
    //if 200 run json_decode() this PHP function takse the json string and formats so we can work with it
	$response = json_decode($response,true);
else
    // Should the response not be 200 then there was an error
	$error = $code;
	
	
// var_dump() dumps out whatever is in the variable provided
// commented out var_dump($response);


// Run a for each loop. This loops through all the returned lsitings
// Each listing data is stored in $key and $value
// We can work with specific values of the data by specifying with the $value varable
foreach ($response as $key => $value){
    
    //add link to details page
    echo '<img src="'.$value["image"]["0"]["url"].'"><br>';
    //add link to details page
    echo '<h2>Price: '.$value["listingPrice"].'</h2>';
    //add link to details page
    echo '<h3><div id="count">Total views online: '.$value["viewCount"].'</div></h3>';
    
    
    
}

	
/*****************************************************************
* Running the code above should give you an return of listings from the MLS a000
* The return is now ready to be cached by you and then used however you see fit
* You might send this data to a CRM or post the newest listing on facebook
* For this lessson we will store and create a simple featured listings page
* Import the next Gist for the next part of the lesson
******************************************************************/	
	
	
	?>
