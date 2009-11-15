<?php
class Event extends AppModel {

	var $name = 'Event';
	var $useTable = 'events';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Org' => array('className' => 'Org',
								'foreignKey' => 'org_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Eventtype' => array('className' => 'Eventtype',
								'foreignKey' => 'eventtype_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Match' => array('className' => 'Match',
								'foreignKey' => 'event_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			
			'Playofftable' => array('className' => 'Playofftable',
								'foreignKey' => 'events_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),

			'Grouptable' => array('className' => 'Grouptable',
								'foreignKey' => 'event_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			
			
	);
	
	var $hasAndBelongsToMany = array(
			/*
			'Team' => array('className' => 'Team',
						'joinTable' => 'eventteams',
						'foreignKey' => 'event_id',
						'associationForeignKey' => 'team_id',
						'with' => 'Eventteam',
						'unique' => true,
			),
			*/
			'Team' => array(
			'className' => 'Team',
			'with' => 'Eventteam'),
	);
	
	//var $habtm = array('eventteams'=>array('event_id','team_id','Team'));
}
?>