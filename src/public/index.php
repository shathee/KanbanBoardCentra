<?php
use KanbanBoard\Authentication;
use KanbanBoard\GithubActual;
use KanbanBoard\Utilities;

require '../classes/KanbanBoard/Github.php';
require '../classes/Utilities.php';
require '../classes/KanbanBoard/Authentication.php';


// setting the .env path 
$environment_file_path = dirname(__DIR__, 2).'/.env';

Utilities::load_env_file($environment_file_path);
$client_id = Utilities::env('GH_CLIENT_ID');
$client_secret = Utilities::env('GH_CLIENT_SECRET');
$repositories = explode('|', Utilities::env('GH_REPOSITORIES'));

$authentication = new \KanbanBoard\Login($client_id,$client_secret);
$token = $authentication->login();
$github = new GithubClient($token, Utilities::env('GH_ACCOUNT'));

$board = new \KanbanBoard\Application($github, $repositories, array('waiting-for-feedback'));
$data = $board->board();

$m = new Mustache_Engine(array(
	'loader' => new Mustache_Loader_FilesystemLoader('../views'),
));
echo $m->render('index', array('milestones' => $data));
