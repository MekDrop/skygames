<?php
class Bett extends AppModel {

	var $name = 'Bett';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Match' => array('className' => 'Match',
								'foreignKey' => 'match_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Team' => array('className' => 'Team',
								'foreignKey' => 'team_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

}
?>