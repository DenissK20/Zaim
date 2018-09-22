<?php
require 'vendor/autoload.php';

$app = new \atk4\ui\App('Взаймы кому?');
$app->initLayout('Centered');

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=person;host=localhost','root','');

class Person extends \atk4\data\Model {
  public $table = 'person';
function init() {
  parent::init();
  $this->addField('login');
  $this->addField('password');
  $this->addField('name');
  $this->addField('surname');
  $this->hasMany('Friends', new Friends);

}
}

class Friends extends \atk4\data\Model {
  public $table = 'friends';
function init() {
  parent::init();
  $this->addField('name');
  $this->addField('phone_number',['default'=>'+371']);
  $this->addField('email');
  $this->addField('date', ['type' =>'date']);
  $this->hasOne('person_id', new Person)->addTitle();
}
}

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
