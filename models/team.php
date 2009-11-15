<?php
class Team extends AppModel {

	var $name = 'Team';
	var $useTable = 'teams';
	
	
	var $validate = array(
	 	'name' => 
			array(
				'unique' => array('rule' => array('uniqueWithinTheGame'), 'required' => true, 'message' => 'Error'),
				'valid' => array('rule' => VALID_NOT_EMPTY, 'required' => true, 'message' => 'Error', 'on' => 'create'),
			),
	
		//'type' => array('rule' => array('minLength', 1), 'required' => true, 'message' => 'Error'),
		'tag' => array('rule' => array('minLength', 2), 'required' => true, 'message' => 'Error')
	);
	
	
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Teamplayer' => array('className' => 'Teamplayer',
								'foreignKey' => 'team_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
			
	);
	

	
	var $hasAndBelongsToMany = array(
			
			'Event' => array('className' => 'Event',
						'joinTable' => 'eventteams',
						'foreignKey' => 'team_id',
						'associationForeignKey' => 'event_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			
			
			'Member' => array(
			'className' => 'User',
			'with' => 'Membership'),
			
		
	);
	
	
	var $habtm = array('eventteams'=>array('team_id', 'event_id', 'Event'));
	
	
	function beforeValidate() {
		
		$this->validate['name']['unique']['message'] = __('Name must be UNIQUE and at least 3 characters long.', true);	
		$this->validate['name']['valid']['message'] = __('Enter name.', true);
		//$this->validate['type']['message'] = __('Type is required.', true);
		$this->validate['tag']['message'] = __('Tag must be at least 2 characters long.', true);
		
		return true;
	}	
	
	function uniqueWithinTheGame($value, $params = array()) {
		
        $valid = false;
        
        $repetition = $this->findCount(array("Team.name" => $value["name"], "Team.game_id" => $this->data["Team"]["game_id"], "Team.id " => "!=".$this->data["Team"]["id"]));
        if (!$repetition)
        	$valid = true;
        	
        return $valid;
    } 
	
}
?>