<?php
class Feed extends AppModel {

	var $name = 'Feed';
	var $useTable = 'feeds';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',							
			)
	);

}
?>