<?php
/**
 * LifestyleLinking
 *
 * Installatio of the LL framework
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Check environment setup and install logic
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */	
class LLinstallation
{
	
    protected $websitesettings;
   
   
    /**
     * Constructor 
     *
     *  
     *
     */
   public function __construct()
		{
    
    $this->setbaseurl();
    
    }
    
    /** 
     *
     * 
     *
     */ 
    public function setbaseurl()
    {
    
    	$this->websitesettings['baseurl'] = 'http://'.$_SERVER['HTTP_HOST'];

      
        
    }  
      
    /** 
     *
     * 
     *
     */ 
    public function websiteset() 
    {
    
      return $this->websitesettings;
    
    }
    
    
      
     
      
      
}

?>