<?php
/**
 * LifestyleLinking
 *
 * all LLFramework input data must go through this class 
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Build header logic for display page
 *
 * 
 */
 class LLcontext
 {
 
        protected $resultspath;
        protected $individual;
        protected $displayPath;
        protected $startAPI;

        protected $identitydefintion;
        protected $identitysource;
        protected $pathstring;
	protected $ldmenu;
  
    /**
     * Constructor 
     *
     *  // take all input from UI or control panel and makes it safe and manages the data between UI and Framework
     *
     * Data input from the UI
     *
     * @param  
     *
     */
   public function __construct()
  {
		
    $this->startLL();
    
  } 
    
    
    /** gather starting info.
     *
     * 
     *
     */ 
      public function startLL()
      {
          
       $this->startAPI = $this->startSetup();   
       $this->inputcontext(); 
               
      }

      /** 
       *
       * 
       *
       */ 
      public function inputcontext()
      {
       
       if(isset($_GET['ll']))
       {
        
            // if no text entered then display startpage again
            $intext = $_GET['ll'];
            if(strlen($intext) > 0)
            {
             // this should get text input that is converted to a wikipedia definition or via control panel input
            // also picks up LL logic, display preferences (probably in automode as default  Q. whatis automode/default settings?)
            $lifestyleinput = $_GET;
            //$lifestyleinput['wikipediaword'] = $_GET['ll'];
            // set starting context
            // TODO  will allow personlize box on startUI or just in results UI  either way need to gather personalization settings.
            $mesetting['pblog'] = $_GET['psource'];
       
            $this->lifestylepath = $this->startPath($lifestyleinput);
            $this->individual = $this->startIndividual();
            $this->identitydefintion = $this->startLifestyle($lifestyleinput['ll']);
            $this->identitysource = $this->startInfoUniverse($mesetting['pblog']); 
            }
            
            else
            {
            
            $this->displayPath = new LLDisplay($meidentity, $lifestyleword, $currentlifestyle, $path, $resultsdata, $this->baseurl, $resultlinking);
            
            }
        }
       
       else
       {
       // dispay start UI
       $this->displayPath = new LLDisplay($meidentity, $lifestyleword, $currentlifestyle, $path, $resultsdata, $this->baseurl, $resultlinking);
//echo 'echo start display';
       }
       

        
      }   

      /** 
       *
       * 
       *
       */ 
      public function resultstringcapture ()
      {
      
      // $this->baseurl = $_SERVER['SCRIPT_FILENAME'];
       $this->pathstring = $_SERVER['QUERY_STRING'];
       
       return $this->pathstring;
      
      }
    
      /** 
       *
       * 
       *
       */ 
      public function resultscriptpath ()
      {
      
      // $this->baseurl = $_SERVER['SCRIPT_FILENAME'];
       $this->pathscript = $_SERVER['SCRIPT_NAME'];
       
       return $this->pathscript;
      
      } 
    
    /** 
     *
     * 
     *
     */ 
      public function startSetup()
      {
        // default but need load for return user(cookie or serverside(openid, fbconnect, someID login)
        $startsetup['api'] = array('lifestyle' => 'wikipedia', 'content' => 'rssFeedreader');
        // set starting context
        return $startsetup;
        
      }   

    /** 
     *
     * 
     *
     */ 
      public function startPath($intentioninput)
      {
      
        $timestamp = time();
        $starttime = $timestamp - $intentioninput['timebatch'];
         
        $startresultspath['intention'] = $intentioninput['intention'];
        $startresultspath['logic'] = $intentioninput['logic'];
        $startresultspath['starttime'] = $starttime;
        $startresultspath['endtime'] = $timestamp;
        $startresultspath['timebatch'] = $intentioninput['pathtime'];
        $startresultspath['media'] = $intentioninput['display'];
        $startresultspath['make'] = $intentioninput['make'];
        $startresultspath['filter'] = $intentioninput['filter'];  
        $startresultspath['pathurlstring'] = $this->resultstringcapture();
        $startresultspath['pathscript'] = $this->resultscriptpath();
        $startresultspath['resultsid'] = $intentioninput['resultsid'];
        
            // is the 16 ID code already in the url?  if yes, results for this lifestyle have been calculated before, use them and update for new info.
            if($intentioninput['pathid'])
            {
              //code is present in id
              $startresultspath['pathid'] = $intentioninput['pathid']; 
            
            }
            else
            {

            $startresultspath['pathid'] = $this->makeuniqueid($startresultspath['pathurlstring'],  $startresultspath['endtime']);
            
            }

       

        $startresultspath['stream'] =  $intentioninput['stream'];
        
        // set starting context
        return $startresultspath;
        
      }   

    /** 
     *  Make unique results id for each path
     * 
     *
     */     
	public function makeuniqueid ($pathin, $startimein) 
	{
    
    $uniquepathform = $pathin.$starttimein;

    $jam = sha1($uniquepathform);
    
    //$shortjam = strlen($jam, 16);
    $shortpath = substr($jam, 0, 16);
    
    return $shortpath;

    }   

    /** 
     *
     * 
     *
     */ 
      public function startIndividual()
      {
        // if public first time use then nothing is known about the user place in the LL universe, therefore treat as 'average'
        // if indentity is picked up from cookie/session then set (TODO)  Signed in users will use identity function within Framework class
        $startindividual = 'average';
        // set starting context
        return $startindividual;
        
      }   

    /** 
     *
     * 
     *
     */ 
      public function startLifestyle($uiinput)
      {
      // if lifestyle menus saved or new lifestyle being added   TODO: takes input text and matches it to wikipedia url, from there form dpedia, allocatedid via definition class
        $startidentitydefintion['wikipedia'] = $uiinput;
       //$startidentitydefintion = array('defword'=>'swimming', 'wikipedia'=>'swimming_(sport)', 'dpedia'=>'http://swimming_(sport).dpedia.org', 'defid'=>'1'); 
//$identitydefintion = array('defword'=>'skiing', 'wikipedia'=>'Skiing', 'dpedia'=>'http://skiing.dpedia.org', 'defid'=>''); 
//$identitydefintion = array('defword'=>'Hillwalking', 'wikipedia'=>'Hillwalking', 'dpedia'=>'http://Hillwalking.dpedia.org', 'defid'=>''); 

        // goes through functions to match input text to wikipedia word and manage interaction to get to that stage(TODO)

	// set session/cookie
	// if cookie already set then add new lifestyle to menu array and reset cookie
	if(isset($_COOKIE['lifedefmenu']))
	{
	
	$this->ldmenu =  json_decode($_COOKIE["lifedefmenu"], true);
	// TODO need to check the lifestyle defintiion has not been added before.
	$this->ldmenu[] = $uiinput;
	$ldjson = json_encode($this->ldmenu);
	
	// reset the cookie
	setcookie("lifedefmenu", '');
	
	setcookie("lifedefmenu", $ldjson);
	}
	else
	{
	$this->ldmenu[] = $uiinput;
	$ldjson = json_encode($this->ldmenu);
	// first time setting of cookie
	setcookie("lifedefmenu", $ldjson);
	
	}
	
        return $startidentitydefintion;
        
      } 

    /** 
     *
     * 
     *
     */ 
      public function startInfoUniverse($psourceurl)
      {
        // TODO felsh out info for this inputurl, is it a blog, find rss feed, any rdf, been process in another spawning ground or PeertoPeer RDF?
	
	// 1. have list of default blog urls to test/kick start
	// 2. api call to existing rss feed
	// 3. autocrawl based on own url
	// 4. peertopeer network effect based on input definition
        
	//  url add one at a time from UI
        //$startidentitysource = '';
	if (strlen($psourceurl) > 2 )
	{
	// new url added via the UI add to source content list.
//echo 'psourceinput';	  
	$startidentitysource['newcontent'] =array('url'=>$psourceurl, 'rss'=>'', 'rdf'=>'', 'sourceid'=>'' );
	
	// incremental additions ie url will need to be added to the master list of content urls (ie for saving)
	
	
	
	}
	
	// what about existing URL in framework or is it first time use and need to kick start with new content sources?
	 // go through data reach options
	 // default
//echo 'list of starting urls';	 
	 $startidentitysource =  $this->starturllist();
	 
	 // api call
	 //existingurlcall();
	 
	 // autocrawl
	 //autocrawlblogs();
	 
	 // peertopeer network effect
	 //ptopnetworkeffect()

	
        return $startidentitysource;
        
      }   
      
    /** 
     *
     * 
     *
     */ 
    public function starturllist()
    {
	// test list of urls
	$startlist[1] =array('url'=>'http://www.aboynejames.co.uk/wordpress', 'rss'=>'http://www.aboynejames.co.uk/wordpress/feed/', 'rdf'=>'', 'sourceid'=>'' );
        $startlist[2] =array('url'=>'http://lifestylelinking.blogspot.com/', 'rss'=>'http://lifestylelinking.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );
        //$startlist[3] =array('url'=>'http://www.wildsnow.com/', 'rss'=>'http://www.wildsnow.com/index.php?feed=rss2', 'rdf'=>'', 'sourceid'=>'' );
	//$startlist[4] =array('url'=>'http://utahbackcountryskiing.blogspot.com/', 'rss'=>'http://utahbackcountryskiing.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );
        //$startlist[5] =array('url'=>'http://blog.themountaindepartment.com/', 'rss'=>'http://feeds.feedburner.com/TheSkiingDepartment', 'rdf'=>'', 'sourceid'=>'' );
        //$startlist[6] =array('url'=>'http://wendellmoore.blogspot.com/', 'rss'=>'http://wendellmoore.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );	
	
	return $startlist; 
    
    }

    /** 
     *
     * 
     *
     */ 
    public function existingurlcall()
    {
	// googlereader, yahoo, bloglines, others?
	// data aggregators,  datasift, kinetics(dundee)
    
    }
    
     /** 
     *
     * 
     *
     */ 
    public function  autocrawlblogs()
    {
	// need to put crawl into a class
      
    
    }   

    /** 
     *
     * 
     *
     */ 
    public function ptopnetworkeffect()
    {
	// need to investigate telehash project code/service
	
    
    }

    /** 
     *
     * 
     *
     */ 
    public function setContext()
    {
    
      $livecontext['startAPI'] = $this->startAPI;
      $livecontext['lifestylepath'] = $this->lifestylepath;
      $livecontext['individual'] = $this->individual;
      $livecontext['identitydefintion'] = $this->identitydefintion;
      $livecontext['identitysource'] = $this->identitysource;
      $livecontext['lifestylemenuset'] = $this->ldmenu;
      
      return $livecontext;
      
      }
   
  
 }
 // closes class
 
 ?>