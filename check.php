<?php
session_start();
require 'vendor/autoload.php';
If((isset($_SESSION['hach'])) &&
($_SESSION['hach'] == 'iqurhp23riuyfsfdugyozfixdbvkjn58946703jksdfg')) {
  header('Location: admin.php');
}

$app = new \atk4\ui\App('Log in');
$app->initLayout('Centered');


$check = new \atk4\data\Model(new \atk4\data\Persistence_Array($a));
$check->addField('password',['type'=>'password','required'=>TRUE]);

$form = $app->layout->add('Form');
$form->setModel($check);

$pass = 'Admin';

$form->onSubmit(function($form) use($pass) {
  $_SESSION['password']=$form->model['password'];
  If($form->model['password']==$pass) {
  $_SESSION['hach']='iqurhp23riuyfsfdugyozfixdbvkjn58946703jksdfg';
  return new \atk4\ui\jsExpression('document.location = "admin.php"');
} else {
  return new \atk4\ui\jsExpression('document.location = "index.php"');
}});
