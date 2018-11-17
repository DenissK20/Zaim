<?php
require 'models.php';

$app = new \atk4\ui\App('Сколько украл/вернул?');
$app->initLayout('Centered');

$friends = new Friends ($db);
$friends->load($_SESSION['friends_id']);

$zaim= $friends->ref('Zaim');
$crud = $app->layout->add('CRUD');
$crud->setModel($zaim);

$vosvrat= $friends->ref('Vosvrat');
$crud = $app->layout->add('CRUD');
$crud->setModel($vosvrat);


$button = $app->add(['Button','Show message']);
$popup = $app->add(['Popup', $button]);
$popup->set(function($popup) use($friends){
  $popup->add(new ReminderBox)->setModel($friends);
});
