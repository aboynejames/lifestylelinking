<?php
include_once ('llcore/display/header.php');
// stitch together header and content.

$jam = $_GET['q'];
//echo $jam;
// if first time visit LLbox
if ($jam == null )
{

llheader();


} // closes

// display UI
else {

displayheader5() ;

} // closes else
?>