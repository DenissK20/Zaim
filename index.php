<?php
require 'models.php';

$app = new \atk4\ui\App('Взаймы кому?');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=heroku_33a09646a43f60a;host=eu-cdbr-west-02.cleardb.net','root','');

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
