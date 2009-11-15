<?php
class Org extends AppModel {

	var $name = 'Org';
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	
	var $hasAndBelongsToMany = array(
		

		
		
		'Admin' => array(
		'className' => 'User',
		'with' => 'Staff'),
			
		
	);
	
	var $hasMany = array(
			'Event' => array('className' => 'Event',
								'foreignKey' => 'org_id',
								'dependent' => false,
			)
			
	);

}
?>