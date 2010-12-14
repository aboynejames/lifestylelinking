<?php session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
include_once('controlpanel/controlhead.php'); 

//echo RSSDATA;

?>


<?php
include_once ("controlpanel/controlhead.php");
?>
<div id="adminpanel"> <!-- admin panel -->

<div id="controlsection">
<h1>TIME</h1>
<?php// dailytimes() ; ?>
</div>
<div id="controlsection">
<h1>Statistics summary </h1>

<?php// activefeeds(); ?>

<?php //postitemsall () ?>

<?php //lasttwofourperiod () ?> 

<?php //No results live, previous days (split per lifestyle)  ?>

<?php //No users registered ?>

<?php //No users logged in ?>

</div>

<div id="controlsection">
<h1>Definitions</h1>

<?php //livelifemags (); ?>

</div>

</div>  <!-- closes admin panel -->


<?php include_once ("controlpanel/controlfooter.php"); ?> 