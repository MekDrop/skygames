<?php
class Gameword extends AppModel {

	var $name = 'Gameword';
	var $useTable = 'gamewords';

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

}
?>