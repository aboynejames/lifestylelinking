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
		
      //$this->resultspath = $resultspath; 
      //$this->frameworkSetup = $inputSetup;
      //$this->individual = $individual;
      //$this->lifestyle = $iddefinition;
      //$this->identitysource = $idsources;
      
      $LLstart = new LLcontext();
      print_r($LLstart);
      $this->individual = $LLstart->individual;
      
      $this->meidentity = $this->identityControl();
      $this->assumptionsSet();
      $this->intentionManager($LLstart->resultspath, $LLstart->identitydefintion, $LLstart->identitysource);
   
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
      $apinew = new apimanagement($LLstart->api);
      
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
       //  what is the path telling the framework, results required, daily update or change of def scoring of LifestyleLinking logic?
        // create intentionlogic  which will release logic to results, definitions and content sources?

      //  start results path class
        //$pathnew = new LLpath($path);
        
                // process the new lifestyle  1.  load/add defintition, 2. sources of content if a. none, promt to add (1.manual input, 2. input rssfeeder e.g. google, yahoo via api, 3. autocrawl, 4. rdf peertopeer ), 3. load and ready data for results, 4. raw results, 5 display theme selected/location for data
        // first stage is to see if info. from universe needs updated before results (if framework data exists, process that while update is going on ie. upload all relevant data to memeory if not already in and prep. peer lists based on LifestyleLinking Logic)
                  
         if($path['intention'] == 'newstart')
         {
echo 'newstart  intention manager has been called';
         //  from start page UI
         $this->definitionControl($path['intention'], $definition);  //  intention, iLLlogic,     
          
          // content
         $this->contentControl($path['intention'], $sourcecontent);
         
         // feed core
         //$this->controlCore($newdef->wiseDefinition, $newdata->wiseContent);  
         
         // make results
         //$resultspath = new LLResults($this->meidentity, $newdef->$loaddefinitions, $path['logic'], $path['time'], $path['filter']);
         
         // given user display selection (could be to export via api or display in their framework 
         //$displayPath = new LLDisplay($this->meidentity,  $currentlifestyle = 'swimming', $newdef->$loaddefinitions, $path['display'], $resultspath->wheretofindtheresultsdata);
         
         }
       
         elseif($path['intention'] == 'results')
         {
         
         // pickup lifestlye definition and then decide a. produce results immediately or to up sources of content based on intent e.g. if real time wanted.
         
         }
        
        elseif($path['intention'] == 'controlpanel')
         {
                  
          //  control panel being used to personalized setting or control updates, sources, definitions, api's themes etc.
          
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
print_r($newdef);
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
print_r($newdata);
    }

    /** Control the data going into LLcore
     *
     * Fed into core on a per content sources basis (and as many definitions that need scoring)
     * 
     */
      public function controlCore($sid, $defsforcore)
		{
      global $llnew;
   
      $llnew = new LLCore($this->defSet, $this->contSet[$sid]);
      $llnew->sourcecontent($this->defSet, $this->contSet[$sid]);
      //  time to enter the matrix
      $llnew->LLcoremanager($sid, $defsforcore);
    
      //print_r($llnew);
      // import input context instance, ie results window  output make the future.
      
      
      // from raw data feed json or rdf php array (see easy rdf code look at using)

    }
 
 
}  // closes class