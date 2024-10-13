<?php

require_once './vendor/autoload.php';
require_once './src/configuration/dbconfig.php';
require_once './src/Managers/LogicManagers/userManager.php';
require_once './src/Managers/DBManagers/baseDbManager.php';
require_once './src/Managers/LogicManagers/groupManager.php';
require_once './src/Managers/LogicManagers/messageManager.php';

BaseDbManager::Initialize();
session_start();

$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);

$app->get('/', function () {
	echo 'Welcome to the insane slim app <br/>';
	echo '<a href = "groups">Press here to view existing groups</a>';
});

//User-related functionality
$app->get('/userToken', function()
{
	$usersManager = new UserManager();
	echo json_encode($_SESSION[$usersManager->userSessionTag]);
});

//Group-related functionality
$app->get('/groups', function()
{
    $groupManager = new GroupManager();
    echo json_encode($groupManager->GetAllGroups());
});

$app->get('/groups/create/{groupName}', function($request, $response, $args)
{
	$groupName = $args['groupName'];
    $groupManager = new GroupManager();
	echo json_encode($groupManager->CreateGroup($groupName));
});

$app->get('/groups/join/{groupId}', function($request, $response, $args)
{
	$usersManager = new UserManager();
	$groupId = $args['groupId'];
    $groupManager = new GroupManager();
	$userToken = $_SESSION[$usersManager->userSessionTag];

	$result = $groupManager->Enroll($groupId, $userToken);
	echo json_encode($result);
});

//Message-related functionality
$app->get('/Messages/Send/{groupId}/{content}', function ($request, $response, $args)
{
	$usersManager = new UserManager();
	$messageManager = new MessageManager();

	$groupId = $args['groupId'];
	$content = $args['content'];

	
});
$app->get('/Messages/{groupId}', function ($request, $response, $args)
{
	$usersManager = new UserManager();
	$messageManager = new MessageManager();

	$groupId = $args['groupId'];


});
$app->run();
?>