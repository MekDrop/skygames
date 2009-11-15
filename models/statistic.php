<?php
class Statistic extends AppModel {

	var $name = 'Statistic';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Team' => array('className' => 'Team',
								'foreignKey' => 'team_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

}
?>