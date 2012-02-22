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
  protected $couch_dsn;
  protected $couch_db;
   
    /**
     * Constructor 
     *
     *  
     *
     */
	public function __construct($incouch_dsn, $incouch_db)
	{
    
	$this->couch_dsn = $incouch_dsn;
	$this->couch_db = $incouch_db;
	
	$this->setbaseurl();
	$this->setcouchdb();
    
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
     *  Create couchdb database if first time use
     * 
     *
     */ 
    public function setcouchdb ()
    {
    
	 $couchset = new LLcouchdb($this->couch_dsn, $this->couch_db, $data = null);
	//$couchset->createCOUCHdatabase();
        $this->websitesettings['couchdb'] = $this->couch_db;
	
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