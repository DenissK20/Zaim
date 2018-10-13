<?php
require 'vendor/autoload.php';

$app = new \atk4\ui\App('Admin');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=person;host=localhost','root','');

$crud = $app->layout->add('CRUD');


$button = $app->add(['Button','Log out','blue']);
$button->link('index.php');
