<?php

require 'vendor/autoload.php';

$app = new \Slim\App;
$app->get('/', function () {
	echo 'Welcome to the insane slim app';
});
$app->run();
?>