<?php
use KanbanBoard\Authentication;
use KanbanBoard\Utilities;

require '../../vendor/autoload.php';

// setting the .env path 
$environment_file_path = dirname(__DIR__, 2).'/.env';

$e = Utilities::load_env_file($environment_file_path);

$client_acc = Utilities::env('GH_ACCOUNT');
$client_id = Utilities::env('GH_CLIENT_ID');
$client_secret = Utilities::env('GH_CLIENT_SECRET');
$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));
$pause_labels = explode('|', Utilities::env('PAUSE_LABELS', 'waiting-for-feedback'));
$restriction = strtolower(Utilities::env('RESTRICTED', 'Yes'));
$data = [];
$token = NULL;

if(Utilities::validator($client_acc, 'GH_ACCOUNT') && Utilities::validator($client_id, 'GH_CLIENT_ID') && Utilities::validator($client_secret, 'GH_CLIENT_SECRET') && Utilities::validator($repositories, 'GH_REPOSITORIES')){
	if($restriction !== 'no' ){
		$authentication = new \KanbanBoard\Login($client_id,$client_secret);
		$token = $authentication->login();
	}
	$client= new \Github\Client(new \Github\HttpClient\CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache')));
	$github = new GithubClient($token, $client_acc, $client);
	$board = new \KanbanBoard\Application($github, $repositories, $pause_labels);
	$data = $board->board();
}



$msg = Utilities::getMessage();

$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'), 'entity_flags' => ENT_QUOTES
));
echo $m->render('index', array('milestones' => $data, 'msg'=>$msg));
