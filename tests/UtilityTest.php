<?php
use phpunit\phpunit\src\Framework\TestCase;
use KanbanBoard\Utilities;
require './vendor/autoload.php';

final class UtilityTest extends PHPUnit_Framework_TestCase 
{	
	public function setUp()
    {
        $this->env_path = dirname(__DIR__).'/.env';

        Utilities::load_env_file(dirname(__DIR__).'/.env');
        
    }
    
    public function testEnvFileExists(){
        $this->assertFileExists($this->env_path);
    }

    /**
     * @runtestEnvFileExists
     */
    public function testEnvFileHasGhAccountKey(){
        $this->assertArrayHasKey('GH_ACCOUNT', $_ENV, "env has no key GH_ACCOUNT");
    }
    /**
     * @runtestEnvFileExists
     */
    public function testEnvFileHasGhAccountKeyValue(){
        $this->assertGreaterThan(0, strlen($_ENV['GH_ACCOUNT']));
    }
    
    /**
     * @runtestEnvFileExists
     */
    public function testEnvFileHasGhClientIdKey(){
        $this->assertArrayHasKey('GH_CLIENT_ID', $_ENV, "env has no key GH_CLIENT_ID");
    }
    /**
     * @runtestEnvFileExists
     */
    public function testEnvFileHasGhClientSecretKey(){
        $this->assertArrayHasKey('GH_CLIENT_SECRET', $_ENV, "env has no key GH_CLIENT_SECRET");
    }
    /**
     * @runtestEnvFileExists
     */
    public function testEnvFileHasGHRepositoryKey(){
        $this->assertArrayHasKey('GH_REPOSITORIES', $_ENV, "env has no key GH_REPOSITORIES");
    }

}
