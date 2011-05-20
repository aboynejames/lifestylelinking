<?php
    $buildfooter = new LLFooter();
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
	class LLFooter
	{
    
    public $footer;
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
		
    $footer = $this->buildfooter();
    
 		} 

    /**
     *
     *
     *
     */
    public function buildfooter()
    {
    
    $footerparts = $this->footer();
    
    return $footerparts;
    
    }

    /**
     *
     *
     *
     */
    public function footer()
    {
?>
    <footer id="contentinfo" class="body">
      <p>2005-2010 <a href="">lifestylelinking - open source project</a>.</p>
    </footer><!-- /#contentinfo -->
    
    </body>
    </html>
    
     <div id="hmt"></div>
     <div id="hmtt"></div>
<?php
    }


} // closes class

?>