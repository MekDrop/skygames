<?php
class Post extends AppModel {

	var $name = 'Post';
	var $useTable = 'posts';
	
	var $validate = array(
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
			'Thread' => array('className' => 'Thread',
								'foreignKey' => 'thread_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>