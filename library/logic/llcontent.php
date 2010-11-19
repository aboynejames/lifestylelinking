<?php

class LLcontent
{

     protected $contentin;  // input from e.g. rss feedreader 
     protected $contentStart;
     protected $newcontent;

        // feed in the content
     		public function __construct($contentsources)
		{
        
			  $this->contentin = $contentsources;
            
		}
     
     
  

    public function contentManager()
		{
			// If a new content is being added then attach a new content identity to it (no.1 + linked data url e.g. foaf
      //  also someday, the source content maybe 'rescored 'ie used based on a 'new' science
      // also what api will be use installed rssreader or 'as a service' to superfeedr/third party rss/firehose
      
     // check if new, if so attached content id to it ie a number for this framework and ideally a FOAF i.e. unique id for whole of web.

      // first call and get list of all content ids stored in the framework (has the new content id be process else where in the LL universer check peer to peer)
      // to be built
      
      //for each content source, go see if new content items exist for each sources      
     // feed in new content on a per sourceid
      //foreach($this->contentin as $sid)
      //{
 
       // match source id to url decide if new or updating 
      $this->newcontent[$this->contentin] = $this->startFeedreader($this->contentin);
      //print_r($this->newcontent);
      $this->startNewcontent($this->contentin);
      
      //}
      
      
		} 


    public function startFeedreader($sid)
		{
    
    // use source id to check if new or required to be check for new data
    
    // add function to do this
    $sidurl = 'http://aboynejames.blogspot.com';

    // Start counting time for the page load
          $starttime = explode(' ', microtime());
          $starttime = $starttime[1] + $starttime[0];

          $_GET['feed'] = $sidurl;

          // Create a new instance of the SimplePie object
          $feed = new SimplePie();

          //$feed->force_fsockopen(true);

          // Make sure that page is getting passed a URL
          if (isset($_GET['feed']) && $_GET['feed'] !== '')
          {
            // Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
            if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
            {
              $_GET['feed'] = stripslashes($_GET['feed']);
            }

            // Use the URL that was passed to the page in SimplePie
            $feed->set_feed_url($_GET['feed']);
          }

          // Allow us to change the input encoding from the URL string if we want to. (optional)
          if (!empty($_GET['input']))
          {
            $feed->set_input_encoding($_GET['input']);
          }

          // Allow us to choose to not re-order the items by date. (optional)
          if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
          {
            $feed->enable_order_by_date(false);
          }

          // Trigger force-feed
          if (!empty($_GET['force']) && $_GET['force'] == 'true')
          {
            $feed->force_feed(true);
          }

          // Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
          // all that other good stuff.  The feed's information will not be available to SimplePie before
          // this is called.
          $success = $feed->init();

          // We'll make sure that the right content type and character encoding gets set automatically.
          // This function will grab the proper character encoding, as well as set the content type to text/html.
          $feed->handle_content_type();

          // need to extract contentid  if new ones exist add them.
          //print_r($feed);

          $contentids = array('0'=>'1', '1'=>'2', '2'=>'3', '3'=>'4', '4'=>'5', '5'=>'6', '6'=>'7', '7'=>'8', '8'=>'9', '9'=>'10', '10'=>'11', '11'=>'12', '12'=>'13', '13'=>'14', '14'=>'15', '15'=>'16', '16'=>'17', '17'=>'18', '18'=>'19', '19'=>'20', '20'=>'21', '21'=>'22', '22'=>'23', '23'=>'24' );

          foreach ($contentids as $index=>$cid)
          {
          //echo 'CONTENT ITEM <br /><br />';
          $newcontentdata[$cid] = ($feed->data['child']['http://www.w3.org/2005/Atom']['feed']['0']['child']['http://www.w3.org/2005/Atom']['entry'][$cid]['child']['http://www.w3.org/2005/Atom']['content']['0']['data']);

          }
      //print_r($newcontentdata);
      return $newcontentdata;

		}



    public function startNewcontent($sid)
		{
			// starts 
           // echo 'new content';
            //print_r($this->newcontent[$sid]);
           foreach ($this->newcontent[$sid] as $contid=>$incont)
           {
            //echo $incont;
            $this->buildContent($sid, $contid, $incont);
            
            } // closes foreach loop

      
		}

     
    // clean the new content data 
		public function buildContent($sid, $contid, $incont)
		{
			// Note: use arrays and not database

			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($incont);
			
			// Clean the data
			$dataCleaner->clean();
			
			// Get the cleaned data
			$this->cleanContent[$sid][$contid] = $dataCleaner->cleanedData();
        
      }


		public function cleanedContent()
    {
    //print_r($this->cleanContent);
      return $this->cleanContent;
		}


  }  // closes class
  
  
  ?>
