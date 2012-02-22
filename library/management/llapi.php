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
class LLapi
{
  
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
      protected $livedefid; 
      
     // const GLOBAL_URL = 'mepath.com';
      public $baseurl;
      
      
    /**
     * Constructor 
     *
     * Setup of new or existing API Framework settings 
     *
     * Data input from the UI
     *
     * @param 
     *
     */
    public function __construct()
   {
   
	
		      
      $LLstart = new LLcontext();
      $livecontext = $LLstart->setContext();
//print_r($livecontext);
      $this->individual = $livecontext['individual'];
      $this->lifestylemenu = $livecontext['lifestylemenuset'];
      
      //$this->meidentity = $this->identityControl();
      $this->assumptionsSet();
      $this->intentionManager($livecontext['lifestylepath'], $livecontext['identitydefintion'], $livecontext['identitysource']);
   
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
    
    /** load in current experimentation assumptions
     *
     * The default assumption active in the frawework
     *
     */ 
      public function assumptionsSet()
      {
      global $aset;
      // uses llapi class include api classes or plug into third party servies
      $aset = new LLassumptions();
      
      // pass the lifestylelinking science
      //$aset->LLlogic($this->frameworkSetup['science']);
      
      //$aset->loadAssumptions();

      //$this->intentionlogic = $aset->loadAssumptions();
 
        // active the appropriate apis local or from the web
        $this->apiStatus();
        
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

    /** Establish the starting indienty of definitions and content sources
     *
     * setup resultpath object, definition object, content objects and get all data in universe upto date and pass that to core in priority of resultspath (process per source, this source list will be prioritised by the LLlogic that is this individuals science for this framework
     * What has already but processed by core?  What need to go into LLcore?
     *
     */
      public function intentionManager($path, $definition, $sourcecontent)
      {
      
      // this is a heavy duty function and needs to be split to achieve these goals
      // a identify what definition is live or  is it new start, newly added or updated?
      // b identify which range of sources are prioritised?  new start, update, rescore, how many sources to update, add or rescore?
      // c handle management of data flows ie. api call to wikipedia, rssfeeds (blog source to rssfeedreader via api), ptopLL sharing.
      
       //  what is the path telling the framework, results required, daily update or change of def scoring of LifestyleLinking logic?
        // create intentionlogic  which will release logic to results, definitions and content sources?
	
	// first decide what prioritises are and share that will data flows, core processing
        //  start results path class
        //$pathnew = new LLpath($path);
        
        // context class will provide information on  1.  load/add defintition, 2. sources of content if a. none, promt to add (1.manual input, 2. input rssfeeder e.g. google, yahoo via api, 3. autocrawl, 4. rdf peertopeer ), 3. load and ready data for results, 4. raw results, 5 display theme selected/location for data
        
                  
         if($path['intention'] == 'newstart')
         {
         // in this mode one definition needs displayed, if results not ready for this then apply LL to produce all neccessary data to display results as quickly as possible
	//echo 'newstart  intention manager has been called';
	//print_r($definition);
	
	//  this needs to decide if first use, new added, or updated and the priority of processing through framework ie. user directed or background auto-update?  
         $this->definitionControl($path['intention'], $definition);  //  intention, iLLlogic,     
          
          // content, prioritises which sources to add or update, set initial reach limit and keep going and update when new top ranking are found.
	  // first stage is to see if info. from universe needs updated before results (if framework data exists, process that while update is going on ie. upload all relevant data to memeory if not already in and prep. peer lists based on LifestyleLinking Logic)
         $this->contentControl($path['intention'], $sourcecontent);
         
	 //  constantly updating from local framework or ptop shared averages
         //$this->controlAverages($this->livedefinition);
         
         // feed core, manages the priority and background process of whole universe
         if(isset($this->livesource) && isset($this->livedefinition))
         {
         $this->controlCore($this->livesource, $this->livedefinition);  
         }
	 
         // make display data/presentation code for results, 
         $resultspath = new LLResults($this->meidentity, $this->livedefinition, $path, $this->livelistsource, $this->avgofavg, $this->livecorematrix);
//print_r($resultspath);      
         $resultsdata = $resultspath->liveResultsdata();
         $resultlinking = $resultspath->setdefinitionpathresults();
         
         // given user display selection (could be to export via api or display in their framework 
         $apidisplayPath = new LLapidataDisplay($this->meidentity, $this->lifestyleword, $this->lifestylemenu, $path, $resultsdata, $this->baseurl, $resultlinking);
//echo 'displayobject';
//print_r($apidisplayPath); 

  
         }
       
         elseif($path['intention'] == 'results')
         {
         
         // pickup lifestlye definition and then decide a. produce results immediately or to up sources of content based on intent e.g. if real time wanted.
        
         // first need to see if any content in the universe has been updated and needs to be scored for this lifestyle definition selected?
         // set live definition id
         $this->livedefinition = 2;
           
          // make results
        $resultspath = new LLResults($this->meidentity, $this->livedefinition, $path, $this->livelistsource, $this->avgofavg);
//print_r($resultspath);      
         $resultsdata = $resultspath->liveResultsdata();
         $resultlinking = $resultspath->setdefinitionpathresults();
         
         // given user display selection (could be to export via api or display in their framework 
         $apidisplayPath = new LLapidataDisplay($this->meidentity, $this->lifestyleword, $this->lifestylemenu, $path, $resultsdata, $this->baseurl, $resultlinking);
//echo 'displayobject';
//print_r($apidisplayPath); 
          }
        
        elseif($path['intention'] == 'controlpanel')
         {
          // batch updating via control panel or CRON,  need to pickup all definitions and all sources (figure out what is not up to date and update those needing)
          //  control panel being used to personalized setting or control updates, sources, definitions, api's themes etc.
	  
	  // and ll variable is set   double check the lifestyle definition has not been entered before then, add the definition,  score against existing sources content and produce resutls
//echo 'controlpanel adddddddddddd';
	//  this needs to decide if first use, new added, or updated and the priority of processing through framework ie. user directed or background auto-update?  
         $this->definitionControl($path['intention'], $definition);  //  intention, iLLlogic,     	  
	  
	  // next need to put live content source data into live memory and get the content for Core from couchDB
	$client = new couchClient ('http://localhost:5984','lifestylelinking');

	$result = $client->asArray()->getView('livesource','by_livesource');
echo 'livesource controlpannnnnel';
print_r($result[rows][0][key]);
	 $this->livesource = $result[rows][0][key]; 
	  
	  
	  
                   // feed core, manages the priority and background process of whole universe
         if(isset($this->livesource) && isset($this->livedefinition))
         {
echo 'controlpanelcore';	 
         $this->controlCore($this->livesource, $this->livedefinition);  
         }
	 
         // make display data/presentation code for results, 
         $resultspath = new LLResults($this->meidentity, $this->livedefinition, $path, $this->livelistsource, $this->avgofavg, $this->livecorematrix);
//print_r($resultspath);      
         $resultsdata = $resultspath->liveResultsdata();
         $resultlinking = $resultspath->setdefinitionpathresults();
         
         // given user display selection (could be to export via api or display in their framework 
         $apidisplayPath = new LLapidataDisplay($this->meidentity, $this->lifestyleword, $this->lifestylemenu, $path, $resultsdata, $this->baseurl, $resultlinking);
//echo 'displayobject';
//print_r($apidisplayPath); 
         }
         
      

      }
      
      
      
      
     /** Controls creating a new lifestyle Definition 
     *
     * After adding markup is clean from the defintion words 
     *
     */
      public function definitionControl($intention, $indefinition)
     {
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      $newdef = new LLdefinitions($intention, $indefinition);
      
      $defdatalive = $newdef->returnDefinition();
      $this->livedefinition =  $defdatalive['livedefinition'];
      $this->livedefid = $defdatalive['livedefid'];
      $this->lifestyleword = $defdatalive['lifestyleword'];
      //$this->lifestylemenu = $defdatalive['lifestylemenu'];
echo 'definitionobject';
print_r($this->lifestyleword);
     }
   
     
    /** Controls adding new content sources to the Framework
     *
     * After adding mark up is clean from source content words
     *
     */ 
      public function contentControl($intention, $source)
     {
    // where is the data coming from?
      $newdata = new LLcontent($intention, $source); 

//echo 'extract individual sources';
//print_r($newdata->existsource);
//echo 'livesource any content array';
      $this->livesource = $newdata-> wiseContentlive();
//print_r($this->livesource);
     // $this->livelistsource = $newdata->loadcontent;
     
     // store livescore to couchdb  as temp. while figure out how to hold in memory
	$this->couchconnect =  'lifestylelinking';
	$this->couch_dsn = "http://localhost:5984/";
   
	$JSONlivesource['livesourcesaved'] =  $this->livesource;
   
	// may need to form JSON array first or do it a couchdb class
	$couchdocset = new LLcouchdb($this->couch_dsn, $this->couchconnect, $JSONlivesource);	
	$couchdocset->saveCOUCHdoc();
     
     
    }

    /** Control the data going into LLcore
     *
     * Fed into core on a per content sources basis (and as many definitions that need scoring)
     * 
     */
      public function controlCore($livesourcecontent, $livedef)
     {
//echo 'core called with this source content';
//print_r($livesourcecontent);
//echo ' any content???';
//print_r($livedef);
//echo 'any def data';
      // idea here is to release the content sources and defintiions that are need to get results as quick as possible.  Do that work here then subsequent classes just process  
      $llnew = new LLCore($livesourcecontent, $livedef);

      // import input context instance, ie results window  output make the future.
      $this->livecorematrix =  $llnew->saveSource();
      
      // from raw data feed json or rdf php array (see easy rdf code look at using)

    }
 
 
     /** 
     *
     * 
     * 
     */
      public function controlAverages($setdefinition)
     {

      // manages the average of average calculations (or updated within core if that path chosen) 
      // extract the definition id number      
      //$defenitionid = key($setdefinition);
      
      $newavgs = new LLavgOfavg($setdefinition);  // need to load all existing avg. data, do this here our within LLavgOfavg class? 
      $this->avgofavg = $newavgs->avgOFavgsComplete();
//print_r($newavgs);
    }




    /**
     * Constructor * 
     *
     * 
     *
     */
/*    public function __construct()
		{
    echo 'LLapi  called and active';
    
    include 'api/index.php';
    $this->aipmanager();
    
    }
    
    /**
     *
     *
     *
     */
    public function aipManager()
   {



      $this->displayNavigation();
      $this->displaySections();
      
                
                
    }


    /**  builds navigation
     *
     * 
     *
     */ 
    public function displayNavigation()
    {
     // lifestyle menu
    $buildnavigation = new LLNavigation($this->selectedlifestyle, $this->lifemenu, $this->resultpathset, $this->sitedomain, $this->resultlinking);
      
    }

    /**  builds sections
     *
     * 
     *
     */ 
    public function displaySections()
    {
     // what needs to displayed  blog posts, images, video, other formats of content
      $buildsections= new LLsections($this->selectedlifestyle, $this->resultsdata, $this->contextfilter, $this->startpathtime, $this->endpathtime);
      
    }


    


}  // closes class



?>