<?php
use phpunit\phpunit\src\Framework\TestCase;
require './vendor/autoload.php';

final class ApplicationTest extends PHPUnit_Framework_TestCase 
{


	public function testMockApplicationBoardIsEmpty(){
		$stub = $this->getMockBuilder(\KanbanBoard\Application::class)
                     ->disableOriginalConstructor()
                     ->disableOriginalClone()
                     ->disableArgumentCloning()
                     ->disallowMockingUnknownTypes()
                     ->getMock();
    	$this->assertEmpty($stub->board());
	}

	    
}
