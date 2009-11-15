<?php
class Nomination extends AppModel {

	var $name = 'Nomination';
	var $useTable = 'nominations';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Eventtype' => array('className' => 'Eventtype',
								'foreignKey' => 'eventtype_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Awardtype' => array('className' => 'Awardtype',
								'foreignKey' => 'awardtype_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
								
								
			);


}
?>