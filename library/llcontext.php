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
        $startresultspath['resultsid'] = $intentioninput['resultsid'];;
        
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
        
        //$startidentitysource = '';
        //$startidentitysource =array('url'=>$psourceurl, 'rss'=>'http://www.aboynejames.co.uk/wordpress/feed/', 'rdf'=>'', 'sourceid'=>'' );
      //$startidentitysource =array('url'=>$psourceurl, 'rss'=>'http://lifestylelinking.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );//, '     2'=>'http://lifestylelinking.blogspot.com'); //, '1'=>'2');
        $startidentitysource =array('url'=>$psourceurl, 'rss'=>'', 'rdf'=>'', 'sourceid'=>'' );
        // set starting context
        return $startidentitysource;
        
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
      
      return $livecontext;
      
      }
   
  
 }
 // closes class
 
 ?>