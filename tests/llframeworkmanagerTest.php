<?php

require_once("lifestylelinking/library/llframeworkmanager.php");

class llframeworkmanagerTest extends PHPUnit_Framework_TestCase {

    public function testLLframework() {
        $x = new LLframeworkmanager();
//        $this->assertEquals(1, $x->demo(1));
	$this->assertClassHasAttribute('individual', $x);
    }
}

?>
