<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';
require '../../vendor/autoload.php';

$msg = Utilities::$message;
print_r($msg);
// setting the .env path 
$environment_file_path = dirname(__DIR__, 2).'/.env';

$e = Utilities::load_env_file($environment_file_path);

$client_acc = Utilities::env('GH_ACCOUNT');
$client_id = Utilities::env('GH_CLIENT_ID');
$client_secret = Utilities::env('GH_CLIENT_SECRET');
$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));

$authentication = new \KanbanBoard\Login($client_id,$client_secret);
$token = $authentication->login();

$data = [];
if(!empty($client_acc) && $client_acc != NULL){
	if(empty($repositories[0]) || $repositories[0] === NULL) {
		$msg = 'Environment variable GH_REPOSITORIES not found or has no value';
	}else{
		$github = new GithubClient($token, $client_acc);
		$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
		$data = $board->board();
	}
}else{
	$msg = 'Environment variable GH_ACCOUNT not found or has no value';
}

$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'), 'entity_flags' => ENT_QUOTES
));

echo $m->render('index', array('milestones' => $data, 'msg'=>$msg));
