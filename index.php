<?php

require './vendor/autoload.php';
require './src/configuration/dbconfig.php';

$app = new \Slim\App;
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
});
$app->run();
?>