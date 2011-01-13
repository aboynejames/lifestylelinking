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

    public function __construct($intention, $sourcecontent)
		{
        // what context?  intention for results or dailyupdate mode?
			  

        $this->intention = $intention;
        $this->contentin = $sourcecontent;
        $this->contentManager();
            
		}
     
     
  

    public function contentManager()
		{
			// If a new content is being added then attach a new content identity to it (no.1 + linked data url e.g. foaf
      
      // first call and get list of all content ids stored in the framework (has the new content id be process else where in the LL universer check peer to peer)
      // TODO first need to check what data is live in the framework?  If first use this instance, load updata or based on intention
      $existingcontent = $this->loadExistingcontent();
      
         // need logics  dailyupdate or first time entry of content
          if($this->intention == 'update')
          {
            //  just fly through all sources add new content add to the universe
            // new update function that will compare what we have with what it live?
            $this->updatasources($existingcontent);
          
          }
          
         else
          {
          //  1. is there any content sources to score?  If nil then TODO: prompt for manual input, rssreader e.g. via opensocial googlereader api call, call autocrawl->built in 'spawning url e.g. mepath.com to kickstart content, or peertopeerRDF to source urls score for the lifestyledefinition entered.
              if($this->contentin == null)
              {
              // no content in framework there prompt for manual input, add rssfeed URL, autocrawl->call spawing .com api or peertoPeerRDF framework networking
echo 'no content sources so go for autosource options';              
              // user input
              //echo 'Please add a source blog url';
              
              // autosource
              $autosource = $this->autocontent();
              $newcontent = $this->addContent($autosource['url'], $existingcontent);
              
              }
              
              else
              {
              // source content url present, check to see if it will be added to the framework
              $newcontent = $this->addContent($this->contentin, $existingcontent);
              
              }
          
          }
      
      
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
            //  TODO need to import 1. content dispaly summary data (may have already been done by results class just check)
          $sourcecontentsummary = '';
          // top wise words load
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


    /** see if new content is available for all live feed sources
     *
     * if new content save and make live in framework ready for results 
     *
     */
    public function updatasources($existingcontent)
		{
    
        foreach($existingcontent as $sid=>$sidurl)
        {
        
              // check to see if data for this source is live in the framework?  If not load it up
            if($aaa == $bb)
            {
              // load data
            
            }
       
          // last date saved
          $lastpostdate = '';
        
        
          // get rss/atom feed
         $updatecontent = $this->startFeedreader($sidurl);
        
        // are any post dates later then the last postdate variable?  if so add the new data to that source
      
        // then compare to existing framework data/save new
        // look at post dates
        
        }
    
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
      $sourcecontent = $this->startFeedreader($newcontentstart);
      
      // TODO:  save memory and JSON summary content summary, limited to data required to be called for display or to check if update content posts are available ie. date data
      // now opportunity to store source content for retieval by results class (also prepare sample text, urls, extract photos/video or other asset within the post
      $this->resultscontent($sid, $sourcecontent);


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
			$this->wiseContent[$cid] = $dataWisdom->wiseWords();
      //print_r($this->wiseDefinition); 
      
      return $this->wiseContent;


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
  	public function resultscontent($sid, $sourcecontent);
    {
      // first extract the data
      //$postresults['links'] = $this->extractlinks();
      //$postresults['images'] = this->extractimages();
      //$postresults['video'] = $this->extractvideo();
      //$postresults['other'] = this->extractother();
      // call autocrawl?
      //$sautocrawl = new LLautocrawl();
      
      
      // store source content data
      //LLJSON::storeJSONdata($postresults, $newcontidstart = $sid, $contentstage='results');
    
    
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
