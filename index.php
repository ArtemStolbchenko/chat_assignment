<?php

require './vendor/autoload.php';
require './src/configuration/dbconfig.php';
require './src/Managers/LogicManagers/userManager.php';

$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);

$app->get('/', function () {
	echo 'Welcome to the insane slim app <br/>';
	echo '<a href = "groups">Press here to view existing groups</a>';
});
$app->get('/groups', function()
{
	require './src/pages/groups.php';
});
$app->get('/chat', function ($groupId)
{
	require './src/pages/chat.php';
	require './src/Managers/DBManagers/baseDbManager.php';

	$manager = new BaseDbManager();
	$manager->tableName = 'Messages';
	$manager->Initialize();

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