<?php
require 'vendor/autoload.php';

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


class Zaim extends \atk4\data\Model {
  public $table = 'zaim';
function iinit() {
  parent::init();
  $this->addField('money');
  $this->addField('date', ['type' => 'date']);
  $this->hasOne('friends_id', new Friends($db));
}
}
