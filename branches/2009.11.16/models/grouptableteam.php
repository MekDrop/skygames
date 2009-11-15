<?php
class Grouptableteam extends AppModel {

	var $name = 'Grouptableteam';
	var $use = 'Grouptableteams';

	var $belongsTo = array(
		'Team' => array('className' => 'Team',
							'foreignKey' => 'team_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
							),
		'Grouptable' => array('className' => 'Grouptable',
							'foreignKey' => 'grouptable_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
							)
							);
}
?>