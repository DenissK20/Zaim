<?php
require 'vendor/autoload.php';
require 'models.php';

$app = new \atk4\ui\App('Взаймы кому?');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=person;host=localhost','root','');

$person = new Person($db);
  $form = $app->layout->add('Form');
$form->setModel(new Person($db));
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

$form = $app->layout->add('Form');
$form->setModel(new Person($db));

$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success('Record updated');
});

$form = $app->layout->add('Form');
$form->setModel(new Friends($db));

$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success('Record updated');
});

$button = $app->add(['Button', 'Admin','blue']);
$button->link('check.php');
