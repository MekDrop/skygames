<?php
class Eventtype extends AppModel {

	var $name = 'Eventtype';
	var $useTable = 'eventtypes';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Event' => array('className' => 'Event',
								'foreignKey' => 'eventtype_id',
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