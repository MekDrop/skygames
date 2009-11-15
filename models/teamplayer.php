<?php
class Teamplayer extends AppModel {

	var $name = 'Teamplayer';
	var $useTable = 'teamplayers';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Team' => array('className' => 'Team',
								'foreignKey' => 'team_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $validate = array(
	 	'uniqueid' => array('rule' => 'isUnique', 'required' => false,
			'message' => 'Error'),
		'name' => array(
		 	'required' => array('rule' =>  VALID_NOT_EMPTY, 'required' => true, 'message' => 'Error'),
			 'unique' => array('rule' =>  'isUnique', 'required' => true, 'message' => 'Error')
		)
	);
	
	
	function beforeValidate()	
	{
		$this->validate['uniqueid']['message'] = __('Gameid must be UNIQUE', true);	
		$this->validate['name']['unique']['message'] = __('Player must be UNIQUE', true);
		$this->validate['name']['required']['message'] = __('Enter name', true);
		
		return true;
	}	
	
}
?>