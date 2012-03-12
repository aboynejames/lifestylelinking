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
	$this->setcouchdblivesource();
	$this->setcouchdbpostdate ();
	$this->setcouchdbnormalized();
	
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
     *  Create standard livesource view
     * 
     *
     */ 
    public function setcouchdblivesource ()
    {
    
	 $couchset = new LLcouchdb($this->couch_dsn, $this->couch_db, $data = null);
	$setlivesource = "function(doc) {
	if(doc.livesourcesaved)
{

  emit(doc.livesourcesaved, null);

}
}
		";

		$view_fn= $setlivesource;
		$design_doc->_id = '_design/livesource';
		$design_doc->language = 'javascript';
		$design_doc->views = array ( 'by_livesource'=> array ('map' => $view_fn ) );
		$couchset->storeDoc($design_doc);

    }  


    /** 
     *  Create standard blog post date view
     * 
     *
     */ 
    public function setcouchdbpostdate ()
    {
    
	 $couchset = new LLcouchdb($this->couch_dsn, $this->couch_db, $data = null);
	$setpostdate = "function(doc) {
	if(doc.source['posts'] )
	{


		 for ( var index in doc.source['posts'] )
		 {
			emit(doc.source['posts'][index]['authordate'],[doc.source['link'], index]);
		 }


	}

}
		";
		 
		$view_fn= $setpostdate;
		$design_doc->_id = '_design/postdate';
		$design_doc->language = 'javascript';
		$design_doc->views = array ( 'by_postdate'=> array ('map' => $view_fn ) );
		$couchset->storeDoc($design_doc);
	
    }  


    /** 
     *  Create standard  view
     * 
     *
     */ 
    public function setcouchdbnormalized ()
    {
    
	 $couchset = new LLcouchdb($this->couch_dsn, $this->couch_db, $data = null);
	$setnormalized = "function(doc) {
	if(doc.matrixstats['normalized'] )
	{

	emit(doc.matrixstats['normalized'], null);

	}

}
		";
		 
		$view_fn= $setnormalized;
		$design_doc->_id = '_design/normalized';
		$design_doc->language = 'javascript';
		$design_doc->views = array ( 'by_normalized'=> array ('map' => $view_fn ) );
		$couchset->storeDoc($design_doc);

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