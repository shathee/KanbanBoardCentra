<?php
use phpunit\phpunit\src\Framework\TestCase;
use KanbanBoard\Authentication;


require './vendor/autoload.php';

final class AuthenticationTest extends PHPUnit_Framework_TestCase 
{
	protected $loginObject;
	public function setup(){
		// $this->loginObject = new \KanbanBoard\Login();
		$this->loginObject = $this->getMockBuilder(\KanbanBoard\Login::class)->getMock();
		
	}
 	
 	public function testLoginSuccessfull(){
 		return assertFalse($this->loginObject->method('Login'));  
 	}
}
