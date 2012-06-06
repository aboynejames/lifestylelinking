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
class LLapidataDisplay 
{

	// handles connection between context
    
    
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
	public function __construct($meidentity, $lifestyleword, $lifestylemenu, $path, $resultsdata, $baseurl, $resultlinking)
	{
//echo 'intodisplayapi';
//print_r($resultsdata);
	$this->livemeidentity = $meidentity;
	$this->livelifestyleword = $lifestyleword;
	$this->livelifestylemenu = $lifestylemenu;
	$this->livepath = $path;
	$this->livebaseurl = $baseurl;
	$this->liveresultlinking = $resultlinking;
	$this->resrawcontent = $resultsdata;


	$this->apidatadisplayManager();
         
	} 
    
    /**  manages building of a webpage or formatted data segment
     *
     * 
     *
     */ 
    public function apidatadisplayManager()
    {
  
    //include('display/index.php');
  
    $this->displayNavigation();
    $this->displaySections();
    
    }

    /**  navigation
     *
     * 
     *
     */ 
    public function displayNavigation()
    {

     // pull together head html, css templete, rdf link etc
     $buildheader = new LLNavigation($this->livelifestyleword, $this->livelifestylemenu, $this->livepath, $this->livebaseurl, $this->liveresultlinking);
      
    }

    /**  builds sections
     *
     * 
     *
     */ 
    public function displaySections()
    {
     // displays the footer
    $buildfooter = new LLSections($this->livelifestyleword, $this->resrawcontent, $contextfilter, $startpathtime, $endpathtime);
      
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