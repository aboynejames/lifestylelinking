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
    public function __construct($pathcontext)
		{
		
    $this->displaycontext = $pathcontext;
    
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
    $buildnavigation = new LLNavigation($this->displaycontex['']);
      
    }

    /**  builds sections
     *
     * 
     *
     */ 
    public function displaySections()
    {
     // what needs to displayed  blog posts, images, video, other formats of content
      $buildsections= new LLsections();
      
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

	}  // closes class
?>