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
 
        public $resultspath;
        public $individual;
        public $displayPath;
        public $startAPI;

        public $identitydefintion;
        public $identitysource;
  
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
        
        // this should get text input that is converted to a wikipedia definition or via control panel input
        // also picks up LL logic, display preferences (probably in automode as default  Q. whatis automode/default settings?)
        $lifestyleinput['wikipediaword'] = $_GET['ll'];
        $lifestyleinput['LLlogic'] = $_GET['logic'];
        $lifestyleinput['intention'] = $_GET['intention'];
        // could be more than one dispaly sections
        $lifestyleinput['display'] = $_GET['display'];
        $lifestyleinput['timebatch'] = $_GET['time'];
        $lifestyleinput['make'] = $_GET['make'];
        $lifestyleinput['filter'] = $_GET['filter'];
        // set starting context
   
        $this->resultspath = $this->startPath($lifestyleinput);
        $this->individual = $this->startIndividual();
        $this->identitydefintion = $this->startLifestyle($lifestyleinput['wikipediaword']);
        $this->identitysource = $this->startInfoUniverse(); 
       
       }
       
       else
       {
       // dispay start UI
       $this->displayPath = new LLDisplay($meidentity, $currentlifestyle, $lifestylemenu, $displayrequired, $resultsdata);
//echo 'echo start display';
       }
       

        
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
      
        $timestamp = microtime(true);
         
        $startresultspath['intention'] = $intentioninput['intention'];
        $startresultspath['logic'] = $intentioninput['LLlogic'];
        $startresultspath['starttime'] = $timestamp;
        $startresultspath['timebatch'] = $intentioninput['timebatch'];
        $startresultspath['media'] = $intentioninput['display'];
        $startresultspath['make'] = $intentioninput['make'];
        $startresultspath['filter'] = $intentioninput['filter'];        
        // set starting context
        return $startresultspath;
        
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
      // if lifestyle menus saved or new lifestyle being added
        $startidentitydefintion = $uiinput;
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
      public function startInfoUniverse()
      {
      
        $startidentitysource = '';
        //$startidentitysource =array('url'=>'http://www.aboynejames.co.uk/wordpress', 'rss'=>'http://www.aboynejames.co.uk/wordpress/feed/', 'rdf'=>'', 'sourceid'=>'' );
       //$startidentitysource =array('url'=>'http://lifestylelinking.blogspot.com', 'rss'=>'http://lifestylelinking.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );//, '     2'=>'http://lifestylelinking.blogspot.com'); //, '1'=>'2');
        //$startidentitysource =array('url'=>'http://aboynejames.blogspot.com', 'rss'=>'http://aboynejames.blogspot.com/feeds/posts/default', 'rdf'=>'', 'sourceid'=>'' );
        // set starting context
        return $startidentitysource;
        
      }   

    /** 
     *
     * 
     *
     */ 
      public function startInstallation()
      {
      
      //first time install
    $newinstall = new LLinstallation(); 
      
   
        
      }   
   
   
   
   
 }
 // closes class
 
 
 
 
 
 
 
 
 
 ?>