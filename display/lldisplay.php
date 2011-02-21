<?php
/**
 * LifestyleLinking
 *
 * Takes raw data and make it available to display anywhere on the web
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Handles all display for the framework
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
	class LLDisplay 
	{

	// handles connection between context
	// build menus and navigition
  // presentation templates
  // themes
  // context ll, definitions, time, media, display, device, portability
    protected $buildheader;
    protected $buildnavigation;
    protected $buildsections;
    protected $buildfooter;    
    protected $displaycontext;
    protected $resultsurlstring;
    protected $resultpathset;
    
    
    /**
     * Constructor 
     *
     * Default intention settings 
     *
     * Data input from the UI
     *
     * @param 
     *
     */
    public function __construct($meidentity,  $currentlifestyle, $lifestylemenu, $pathset, $resultspathdata, $siteurl, $resultlinking)
		{
		
    $this->identity = $meidentity;
    $this->selectedlifestyle = $currentlifestyle;
    $this->lifemenu = $lifestylemenu;
    $this->resultpathset = $pathset;
    $this->diplaymedia = $pathset['display'];
    $this->contextfilter = $pathset['filter'];
    $this->startpathtime = $pathset['starttime'];
    $this->pathperiod = $pathset['timebatch'];
    $this->endpathtime = $this->startpathtime - $this->pathperiod;
    $this->resultsdata = $resultspathdata;
    $this->resultsurlstring = $pathset['pathurlstring']; 
    $this->resultsurlstring = $pathset['pathscript']; 
    $this->resultsurlstring = $pathset['pathid']; 
    $this->sitedomain = $siteurl;
    $this->resultlinking = $resultlinking;
    
    $this->displayManager();
      
   
 		} 
    
    /**  manages building of a webpage or formatted data segment
     *
     * 
     *
     */ 
    public function displayManager()
    {
  
    $this->displayHeader();
    $this->displayNavigation();
    $this->displaySections();
    $this->displayFooter();
    //$this->publish();
    
    }

    /**  builds header
     *
     * 
     *
     */ 
    public function displayHeader()
    {

     // pull together head html, css templete, rdf link etc
     $buildheader = new LLHeader();
      
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

    /**  builds footer
     *
     * 
     *
     */ 
    public function displayFooter()
    {
     // displays the footer
    $buildfooter = new LLFooter();
      
    }
    

    /**  where webpage is published
     *
     * 
     *
     */ 
    public function publish()
    {
     // include the start index.php display for (eventually different templates will have different starting positions
     //require_once "display/index.php";
          
    }

    /**  
     *  make absolute urls
     * 
     *
     */ 
    public function makesiteurl($relurl)
    {
     // form url from base and context
     $buildurl = $newframework->baseurl.$relurl;
     
     return $buildurl;
          
    }

    /**  
     *  make results absolute urls
     * 
     *
     */ 
    public function resultsurl($relurl)
    {
     // form url from base and context
     $buildurl = $newframework->baseurl.$relurl;
     
     return $buildurl;
          
    }


	}  // closes class
?>