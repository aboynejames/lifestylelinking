<?php


class apimanagement
{

// handles plugin of rssfeeder, wikipediaapi, (others flickr, zendyoutube) (other admin pubhubsub, rss, rdf, widgets, opensocial, fbconnect any on the web)
// for each api, offer a plugin ie with basic framework code or as a service e.g..third party website/service e.g. janrainIDlogin, FBconnect, pubhubsub, superfeedr, firehose of data etc.


// wikipedia include class
	public function wikipediadefinitionurl($wikipediaurl)
		{
			
     include_once('apis/wikipedia.php'); 
      
    }
	

}  // closes class



?>