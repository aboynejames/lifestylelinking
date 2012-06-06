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
    public function __construct()
		{
		
    $this->displayManager();
      
   
 		} 
    
    /**  manages building of a webpage or formatted data segment
     *
     * 
     *
     */ 
    public function displayManager()
    {

    include('display/index.php');
  

    
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