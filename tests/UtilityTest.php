<?php
use phpunit\phpunit\src\Framework\TestCase;
use KanbanBoard\Utilities;
require './vendor/autoload.php';

final class UtilityTest extends PHPUnit_Framework_TestCase 
{	
	public function setUp()
    {
        $this->env_path = dirname(__DIR__).'/.env';
        Utilities::loadEnvFile(dirname(__DIR__).'/.env');
    }

    public function testLoadEnvFile(){
        $this->assertArrayHasKey('GH_ACCOUNT', $_ENV);
    }

    public function testGetEnvWithDefaultValue(){
        $this->assertNotNull(Utilities::env('GH_ACCOUNT', 'SomeAcc'));
    }

    public function testGetEnvWorksWhenEnvIsLoaded(){
        $this->assertNotNull(Utilities::env('GH_ACCOUNT'));
    }    

    public function testHasValue(){
        $test_arr = array('user' => 'baki', 'git_name' => 'shathee'); 
        $this->assertTrue(Utilities::hasValue($test_arr, 'user'));
    }    


}
