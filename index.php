<?php

require_once './vendor/autoload.php';
require_once './src/configuration/dbconfig.php';
require_once './src/Managers/LogicManagers/userManager.php';
require_once './src/Managers/DBManagers/baseDbManager.php';

BaseDbManager::Initialize();
session_start();

$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);

$app->get('/', function () {
	echo 'Welcome to the insane slim app <br/>';
	echo '<a href = "groups">Press here to view existing groups</a>';
});
$app->get('/groups', function()
{
	require_once './src/pages/groups.php';
	$usersManager = new UserManager();
});
$app->get('/chat', function ($groupId)
{
	require_once './src/pages/chat.php';

	$manager = new BaseDbManager();
	$manager->tableName = 'Messages';

	$parameters = array(
		'authorId' => '12',
		'groupId' => '228',
		'content'=> "aa';DROP TABLE Messages;#"
	);
	
	$manager->Add($parameters);

	echo 'heyaaa';
});
$app->run();
?>