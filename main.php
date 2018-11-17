<?php
require 'models.php';


$app = new \atk4\ui\App('Кто украл мои деньги?');
$app->initLayout('Centered');


$person = new Person ($db);
$person->load($_SESSION['person_id']);
$friend= $person->ref('Friends');
$crud = $app->layout->add('CRUD');
$crud->setModel($friend);
$crud->addDecorator('name', new \atk4\ui\TableColumn\Link('notrand.php?friends_id={$id}'));
