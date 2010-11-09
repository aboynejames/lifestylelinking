<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../');
require_once "LLlogic.php";

// controlpanel for LL

// control over personalization, data, display settings for the framework


?>

<html>

<body>
CQ - CONFUSION QUOTENT TESTING<br />
<?php

// testing confusion quotent

//  shows total no. words common to two definitions
// need to feed function the top50 words for each lifestyle definition
$newCQ = new  LLconfusionQuotent();
$newCQ->cqtwodef ($lifewordsagg);
$newCQ->defmatcount ();


?>

</body>

</html>




