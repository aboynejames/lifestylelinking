<?php

//set_include_path(get_include_path() . PATH_SEPARATOR . '../');
//print_r($jam);
require_once "lifestylelinking/LLlogic.php";
require_once "lifestylelinking/LLview.php";
require_once "lifestylelinking/LLcouchdb.php";


class llframeworkmanagerTest extends PHPUnit_Framework_TestCase {

/*
    public function testLLframework() {
        $x = new LLframeworkmanager();
	$x->baseurl = 'lifestylelinking';
//        $this->assertEquals(1, $x->demo(1));
	$this->assertClassHasAttribute('individual', $x);
    }    
*/

    public function testLLinstallation() {
        $x = new ();
	$x->baseurl = 'lifestylelinking';
        $this->assertEquals('lifestylelinking', $x->baseurl);

    }


}

?>
