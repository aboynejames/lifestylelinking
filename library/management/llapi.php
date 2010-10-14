<?php

// not being used right now - api used hardwired into LLlogic.php class include list.

class apimanagement
{

// handles plugin of rssfeeder, wikipediaapi, (others flickr, zendyoutube) (other admin pubhubsub, rss, rdf, widgets, opensocial, fbconnect any on the web)
// for each api, offer a plugin ie with basic framework code or as a service e.g..third party website/service e.g. janrainIDlogin, FBconnect, pubhubsub, superfeedr, firehose of data etc.

		protected $apiStart; // array of api status ie. whic api and whether install or third party
    
    
   public function __construct($apiSetup)
		{
			$this->apiStart = $apiSteup;
		} 
    



    // extract information on whether install or as a service bein used
    public function localOrservice()
		{
      // if local install code for download into framework  or hook into third party api
    foreach ($this->apiStart as $service=>$serviceName)
    {
    
    // produce list of api and whether to use them installed or third party api
    // use this info. to call further functions below.
    // an install array('0'=> 'wikipedia', '1'=>rssFeedreader ') installed  array for thirdpary('0'=> 'third1', '1'=> 'third2') NB. then identity of api becomes an issue map 
    
    }  // closes foreach
        
          
    }


//  installed apis available

    // wikipedia include class
    public function wikipediAPI()
		{
			
     include_once('apis/wikipedia.php'); 
      
    }


    // wikipedia include class
    public function rssFeedreader()
		{
			
     include_once('apis/feedreader/install.php'); 
      
    }

    // other to add potentiall,  openis, FBconnect, pubhubsubdub, easyRDF, fickr photo, youtube videos, api all media available on web.


//  third party as a service e.g. superfeedr, twitter, fb, sports data, medical data etc.

    // wikipedia include class
    public function thirdPartyAPI()
		{
      // use this function to hook up to third part APIS
			// takes input from locaOrservice function above
      
    }



}  // closes class



?>