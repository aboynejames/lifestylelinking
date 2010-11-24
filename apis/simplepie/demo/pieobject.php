<?php
// Start counting time for the page load
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

// Include SimplePie
// Located in the parent directory
include_once('../simplepie.class.php');
include_once('../idn/idna_convert.class.php');

$_GET['feed'] = 'http://aboynejames.blogspot.com';

// Create a new instance of the SimplePie object
$feed = new SimplePie();

//$feed->force_fsockopen(true);

// Make sure that page is getting passed a URL
if (isset($_GET['feed']) && $_GET['feed'] !== '')
{
	// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
	if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
	{
		$_GET['feed'] = stripslashes($_GET['feed']);
	}

	// Use the URL that was passed to the page in SimplePie
	$feed->set_feed_url($_GET['feed']);
}

// Allow us to change the input encoding from the URL string if we want to. (optional)
if (!empty($_GET['input']))
{
	$feed->set_input_encoding($_GET['input']);
}

// Allow us to choose to not re-order the items by date. (optional)
if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
{
	$feed->enable_order_by_date(false);
}

// Trigger force-feed
if (!empty($_GET['force']) && $_GET['force'] == 'true')
{
	$feed->force_feed(true);
}

// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and
// all that other good stuff.  The feed's information will not be available to SimplePie before
// this is called.
$success = $feed->init();

// We'll make sure that the right content type and character encoding gets set automatically.
// This function will grab the proper character encoding, as well as set the content type to text/html.
$feed->handle_content_type();

//print_r(get_class_methods($feed));

//print_r(get_class_vars($feed));

//print_r($feed->data['child']['http://www.w3.org/2005/Atom']['feed']['0']['child']['http://www.w3.org/2005/Atom']['entry']); ['child']['content']

//print_r($success);

$contentids = array('0'=>'1', '1'=>'2', '2'=>'3', '3'=>'4', '4'=>'5', '5'=>'6', '6'=>'7', '7'=>'8', '8'=>'9', '9'=>'10', '10'=>'11', '11'=>'12', '12'=>'13', '13'=>'14', '14'=>'15', '15'=>'16', '16'=>'17', '17'=>'18', '18'=>'19', '19'=>'20', '20'=>'21', '21'=>'22', '22'=>'23', '23'=>'24' );

foreach ($contentids as $index=>$cid)
{
echo 'CONTENT ITEM <br /><br />';
print_r($feed->data['child']['http://www.w3.org/2005/Atom']['feed']['0']['child']['http://www.w3.org/2005/Atom']['entry'][$cid]['child']['http://www.w3.org/2005/Atom']['content']['0']['data']);

}

?>