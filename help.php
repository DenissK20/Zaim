<?php
require 'models.php';

$app = new \atk4\ui\App('Взаймы кому?');
$app->initLayout('Centered');


$app->add('CRUD')->setModel(new Friends($db));
