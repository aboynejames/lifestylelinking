<?php

class LLframeworkmanager
{
  // overall management of the framework    apis, datachecking, core, display, testing, experimentation  
  // handles input of data third party (could be via node.js loop).
  // forms inputs order into LLcore and identifies inputs
  //  we need to know 1. data state, string, array, tidy undity. 2. is it definition or post words 3.  how many of each 10 blog posts and 3 wikipedia definition
  
		protected $frameworkSetup; // install or default settings for framework
    
    
   public function __construct($inputSetup)
		{
			$this->frameworkSetup = $inputSetup;
 		} 
    

      //  co ordinates apis plugin that feed data in and out of the whole framework  (installed feedreader, wikipedia api or pluged in as a service? will know from install.)
     		public function apiStatus()
		{
			// uses  llapi class include api classes or plug into third party servies 
      $apinew = new apimanagement($this->frameworkSetup);
      
      }
     
      
  
      // Start.  First time use, update use?
        public function indentityStatus()
		{
			// identity of Framework
      // identity of definition
      // identity of content
      
      
      }

    // tag identity  and definition (input stats about content/definitions, first time or update)  probably done as a result of def and identity content input process
      public function identityControl()
		{
      // to be used by definition and indentity content
      // pair up e.g. wikipedia api to definition id (where possible RDF URI dpedia in this case
      // pair content to api in e.g. feedreader, that will produce id but will be unique to each installation, need convert to RFD or identity service or build parser to match same identity

 
  
      // or special case  starting defintions from wikipedia,  built in api or  as a service (from somewhere, mepath might provide)
      public function definitionControl()
		{
			// 1st core data - extract input definition(s)  kick to life api manager->wikipedia class -> form array of data captured, identity, structure stats, the raw text split
      // read in test text.
      $newdef = new LLdefinitions;
      //$newdef->defwikiword = 'skiing';
      
     // one or more defintions?
     foreach (   as $indef)
     {
      // identifies definition, assign identity, first time or update  
      $newdef->definitionManager();
      
      $newdef->definitionWord($indef);
      $newdef->buildDefinitions();
      //print_r($newdef);
      //echo '<br /><br />';
      } // closes foreach loop



     }
   
  
    
   
      public function contentControl()
		{
    // where is the data coming from?
    // e.g. rss feedreader built in,  pubhubsubdub/cloudrss  or as a service for updates  ie. superfeeder

      // 2nd core data - extract input content   api manager identifies type e.g. rss blog -> feedreader -> raw data obtained.
      $inputdata[] = file_get_contents('C:\apache\htdocs\llcore\text\skiing.txt');
      //echo $inputdata;
      
      $newdata = new LLcontent(); 
      // new content to be processed?
      foreach($inputdata as $indata)
      {
      
      $newdata->contentData($indata);
      $newdata->buildContent();
      
      }
      //print_r($newdata);
    }

    // start LLcore from here?

 
}  // closes class