<?php
/**
 * LifestyleLinking
 *
 * Use this file to store, save, update, import data from couchDB
 *
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version    $Id$
 */

/**
 * Class for managing couchDB.
 *
 * @package    LifestyleLinking Open Source Project
 * @copyright  Copyright (c) 2010 James Littlejohn
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class LLcouchdb
{
  // overall management of couchdb
     
     protected $client;
     protected $lldata;
     
	/**
	* Constructor 
	*
	* couchdb
	*
	* Data
	*
	* @param  int       *
	*/
	public function __construct($couch_dsn, $couch_db, $lldatain)
	{

	$this->lldata = $lldatain;
	$this->client = new couchClient($couch_dsn, $couch_db);
//echo 'from within couchclass'.$this->lldata;
	} 
    
    
	/**
	*  if first time use setup the couchdb database
	* 
	*
	*/
	public function checkDBsetup ()
	{    
	
	 $setupdb = $this->client->databaseExists();
		if($setupdb == 1)
		{
		// already setup
		
		}
		else
		{
			
		$this->client->createCOUCHdatabase();
		
		}
	    
    
	}
    
    
	/**
	*  if first time use setup the couchdb database
	* 
	*
	*/
	public function createCOUCHdatabase()
	{

	echo "#### Creating database ".$this->client->getDatabaseUri().': $result = $client->createDatabase();'."\n";
	try 
	{
	$result = $this->client->createDatabase();
	}
	catch (Exception $e)
	{
		if ( $e instanceof couchException )
		{
			echo "We issued the request, but couch server returned an error.\n";
			echo "We can have HTTP Status code returned by couchDB using \$e->getCode() : ". $e->getCode()."\n";
			echo "We can have error message returned by couchDB using \$e->getMessage() : ". $e->getMessage()."\n";
			echo "Finally, we can have CouchDB's complete response body using \$e->getBody() : ". print_r($e->getBody(),true)."\n";
			echo "Are you sure that your CouchDB server is at $couch_dsn, and that database $couch_db does not exist ?\n";
			exit (1);
		}
		else 
		{
			echo "It seems that something wrong happened. You can have more details using :\n";
			echo "the exception class with get_class(\$e) : ".get_class($e)."\n";
			echo "the exception error code with \$e->getCode() : ".$e->getCode()."\n";
			echo "the exception error message with \$e->getMessage() : ".$e->getMessage()."\n";
			exit (1);
		}
	}
//	echo "Database successfully created. CouchDB sent the response :".print_r($result,true)."\n";


      
	}


	/**
	*
	* 
	*
	*/
	public function saveCOUCHdoc ()
	{
	
	 $docstore = new couchDocument($this->client);
	
		try
		{
		$docstore->set($this->lldata);

		}
		catch (Exception $e)
		{
		exit (1);
		}
      
	}

   
 
}  // closes class