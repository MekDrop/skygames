<?php
class Grouptable extends AppModel {

	var $name = 'Grouptable';

	/*
	 var $belongsTo = array(
	 'Event' => array('className' => 'Event',
	 'foreignKey' => 'event_id',
	 'conditions' => '',
	 'fields' => '',
	 'order' => ''
	 )
	 );
	 */

	var $hasAndBelongsToMany = array(
			'Team' => array(
			'className' => 'Team',
			'with' => 'Grouptableteam'),
	);

	var $hasMany = array(
			'Match' => array(
			'className' => 'Match',
			'foreignKey' => 'grouptable_id')
	);
}
?>