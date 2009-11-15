<?php
class Playofftable extends AppModel {

	var $name = 'Playofftable';
	var $useTable = 'playofftables';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Event' => array('className' => 'Event',
								'foreignKey' => 'events_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Match' => array('className' => 'Match',
								'foreignKey' => 'playofftable_id',
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