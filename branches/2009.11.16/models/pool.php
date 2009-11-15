<?php
class Pool extends AppModel {

	var $name = 'Pool';
	var $useTable = 'pools';



	var $belongsTo = array(
		'Event' => array('className' => 'Event',
							'foreignKey' => 'event_id',
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
							);

}
?>