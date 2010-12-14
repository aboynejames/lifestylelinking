<?php
/**
 * LifestyleLinking
 *
 * Co-ordinates the various local and in the cloud api available to the Framework.
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Manages the identity, connection and dataflows from API's
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class apimanagement
{

// handles plugin of rssfeeder, wikipediaapi, (others flickr, zendyoutube) (other admin pubhubsub, rss, rdf, widgets, opensocial, fbconnect any on the web)
// for each api, offer a plugin ie with basic framework code or as a service e.g..third party website/service e.g. janrainIDlogin, FBconnect, pubhubsub, superfeedr, firehose of data etc.

		protected $apiStart; // array of api status ie. whic api and whether install or third party
    protected $apiSetup;
    
   public function __construct($apiSetup)
		{
			$this->apiStart = $apiSetup;
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

    
    /** wikipedia include class
     *
     * local install or as a service from the web?
     *
     */  
    public function wikipediAPI()
		{
			
     include_once('apis/wikipedia.php'); 
      
    }
    
    /** rss/atom feed reader / parser
     *
     * local install or as a service from the web?
     *
     */  
    public function rssFeedreader()
		{
			
     include_once('apis/feedreader/install.php'); 
      
    }

    // other to add potentiall,  openis, FBconnect, pubhubsubdub, easyRDF, fickr photo, youtube videos, api all media available on web.


    /** other api services
     *
     * any other apps local or online service to integrate
     *
     */  
    public function thirdPartyAPI()
		{
      // use this function to hook up to third part APIS
			// takes input from locaOrservice function above
      
    }



}  // closes class



?>