<?php
/**
 * LifestyleLinking
 *
 * Manages new content coming into the Framework
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * How to handle new content into the Framework
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLcontent
{

     public $loadcontent;  // existing content data in the framework
     protected $contentin;  // input content source array
     public $existingcontent; // sources already in framework
     public $wiseContent;  // top words per post
     protected $wiseposts;

	/** 
	*  Constructor to manage sources of content
	* 
	* 
	*/
	public function __construct($intention, $sourcecontent)
	{
        // what context?  intention for results or dailyupdate mode?
			  

        $this->intention = $intention;
        $this->contentin = $sourcecontent;
        $this->contentManager();
            
	}
     
     
  
	/** 
	*  
	* 
	* 
	*/
	public function contentManager()
	{
	// If a new content is being added then attach a new content identity to it (no.1 + linked data url e.g. foaf
      
	// TODO first need to check what data is live in the framework?  If first use this instance, load updata or based on intention(should be solved in context class?)
 
         // need logics  dailyupdate or first time entry of content
          if(isset($this->contentin['newcontent']))
          {
            //  for the new content sources,  first load in new sources (can we prioritise or should results be presented pre these and then add them as scoring is done if slow?)
	    // double check source has not been included before
            //$existingcontent = $this->loadExistingcontent();
            //$this->updatasources($existingcontent);
          
          }
         
	// existing content needs updated for new content or expansion of sources
	// first load existing content
	$this->updatasources();
	
	// then extend reach 
      
      
	} 

    /** 
     * call various methods to input source content
     *  
     *
     */
    public function autocontent()
   {
      //NB. source content url and results data or even full download of everything but enourage sharing of min to save data repication
    
     // api to rssfeed reader (various on web)
     
     // built in autocrawl
     
     // api call to spawning ground site e.g. mepath.com
     
     // peertopeer RDF network sources
     
    // for now a batch of sourceurls with no. additional data   if data then need a flag stop the processing of content and get on to the personalization of results
      $shareddata = array('url'=>'http://www.aboynejames.co.uk/wordpress', 'rss'=>'http://www.aboynejames.co.uk/wordpress/feed/', 'rdf'=>'', 'sourceid'=>'', 'frameworkid'=>'mepath.com');
  
     return $shareddata;
      
      
    }



    /**  
     * Load existing definition or connect for updates to defitions 
     * key wikipedia word and rdf url via dpedia 
     *
     */
	public function loadExistingcontent()
	{


	}
      
	

     /** 
     *  see if new content is available for all live feed sources
     * if new content save and make live in framework ready for results 
     *
     */
	public function updatasources()
	{
    
		foreach($this->contentin as $cid=>$cinfo)
		{
	    
		$cleancontent = '';
		$wiseposts = '';
	    
		// get rss/atom feed
		 $updatecontent = $this->startFeedreader($cinfo['url']);
//echo 'new rss content array';
//print_r($updatecontent);

		foreach($updatecontent['posts'] as $postid=>$blogcontent)
		{
		// clean content
//echo  'contenttttt'.$blogcontent['content'];
//print_r($blogcontent);
		$cleancontent[$cinfo['url']][$postid] = $this->cleanContent($blogcontent['content']);
//echo 'new clean content';
//print_r($cleancontent);
		
		// makewise
		$this->wiseposts[$cinfo['url']][$postid] = $this->makeContentWise($cleancontent[$cinfo['url']][$postid]);
		

		}

	// store couchDB
	// prepare array for JSON format
	$JSONcontent['bloginfo'] = $cinfo;
	$JSONcontent['source'] = $updatecontent;
	$JSONcontent['sourcewords'] = $cleancontent[$cinfo['url']];
	$JSONcontent['wisewords'] = $this->wiseposts[$cinfo['url']];

	$this->couchconnect =  'lifestylelinking';
	$this->couch_dsn = "http://localhost:5984/";
   
	// may need to form JSON array first or do it a couchdb class
	$couchdocset = new LLcouchdb($this->couch_dsn, $this->couchconnect, $JSONcontent);	
	$couchdocset->saveCOUCHdoc();

//echo 'list of wise array from blog pppposts';
//print_r($wiseposts);


		}
	
	
	
	
	
	}



	/** 
	* compare new input conent to existing content
	* if new content source to the framework? 
	*
	*/
	public function addContent($newcont, $existingcont)
	{
	
	
	
	}

	/**  
	* New content source needs added to this framework
	* takes array of new content source ids 
	*
	*/  
	public function identitycontent ()
	{


	}

    
	/**  
	*  Calls feedreader active RSS feed
	*  
	*
	*/  
	public function startNewcontent()
	{
	// starts 
//echo 'new content';
      // call rss/atom feedreader
      $sourcecontent = $this->startFeedreader($newcontentstart['url']);
      
      // TODO: if no feed can be found or url not valid, get this feedback back to UI and stop all further processing, reset previous settings too
      
      //  save memory and JSON summary content summary, limited to data required to be called for display or to check if update content posts are available ie. date data
      // now opportunity to store source content for retieval by results class (also prepare sample text, urls, extract photos/video or other asset within the post
      $this->resultscontent($sid, $sourcecontent);


//echo 'new rss feed content data';
//print_r($sourcecontent);
          
           foreach ($sourcecontent['posts'] as $cid=>$newcont)
           {
//echo 'new array formed';
//echo $sid;
//echo 'contentid'.$cid;
           //print_r($newcont);
            // ? independently parse out rss feed url at this stage or allow pie to do it later?
            $this->cleanContent($sid, $cid, $newcont);
            
            } // closes foreach loop
//print_r($this->cleanContent);
     
      
      // now make those list of words wise
      foreach ($this->cleanContent[$sid] as $cid=>$newCwords)
      {
      
      $this->wiseContent[$sid] = $this->makeContentWise($cid, $newCwords); 
     
      }
//print_r($wiseContent);
      // now all content madewise, save on a per source basis
           // store raw post words       


// store in couchDB

// form datacontent array


// calls store couchdb class

  // store raw post words       
 //    LLJSON::storeJSONdata($this->cleanContent, $sid, $stage = 'rawcontent');
//echo 'after store rawcontent';
   
// LLJSON::storeJSONdata($this->wiseContent, $sid, $stage = 'wisecont');


      
	}

     
	/**  
	*
	*  clean the new content data  
	*
	*/  
	public function cleanContent($cleancontentin)
	{

	// Create a LLDataCleanser object
	$dataCleaner = new LLDataCleanser($cleancontentin);
	
	// Clean the data
	$contentwords = $dataCleaner->cleanContent();
	
	// Get the cleaned data
	$this->cleanContent = $contentwords;
//print_r($this->cleanContent);        

	return $this->cleanContent;

}
      
     
     /** Turns clean content array in Wise array of words
     *
     * based on frequency used author by wikipedia community (why?  Start crowd source vocabularly)
     * also certain words excluded  CQ and 'joining' words
     *
     */ 
  	public function makeContentWise($cleanpostsin)
	{
	// Note: use arrays and not database
			
   	// Create a LLDataCleanser object
	$dataWisdom = new LLwordWisdom($cleanpostsin);
			
	// Clean the data
	$dataWisdom->wisdomLogic();
			
	// Get the cleaned data
	$this->madewiseContent = $dataWisdom->wiseWords();
      //print_r($this->wiseDefinition); 
      
	return $this->madewiseContent;


	}     
      
	/**  Calls rssfeed reader simple pie 
	*
	*	    
	*
	*/  
	public function startFeedreader($surlin)
	{
    
	       if (count($surlin) > 0 )
	      {

	      // new contentdata
	      // prase own try of rss/atom and pass that to simplepie or allow all that to be done by the pie??)

		    $feed = array();
		    $contentfeed = array();
		   
		   // Create a new instance of the SimplePie object
		    $feed = new SimplePie();

		    //$feed->force_fsockopen(true);

		    // Make sure that page is getting passed a URL
			 // if (isset($nfeedurl) && $nfeedurl !== '')
			  //{
			    // Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
			   // if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
			    //{
echo 'strip';
			      $nfeedurl = stripslashes($surlin);
echo $nfeedurl;
			    //}

			    // Use the URL that was passed to the page in SimplePie
			    $feed->set_feed_url($nfeedurl);
			  //}
	      /*
			  // Allow us to change the input encoding from the URL string if we want to. (optional)
			  if (!empty($_GET['input']))
			  {
			    $feed->set_input_encoding($_GET['input']);
			  }
	      */
			  // Allow us to choose to not re-order the items by date. (optional)
			  //if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
			  //{
			   // $feed->enable_order_by_date(false);
			  //}
	      /*
			  // Trigger force-feed
			  if (!empty($_GET['force']) && $_GET['force'] == 'true')
			  {
			    $feed->force_feed(true);
			  }
	      */
			  // Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
			  // all that other good stuff.  The feed's information will not be available to SimplePie before
			  // this is called.
			  $success = $feed->init();

			  // We'll make sure that the right content type and character encoding gets set automatically.
			  // This function will grab the proper character encoding, as well as set the content type to text/html.
			  $feed->handle_content_type();
		      
	//print_r($feed);
		  //        $contentadded[$fid] = feedarray($success, $feed);


				if ($success):


				if ($feed->get_link())

				$contentfeed['link'] = $feed->get_link();
				$contentfeed['title'] = $feed->get_title();

				if ($feed->get_link());

				$contentfeed['description'] = $feed->get_description(); 

				$itemids = 1; 
				      
				    foreach($feed->get_items() as $item): 

				    // iterate by one each time
				    $itemid = $itemids ++;

				    //echo $item->get_id();
				    //print_r($item->get_categories());
				    //print_r($item); 
					  if ($item->get_permalink())
					  $contentfeed['posts'][$itemid]['permalink'] = $item->get_permalink();
					  $contentfeed['posts'][$itemid]['posttitle'] = $item->get_title();
					  
					  if ($item->get_permalink())
					  $contentfeed['posts'][$itemid]['authordate'] = $item->get_date("U"); //('j M Y, g:i a');

					  $contentfeed['posts'][$itemid]['content'] = $item->get_content();
				    /*
					  // Check for enclosures.  If an item has any, set the first one to the $enclosure variable.
					  if ($enclosure = $item->get_enclosure(0))
					  {
					    // Use the embed() method to embed the enclosure into the page inline.
					    $enclosure->embed(array(
					      'audio' => './for_the_demo/place_audio.png',
					      'video' => './for_the_demo/place_video.png',
					      'mediaplayer' => './for_the_demo/mediaplayer.swf',
					      'altclass' => 'download'
					    )) ;

					    if ($enclosure->get_link() && $enclosure->get_type())
					    {
						 $enclosure->get_type();
					      if ($enclosure->get_size())
					      {
						$enclosure->get_size();
					      }
					    
					    }
					    if ($enclosure->get_thumbnail())
					    {
					      $enclosure->get_thumbnail();
					    }
					  
					  }
					  ?>
				    */
				    
				    endforeach;
				$newcontentarray = $contentfeed;
				endif;

	//print_r($newcontentarray);
	      return $newcontentarray;
	      
	      }

	}



	/**  
	*
	*	    
	*
	*/  
  	public function resultscontent()
	{
      // first extract the data
      //$postresults['links'] = $this->extractlinks();
      //$postresults['images'] = this->extractimages();
      //$postresults['video'] = $this->extractvideo();
      //$postresults['other'] = this->extractother();
      // call autocrawl?
      //$sautocrawl = new LLautocrawl();
      
      //$postresults = $sourcecontent;
      
      // store source content data
      //LLJSON::storeJSONdata($postresults, $newcontidstart = $sid, $contentstage='sourceprepared');
    
    // now couchDB
    
    
	}

	/**  
	*
	*    
	*
	*/  
  	public function cleanedContent()
	{
    //print_r($this->cleanContent);
	return $this->cleanContent;
	
	}


	/**  
	*  return wise words
	*    
	*
	*/  
  	public function wiseContentlive()
	{
    //print_r($this->cleanContent);
	return $this->wiseposts;
	
	}


  }  // closes class
  
  
  ?>
