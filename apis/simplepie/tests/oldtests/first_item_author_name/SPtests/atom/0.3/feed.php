<?php

class SimplePie_First_Item_Author_Name_Atom_03_Inheritance_Feed_Name extends SimplePie_First_Item_Author_Name_Test
{
	function data()
	{
		$this->data = 
'<feed version="0.3" xmlns="http://purl.org/atom/ns#">
	<author>
		<name>Item Author</name>
	</author>
	<entry>
		<title>Item Title</title>
	</entry>
</feed>';
	}
	
	function expected()
	{
		$this->expected = 'Item Author';
	}
}

?>