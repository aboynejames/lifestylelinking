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

     protected $loadcontent;  // existing content data in the framework
     protected $contentin;  // input content source array

     		public function __construct($intention, $llogic, $sourcecontent)
		{
        // what context?  intention for results or dailyupdate mode?
			  

        $this->intention = $intention;
        $this->llogic = $llogic;
        $this->contentin = $sourcecontent;
        $this->contentManager();
            
		}
     
     
  

    public function contentManager()
		{
			// If a new content is being added then attach a new content identity to it (no.1 + linked data url e.g. foaf
      //  also someday, the source content maybe 'rescored 'ie used based on a 'new' science
      // also what api will be use installed rssreader or 'as a service' to superfeedr/third party rss/firehose
      
      // first call and get list of all content ids stored in the framework (has the new content id be process else where in the LL universer check peer to peer)
      $existingcontent = $this->loadExistingcontent();
      
     
      // check if new, if so attached content id to it ie a number for this framework and ideally a FOAF i.e. unique id for whole of web.
      //for each content source, go see if new content items exist for each sources      match source id to url decide if new or updating?
      // feed in new content on a per sourceid
      
      $newcontent = $this->addContent($this->contentin, $existingcontent);
      
      
      //$this->newcontent[$this->contentin] = $this->startFeedreader($this->contenturl);
      //print_r($this->newcontent);
      //$this->startNewcontent($this->contentin);
      
      
      
		} 

    /** Load existing definition or connect for updates to defitions 
     *
     * key wikipedia word and rdf url via dpedia 
     *
     */
    public function loadExistingcontent()
		{
			//echo 'load existing definitions <br /><br />';
      // query local json txt, mysql, couchdb or RDF
      // local text files for now
      // need to have json txt for id of defintions already wise the foreach those
      $this->loadcontent = LLJSON::importJSONdata($contentkey = 0, $contstage = 'content');
//print_r($this->loaddefinitions);
     
      if ($this->loadcontent['start'] == 'empty')
      {
      echo 'null content sources';
      return null;
      }
      
      else
      {
echo 'existing data found <br /><br />';    

          // form array of content       
          foreach($this->loadcontent['source'] as $skey=>$cw)
          {
          
            $contentexist[$skey] = $cw;
          
          }
//print_r($defids);
          foreach($contentexist as $sid=>$cwords)
          {
          $importcontent = LLJSON::importJSONdata($sid, $contentstage='wisecont');
          $this->existsource[$sid] = $importcontent;
echo 'the load existing def in array<br /><br />';
print_r($this->existsource);
//echo 'any loaded';
          }
                    
          return $this->loadcontent;
      }
      //  simplify array to id and wikipediaword

      // call RDF nextwork
      
		}


    /** compare new input conent to existing content
     *
     * if new content source to the framework? 
     *
     */
    public function addContent($newcont, $existingcont)
		{
echo 'call the add content function <br /><br />';
print_r($newcont);
print_r($existingcont);
      if ($existingcont == null)
      {
echo 'first time add of content source';
      //print_r($existingcont);
        // add to content sources - FIRST time entry json txt files or mysql or couchdb
      $sid = 1;  
      $newcontentstart['source'][$sid] = $newcont;
//print_r($newcontentstart);
      LLJSON::storeJSONdata($newcontentstart, $newcontentid = 0, $contentstage='content');
echo 'afterstore';
      
      $this->startNewcontent($sid, $newcont); 
      
      }
      
      else
      {
      //print_r($);
echo 'add content additional need to check if url entered before?';
   
      // is the new content source already in the framework? (check id number, url and xmlfeeduri, rdf if they have it (muitlilevel identity checking
      //$contentcheck = array_search($newcont['url'], $existingcontentids['source']);
        $idstatus = $this->identitycontent($newcont, $existingcont);
echo 'status \n';
              if ($idstatus['match'] > 0)
              {
echo 'already feed added because of ..';
      //print_r($idstatus);
                }

              else 
              {
echo 'brand new source add it to the framework';
      //print_r($idstatus);
             
                     // need to store and append to json txt file, mysql or couchdb
                     // form new summary definition array ie existing plus new
                     $newcontentsourceid = $this->newcontentnumber($existingcont);
                     
                     $newcontupdate = $this->updatecontentlist($newcontentsourceid, $newcont);
                     //echo 'new summary def array for json';
                     //print_r($newdefupdate);

                     LLJSON::storeJSONdata($newcontupdate, $newcontidstart = 0, $contentstage='content');
                     // not in framework , add it
                     // append definition new allocated id 
                     $newcontentarray = array($newcontid=>$newcontent);
                     
                     $this->startNewcontent($newcontentsourceid, $newcont);
               
                  }                     
  
         
     }
      
		}

    /** New content source needs added to this framework 
     *
     * takes array of new content source ids 
     *
     */  
      public function identitycontent ($new, $existing)
      {

      // find out how many sources of id present for this source
      foreach($new as $id=>$newidentity)
      {

            if(strlen($newidentity) > 0)
            {

              $identifers[$id] = $newidentity;
            
            }

      }
      $newsourceid = count($identifers);
      //echo $newsourceid.'number of sources of id';
      //print_r($identifers);


          foreach($identifers as $id=>$ident)
          {
         
              foreach($existing['source'] as $sid=>$sident)
              {
               $contentcheck = '';
          //echo $id;
          //echo $sid;
              $contentcheck = array_search($identifers[$id], $existing['source'][$sid]);
             // echo 'matched'.$contentcheck;
                  if (strlen($contentcheck) > 0)
                  {
                  $idcheck[$id] = 1;
                  
                  }
              
              }

          }
         
      if(isset($idcheck))
      {
      //print_r($idcheck);
          
          $match = count($idcheck);
         
          }
          else
          {
          
          $match = 0;
          }

          // if url there and not match, or rss there and not match  pretty sure new source  etc  rdf  and  sourceid allocated by framework
          if($match > 0)
          {
            
            // percentage score of how confident of correct id?
            $percentage = ($match/$newsourceid);
            $identitycheck['confidence'] = $percentage;
            $identitycheck['basis'] = $idcheck;
            $identitycheck['match'] = true;
          // how sure of unique id?
          return $identitycheck;

          }

          else
          {

          return $identitycheck['match'] = false;

          }


      }

    /** New content source needs added to this framework 
     *
     * takes array of new content source ids 
     *
     */  
    public function newcontentnumber($existingcontid)
    {
//print_r($existingcontid['source']); 
    // existing definition array - what was last id used? 
      $skeys = array_keys($existingcontid['source']);
 //print_r($skeys);
 
    $lastcontid = end($skeys);
//echo $lastcontid;
    $newcontid = $lastcontid + 1 ;
//echo 'newid'.$newconid;
    return $newcontid;
    
    } 
    
    /**  
     *
     * 
     *
     */  
    public function updatecontentlist($newsid, $newcont)
    {
//echo 'before new add <br /><br />';
//print_r($this->loaddefinitions);
    
   // existing list of def data
    $newsavecont = $this->loadcontent;
    $newsavecont['source'][$newsid] = $newcont;
    
    return $newsavecont;
    
    // new defintion and allocatea  new id    
    
    }
    
    /**  
     *
     *  
     *
     */  
    public function startNewcontent($sid, $newcontentstart)
		{
			// starts 
echo 'new content';
      // call rss/atom feedreader
      $sourcecontent = $this->startFeedreader($newcontentstart['url']);
      //$sourcecontent['posts'][1] = array('content'=>'<p>Read a quote from Jefferson that &#8216;vision without execution is a called a hallucination!&#8217;  Or words to that affect.  Execution is a rather fierce word, even in the &#8216;corporate&#8217; was it suggests of ruthless efficiency, do what ever it takes, an object devoid of life etc.  However, we are in 2011, we are now wiser, social connections abound, other humans matter all the time, ideas have a lowering barrier before they get seeded into the world.  So, maybe, vision and make real is a better tag line for today.</p>');
echo 'new rss feed content data';
//print_r($sourcecontent);
          
           foreach ($sourcecontent['posts'] as $cid=>$newcont)
           {
           echo 'new array formed';
           echo $sid;
           echo 'contentid'.$cid;
           //print_r($newcont);
            // ? independently parse out rss feed url at this stage or allow pie to do it later?
            $this->buildContent($sid, $cid, $newcont);
            
            } // closes foreach loop
//print_r($this->cleanContent);
     
     // store raw post words       
     LLJSON::storeJSONdata($this->cleanContent, $sid, $stage = 'rawcontent');
     echo 'after store rawcontent';
      
      // now make those list of words wise
      foreach ($this->cleanContent[$sid] as $cid=>$newCwords)
      {
      
      $wiseContent[$sid] = $this->makeContentWise($cid, $newCwords); 
     
      }
print_r($wiseContent);
      // now all content madewise, save on a per source basis
           // store raw post words       
      LLJSON::storeJSONdata($wiseContent, $sid, $stage = 'wisecont');

      
		}

     
    /**  
     *
     *  clean the new content data  
     *
     */  
		public function buildContent($sid, $cid, $newcontentpost)
		{


			// Create a LLDataCleanser object
			$dataCleaner = new LLDataCleanser($newcontentpost['content']);
			
			// Clean the data
			$contentwords = $dataCleaner->cleanContent();
			
			// Get the cleaned data
			$this->cleanContent[$sid][$cid] = $contentwords;
//print_r($this->cleanContent);        
      }
      
     
     /** Turns clean content array in Wise array of words
     *
     * based on frequency used author by wikipedia community (why?  Start crowd source vocabularly)
     * also certain words excluded  CQ and 'joining' words
     *
     */ 
  	public function makeContentWise($cid, $contentwordarray)
		{
			// Note: use arrays and not database
			
   		// Create a LLDataCleanser object
      $dataWisdom = new LLwordWisdom($contentwordarray);
			
			// Clean the data
			$dataWisdom->wisdomLogic();
			
			// Get the cleaned data
			$this->wiseDefinition[$cid] = $dataWisdom->wiseWords();
      //print_r($this->wiseDefinition); 
      
      return $this->wiseDefinition;


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

      // new data
      // prase own try of rss/atom and pass that to simplepie or allow all that to be done by the pie??)
            //foreach ($new as $fid=>$nfeedurl)
            //{

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

                        $newcontentarray = $contentfeed;
                        
                        endforeach;

                        endif;

                       

            //}  // closes foreachloop

//print_r($newcontentarray);
      return $newcontentarray;
      
      }

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


  }  // closes class
  
  
  ?>
