<?php
class Participation extends AppModel {

	var $name = 'Participation';
	var $useTable = 'eventteams';

	
	
    var $belongsTo = array(
		'Team' => array('className' => 'Team',
							'foreignKey' => 'team_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		),
		'Event' => array('className' => 'Event',
							'foreignKey' => 'event_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		)
	);
	
}
?>