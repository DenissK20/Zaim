<?php
require 'vendor/autoload.php';
require 'models.php';

$app = new \atk4\ui\App('Кто украл мои деньги?');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=person;host=localhost','root','');


$crud = $app->layout->add('CRUD');
$crud->setModel(new Friends($db));
$crud->addDecorator('name', new \atk4\ui\TableColumn\Link('index.php?friends_id={$id}'));
