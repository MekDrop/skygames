<?php
class Match extends AppModel {

	var $name = 'Match';
	var $useTable = 'matches';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Event' => array('className' => 'Event',
								'foreignKey' => 'event_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Team1' => array('className' => 'Team',
								'foreignKey' => 'team1_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Team2' => array('className' => 'Team',
								'foreignKey' => 'team2_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),			
			'Playofftable' => array('className' => 'Playofftable',
								'foreignKey' => 'playofftable_id'),
			
			'Grouptable' => array('className' => 'Grouptable',
								'foreignKey' => 'grouptable_id')			
								
	);


	var $hasMany = array(

			'Result' => array('className' => 'Result',
								'foreignKey' => 'match_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
			/*
			,
			'Matchcomment' => array('className' => 'Matchcomment',
								'foreignKey' => 'match_id',
							
			)*/
	);

}
?>