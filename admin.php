<?php
require 'vendor/autoload.php';
require 'models.php';

$app = new \atk4\ui\App('Admin');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=person;host=localhost','root','');

$crud1 = $app->layout->add('CRUD');
$crud1->setModel(new Person($db));

$crud2 = $app->layout->add('CRUD');
$crud2->setModel(new Friends($db));

$crud3 = $app->layout->add('CRUD');
$crud3->setModel(new Zaim($db));

$crud4 = $app->layout->add('CRUD');
$crud4->setModel(new Vosvrat($db));

$button = $app->add(['Button','Log out','blue']);
$button->link('index.php');
