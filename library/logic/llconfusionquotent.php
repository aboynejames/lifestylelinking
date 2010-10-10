<?php


class LLconfusionQuotent 
{

  // OLD code needs reviewed,  some should be discarded.
  
//  CQ   confusion quotient  how like are definitions, if confusion how to clarify   Q. when does one or more defintions become hard to select from e.g. roller skating, ice skating //


function cqtwodef ($deflist)  {

global $defnomatch;

// 1.  what words are unique between two definitions?
// 2.  take first def and see what word match again all other defs.  then take 2nd def and repeat, then 3rd def etc. etc.
//  Then we have array of all words the intersect each on a pairs level both ways,  now use that array to find absolute unique words for each def and experiment with finding a variable to indicate a high level of confunsion exists and thus more effort should be put into disingushing the correct def. using that new data created.


//$deflist[] = 1;
//$deflist[] = 16;
//$deflist[] = 80;


/*
foreach ($deflist as $defone)  {

// create list of both defintions array
//  need to find out last date.
$db->query ="SELECT * FROM aboyn0_aboynejames.lifestyledefinition WHERE aboyn0_aboynejames.lifestyledefinition.idlifestart = $defone";

//echo $db->query;
$resultdefcq = mysql_query($db->query) or die ("Error in query: $db->query. ".mysql_error());

if (mysql_num_rows($resultdefcq) > 0)  {

while ($row = mysql_fetch_object($resultdefcq))  {

$defwords[$defone][] = $row->lifestylewords;

}   // closes while
}  // closes if

}  // closes foreach

print_r($defwords);
echo '<br /><br />';
*/


foreach ($deflist as $defnolist => $wdatal)  {

//
foreach ($deflist as $defind => $wdata)  {

//$diffab = '';
//  intersect array list unique words
$diffab = array_intersect_key($deflist[$defnolist], $deflist[$defind]);
//echo $defind;
//print_r($deflist[$defind]);
//echo '<br /><br />';

//print_r($diffab);
//echo '<br /><br />';

//  from array from each def and associated matched words
foreach ($diffab as $difm => $difmno)  {

$defnomatch[$defnolist][$defind][] = $difm;

}

//print_r($defnomatch);
//echo '<br /><br />';


//  intersect array list unique words
//$diffabb = array_intersect($defwords[16], $defwords[1]);
//print_r($diffabb);
//echo '<br /><br />';

//array_xor($defwords[1], $defwords[16]);


}  //  closes foreach

//echo '<br /><br />';
//print_r($defnomatch[1]);
//echo '<br /><br />';


}  //  closes opening foreach

//echo '<br /><br />';
//print_r($defnomatch);
//echo '<br /><br />';


}  // closes function





// function to count array matches and produce array of def with matching scores
function defmatcount ()  {

global $defnomatch;
global $lifewordsagg;

print_r($lifewordsagg);


//foreach ($defnomatch as $defkey=>$defmat) {
foreach ($lifewordsagg as $defkeyl=>$defnol) {

echo '<br />deffirst<br />';
echo $defkeyl;
echo '<br /><br />';
//print_r($defmat);
//echo '<br />mat<br />';


//print_r($defnomatch[$defkeyl][$defkeyl]);
echo '<br />postmat<br />';

foreach ($lifewordsagg as $defkeylb=>$defnolb) {



$matno = count($defnomatch[$defkeyl][$defkeylb]);

echo $matno;
echo '<br />mat<br />';
// form new array with def pair and match count
$defmatpair[$defkeyl][$defkeylb] = $matno;

}  // closes 2nd foreach


} // closes foreach

print_r($defmatpair);


}  // closes function






function defmatseg ($deflist)  {


//  want to take one definition, segment it and then match against all other definitions

$topseg = array ( 1, 2, 3, 4, 5, 10, 20, 50 );


foreach ($deflist as $defnolist => $wdatal)  {

//  takes list of all definition array and splits to find def. numbers
foreach ($deflist as $defind => $wdata)  {

$insertscore = '';
$insertmatched = '';
$insertscored = '';

// here we need to bring in segmenation for intersect,  then save results and insert into new db table definitionscorea
foreach ($topseg as $seg)  {

$dms = '';
//unset($lifewordsarrays);


$defmatseg = array_slice($deflist[$defnolist], 0, $seg);
//print_r($lifewordsarrays);

//$diffab = '';
//  intersect array list unique words
echo '<br /><br />defmegseg';
print_r($defmatseg);
echo '<br /><br />deflist';
print_r($deflist[$defind]);
$dms = array_intersect_key($defmatseg, $deflist[$defind]);
echo '<br /><br />dms';
print_r($dms);

if (count($dms) > 0 ) {
//echo '<br /><br />';
$wordsmatched = count($dms);
//echo $wordsmatched;
//echo '<br /><br />';
$postscore = array_sum($dms);
//echo $postscore;
 
$scoring[$seg] = $postscore;
$matched[$seg] = $wordsmatched;

}

else {

$matched[$seg] = 0;
$scoring[$seg] = 0;

}


}  // closes opening foreach


$insertscore['matched'] = $matched;
$insertscore['score'] = $scoring;

echo '<br /><br />';
print_r($matched);
echo 'match';
print_r($scoring);

$insertmatched = '';

// now can create variable ready for inserting into a query
foreach ($matched as $pmat)  {

$insertmatched .= " '".$pmat."', ";

}
//echo $insertmatched;

$insertscored = '';
// now can create variable ready for inserting into a query
foreach ($scoring as $pscore)   {

$insertscored .= " '".$pscore."', ";


}

$insertscored=substr($insertscored,0,(strLen($insertscored)-2));//this will eat the last comma
//echo $insertscored;

$db->query ="INSERT INTO ".RSSDATA.".definitionscorea (defoneid, deftwoid, matched1, matched2, matched3, matched4, matched5, matched10, matched20, matched50,  score1, score2, score3, score4, score5, score10, score20, score50 ) VALUES ";

$db->query .="( '$defnolist', '$defind', ";

$db->query .="$insertmatched ";

$db->query .=" $insertscored ) ";

echo $db->query;
$resultinserts = mysql_query($db->query) or die ("Error in query: $db->query. ".mysql_error());

}
}

}  // closes function






function defmatsegorder ($deflist)  {


//  want to take one definition, segment it and then match against all other definitions

$topseg = array ( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49 );


foreach ($deflist as $defnolist => $wdatal)  {

//  takes list of all definition array and splits to find def. numbers
foreach ($deflist as $defind => $wdata)  {

$positw = '';

// here we need to bring in segmenation for intersect,  then save results and insert into new db table definitionscorea
foreach ($topseg as $seg)  {

$dms = '';
$orderw = '';
//unset($lifewordsarrays);


$defmatseg = array_slice($deflist[$defnolist], $seg, 1);
//print_r($lifewordsarrays);

//$diffab = '';
//  intersect array list unique words
//echo '<br /><br />defmegseg';
//print_r($defmatseg);
//echo '<br /><br />deflist';
//print_r($deflist[$defind]);
//echo '<br /><br />ordernumber';
foreach ($deflist[$defind] as $keyw=>$kvotes)  {
$orderw[] =$keyw;
}
//print_r($orderw);



$dms = array_intersect_key($defmatseg, $deflist[$defind]);
//echo '<br /><br />dms';
//print_r($dms);
//echo '<br /><br />orderposition';
// need to find word within $defmatseg
$wordsega = array_keys($defmatseg);
$wordseg = $wordsega[0];
//echo $wordseg;
$orderdms = array_search($wordseg, $orderw);
//echo $orderdms;
//echo '<br /><br />endposition';


if (strlen($orderdms) == 0 )  {

$positw[] = -1;
//$positw[] = $orderdms;

}

else  {

$positw[] = $orderdms;
//$positw[] = 99;

}


}

print_r($positw);


$positscored = '';

foreach ($positw as $posorno)  {

//echo $posorno;
$positscored .=  "'".$posorno."', ";


}

$positscored=substr($positscored,0,(strLen($positscored)-2));//this will eat the last comma
//echo $positscored;



$db->query ="INSERT INTO ".RSSDATA.".definitionscoreaorder (defoneid, deftwoid, word1, word2, word3, word4, word5, word6, word7, word8, word9, word10, word11, word12, word13, word14, word15, word16, word17, word18, word19, word20, word21, word22, word23, word24, word25, word26, word27, word28, word29, word30, word31, word32, word33, word34, word35, word36, word37, word38, word39, word40, word41, word42, word43, word44, word45, word46, word47, word48, word49, word50) VALUES ";

$db->query .="( '$defnolist', '$defind', ";

$db->query .=" $positscored ) ";

echo $db->query;
$resultinsertsord = mysql_query($db->query) or die ("Error in query: $db->query. ".mysql_error());

}
}

}  // closes function





?>