<?php
require 'vendor/autoload.php';

session_start();

$db = new
\atk4\data\Persistence_SQL('mysql:dbname=heroku_33a09646a43f60a;host=eu-cdbr-west-02.cleardb.net','root','');

class Person extends \atk4\data\Model {
  public $table = 'person_denis';
function init() {
  parent::init();
  $this->addField('login');
  $this->addField('password',['type'=>'password']);
  $this->addField('name');
  $this->addField('surname');
  $this->hasMany('Friends', new Friends);

}
}

class Friends extends \atk4\data\Model {
  public $table = 'friends_denis';
function init() {
  parent::init();
  $this->addField('name');
  $this->addField('phone_number',['default'=>'+371']);
  $this->addField('email');
  $this->addField('date', ['type' =>'date']);
  $this->hasOne('person_id', new Person)->addTitle();
  $this->hasMany('Zaim', new Zaim)->addField('total_zaim', ['aggregate'=>'sum', 'field'=>'money']);
  $this->hasMany('Vosvrat', new Vosvrat)->addField('total_vosvrat', ['aggregate'=>'sum', 'field'=>'money']);
}
}


class Zaim extends \atk4\data\Model {
  public $table = 'zaim_denis';
function init() {
  parent::init();
  $this->addField('money');
  $this->addField('date', ['type' => 'date']);
  $this->hasOne('friends_id', new Friends);
}
}

class Vosvrat extends \atk4\data\Model {
  public $table = 'vosvrat_denis';
function init() {
  parent::init();
  $this->addField('money');
  $this->addField('date', ['type' => 'date']);
  $this->hasOne('friends_id', new Friends);
}
}

class ReminderBox extends \atk4\ui\View {
    public $ui='piled segment';
    /**
     * Specify which contact to remind about
     */

    public function setModel(\atk4\data\Model $friend) {
        $this->add('Header')->set('Please repay my loan, '.$friend['name']);
        $this->add('Text')->addParagraph('I have loaned you a total of ' . $friend['total_zaim']
        . '€ from which you still owe me ' . ($friend['total_zaim']-$friend['total_vosvrat']) . '€. Please pay back!');
        $this->add('Text')->addParagraph('Thanks!');
    }
}
