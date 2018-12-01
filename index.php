<?php
//require 'models.php';
require 'vendor/autoload.php';

if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
     $db = \atk4\data\Persistence::connect($_ENV['CLEARDB_DATABASE_URL']);
 } else {
     $db = \atk4\data\Persistence::connect('mysql:host=127.0.0.1;dbname=person;charset=utf8', 'root', '');
 }

var_dump($db);

$app = new \atk4\ui\App('Взаймы кому?');
$app->initLayout('Centered');

/*
$person = new Person($db);
  $form = $app->layout->add('Form');
$form->setModel(new Person($db),['login','password']);
$form->buttonSave->set('Sign in');
$form->onSubmit(function($form) use ($person) {
  $person->tryLoadBy('login',$form->model['login']);
  If ($person['password'] == $form->model['password']) {
    $_SESSION['person_id'] = $person->id;
    return new \atk4\ui\jsExpression('document.location="main.php"');
  } else {
    $person->unload();
    $er = (new \atk4\ui\jsNotify('No such user.'));
    $er->setColor('red');
    return $er;
  }
});



$button = $app->add(['Button', 'Admin','blue']);
$button->link('check.php');
*/
