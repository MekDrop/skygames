<?php
class Result extends AppModel {

	var $name = 'Result';
	var $useTable = 'results';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Matchpart' => array('className' => 'Matchpart',
								'foreignKey' => 'matchpart_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Match' => array('className' => 'Match',
								'foreignKey' => 'match_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Map' => array('className' => 'Map',
								'foreignKey' => 'map_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);


	var $hasMany = array(
			'Resultdemo' => array('className' => 'Resultdemo',
								'foreignKey' => 'result_id',
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
			'Resultpicture' => array('className' => 'Resultpicture',
								'foreignKey' => 'result_id',
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