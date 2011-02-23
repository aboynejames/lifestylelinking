<?php
class site
{
	protected static $sCWD = '';
	protected static $sTemplateDir = '';
	protected static $bIsAjax = false;

	protected static $bIsInit = false;

	/**
	 * Constructor - not to be used, this class is static
	 *
	 * @access public
	 * @static
	 * @throws Exception
	 * @return void
	 */
	public function __construct()
	{
		throw new Exception(__CLASS__ . ' illegally instantiated.  This class is for static use only.');
	}
	
	/**
	 * Initialize properties
	 *
	 * @access protected
	 * @static
	 * @return void
	 */
	protected static function init()
	{
		if( ! self::$bIsInit)
		{
			self::$sCWD = realpath(dirname(__FILE__));
      //self::$sCWD = 'library';
    //  echo 'site page';
      //echo self::$sCWD;
		self::$sTemplateDir = realpath(self::$sCWD . '/../display');
     // self::$sTemplateDir =  'display';
    // echo 'temdir';
     // echo self::$sTemplateDir;
			self::$bIsAjax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
//echo self::$bIsAjax.'anynumber';
			self::$bIsInit = true;
//echo self::$bIsInit.'settorf';

		}
	}

	/**
	 * Output content of template file
	 *
	 * @access public
	 * @static
	 * @param  STRING $sTemplateFile name of template file to include
	 * @throws Exception
	 * @return void
	 */
	public static function includeTemplate($sTemplateFile)
	{
  
//print_r($_SERVER);
		self::init();
	//	echo self::$bIsAjax.'include ajax set???';
		if( ! self::$bIsAjax)
		{
			if(is_string($sTemplateFile) && $sTemplateFile != '')
			{
				$includePath = $sTemplateFile;
        //echo 'includepath issss';
        //echo $sTemplateFile;
        //echo $includePath;
				if($includePath ===  $sTemplateFile)
				{
					include($includePath);
				}
				else
				{
					throw new Exception(__METHOD__ . ' received request for invalid file.');
				}
			}
			else
			{
				throw new Exception(__METHOD__ . ' requires name of template file.');
			}
		}
	}

	public static function notFound()
	{
		header('HTTP/1.0 404 Not Found');
		exit('<h1>File not found</h1><p>The resource you have requested cannot be located on this server</p>');
	}
}

?>