<?php
class Threadcat extends AppModel {

	var $name = 'Threadcat';
	var $useTable = 'threadcats';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Lang' => array('className' => 'Lang',
								'foreignKey' => 'lang_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

								var $hasMany = array(
			'Thread' => array('className' => 'Thread',
								'foreignKey' => 'threadcat_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => 'Thread.created DESC',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								)
								);

}
?>