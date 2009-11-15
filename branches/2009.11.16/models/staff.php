<?php
class Staff extends AppModel {

	var $name = 'Staff';
	var $useTable = 'staffs';

	var $belongsTo = array(
		'Org' => array('className' => 'Org',
							'foreignKey' => 'org_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
							),
		'User' => array('className' => 'User',
							'foreignKey' => 'user_id',
							'conditions' => '',
							'fields' => '',
							'order' => '')
							);
}
?>