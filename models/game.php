<?php
class Game extends AppModel {

	var $name = 'Game';
	var $useTable = 'games';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Event' => array('className' => 'Event',
								'foreignKey' => 'game_id',
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
			/*'Gameword' => array('className' => 'Gameword',
								'foreignKey' => 'game_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),*/
			'Infocat' => array('className' => 'Infocat',
								'foreignKey' => 'game_id',
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
			'Info' => array('className' => 'Info',
								'foreignKey' => 'game_id',
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
			'Map' => array('className' => 'Map',
								'foreignKey' => 'game_id',
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
			'Matchpart' => array('className' => 'Matchpart',
								'foreignKey' => 'game_id',
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
			'Threadcat' => array('className' => 'Threadcat',
								'foreignKey' => 'game_id',
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
			'Team' => array('className' => 'Team',
								'foreignKey' => 'game_id',
								'dependent' => false								
			)
	);

}
?>