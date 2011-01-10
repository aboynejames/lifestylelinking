<?php session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";
include_once ("controlpanel/controlhead.php");
include_once ("controlpanel/controlfooter.php");

?>
<body>

<?php
adminheader();

adminNavigation();

adminSection();

adminFooter();
?>

</body>

</html>


