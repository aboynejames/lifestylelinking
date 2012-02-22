<?php
/**
 * LifestyleLinking
 *
 * Use this file to load the LifestyleLinking Framework.
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Framework for managing the whole LifestyleLinking experience.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class LLframeworkmanager
{
  // overall management of the framework    apis, datachecking, core, display, testing, experimentation  
  // handles input of data third party (could be via node.js loop).
  // forms inputs order into LLcore and identifies inputs
  //  we need to know 1. data state, string, array, tidy undity. 2. is it definition or post words 3.  how many of each 10 blog posts and 3 wikipedia definition
  
    //protected $resultspath; 
    //protected $frameworkSetup; // install or default settings for framework
      protected $individual;
   // protected $identitysource;
    //protected $lifestyle;  // input from individual
      protected $meidentity;
      protected $livesource;
      protected $livedefinition;
      protected $livelistsource;
      protected $avgofavg;
      protected $lifestyleword;
      protected $sitesetup;
      
     // const GLOBAL_URL = 'mepath.com';
      public $baseurl;
      public $couchconnect;
      public $couch_dsn;
      
    /**
     * Constructor 
     *
     * Setup of new or existing Framework settings 
     *
     * Data input from the UI
     *
     * @param  int  $individual    owner of frameworks id
     *
     */
	public function __construct()
	{
		
	// has the couchdb database been setup?
       if(!isset($this->couchconnect))
        {
	
	$this->couchconnect =  'lifestylelinking';
	$this->couch_dsn = "http://localhost:5984/";
	
	}
 
      if(!isset($this->baseurl))
      {
//echo 'install again';
      $LLinstall = new LLinstallation( $this->couch_dsn, $this->couchconnect); 
      $this->sitesetup = $LLinstall->websiteset();
      $this->baseurl = $this->sitesetup['baseurl'];
      
      
      }
      

      
            //$this->meidentity = $this->identityControl();
      
         $display = new LLDisplay();

   
 		} 
    
    /** Tag identity  and definition (input stats about content/definitions, first time or update)  probably done as a result of def and identity content input process
     *
     *
     */
      public function identityControl()
      {
      // what personalization can we apply based upon indentity ie. has the user added a blog that they own/ are self link themselves too? (will require UI/controlpanel input)
  
           if($this->individual == 'average' )
           {
            
            $meframeworkid = 'average';
           // then unidentified user
           return $meframeworkid;
           
           }
          
          else
          {
          // user has added a blog,  link that blog to a source id in context of this framework  (more challenging when using import rdf peertopeer data, there number id will be different so need to parse  FOAF or url  TODO need to find a way to allocated blogid to each framework and keep sync)
          $meframeworkid = array("frameid"=>123, "blog"=>"theblogupdated or rdf, FOAF, openid or FBconnect or opensocial etc more the better e.g delicious account, twitter, linkedin, quora, flickr etc etc.");
          
          return $meframeworkid;
          
          }
          
     
      }
    

      
    /** Co ordinates apis plugin that feed data in and out of the whole framework  
     *
     * (installed feedreader, wikipedia api or pluged in as a service? will know from install.)
     *
     */
      public function apiStatus()
      {
			// uses  llapi class include api classes or plug into third party servies 
      //$apinew = new LLapi();
      
      // any RDF linking established?   if so establish connection
      $rdfconnect = new LLrdf();
      
      }



}  // closes class