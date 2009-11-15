<?php
class Thread extends AppModel {

	var $name = 'Thread';
	var $useTable = 'threads';
	var $validate = array(
		'title' => VALID_NOT_EMPTY,
		'body' => VALID_NOT_EMPTY
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Threadcat' => array('className' => 'Threadcat',
								'foreignKey' => 'threadcat_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Post' => array('className' => 'Post',
								'foreignKey' => 'thread_id',
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