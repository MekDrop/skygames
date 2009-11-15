<?php
class Map extends AppModel {

	var $name = 'Map';
	var $useTable = 'maps';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								
								);



}
?>