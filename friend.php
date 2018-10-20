<?php
require 'models.php';

$app = new \atk4\ui\App('Сколько украл/вернул?');
$app->initLayout('Centered');

$friends = new Friends ($db);
$friends->load($_GET['friends_id']);

$zaim= $friends->ref('Zaim');
$crud = $app->layout->add('CRUD');
$crud->setModel($zaim);

$vosvrat= $friends->ref('Vosvrat');
$crud = $app->layout->add('CRUD');
$crud->setModel($vosvrat);
