<?php
class Matchpart extends AppModel {

	var $name = 'Matchpart';
	var $useTable = 'matchparts';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Result' => array('className' => 'Result',
								'foreignKey' => 'matchpart_id',
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
	);

}
?>