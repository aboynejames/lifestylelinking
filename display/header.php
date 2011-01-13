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
	class LLHeader
	{
  
    public $header;
  
        /**
     * Constructor 
     *
     *  // 
     *
     * 
     *
     * @param  
     *
     */
   public function __construct()
		{

    $header= $this->startHeader();
     
 		} 
    
    
      /**
         * Build header logic for display page
         *
         * 
         */
        public function startHeader ()
        {
         //stitches together all header functions
        $headerparts = $this->headertitle();
        $headerparts .= $this->stylesheet($template = 'default');
        $headerparts .= $this->headeridfix();

        //return $headerparts;

        }

        /**
         * Build header logic for display page
         *
         * 
         */
        public function headertitle ()
        {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8" />
        <title>lifestylelinking - open source project</title>
        
  <?php
        }
        
        /**
         * Build header logic for display page
         *
         * 
         */
        public function headeridfix ()
        {
?>
            <!--[if IE]>
              <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
            <!--[if lte IE 7]>
              <script src="js/IE8.js" type="text/javascript"></script><![endif]-->
            <!--[if lt IE 7]>

              <link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
            </head>
            
            <body id="index" class="home">
  <?php
        }
  
        /** Stylesheet selector
         * 
         *
         * 
         */
        public function stylesheet($template)
        {
        
            if($template == 'default')
            {
            $style = '<link rel="stylesheet" href="display/css/main.css" type="text/css" />';
            
            }
            else
            {
            // load template selected
            }
        
            echo $style;
            
        }
        
       /** RDF url link
         * 
         *
         * 
         */
        public function RDFlink()
        {
        
            if($template == 'default')
            {
            $rdf = '<link rel="alternate" type="application/rdf+xml" href="" />';
            
            }
            else
            {
            // load template selected
            }
        
            //echo $rdf;
            
        }

} // closes class
        ?>