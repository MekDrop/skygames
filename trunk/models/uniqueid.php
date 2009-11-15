<?php
class Uniqueid extends AppModel {

	var $name = 'Uniqueid';
	var $useTable = 'uniqueids';
	
	var $validate = array(
	 	'value' => array('rule' => array('uniqueWithinTheGame'), 'required' => true,
			'message' => 'Error'),
		'game_id' => array('rule' => array('uniqueWithinTheUser'), 'required' => true,
			'message' => 'Error')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
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

	function beforeValidate()	
	{
		$this->validate['value']['message'] = __('Gameid must be UNIQUE', true);	
		
		return true;
	}	
	
	function uniqueWithinTheGame($value, $params = array()) {
        $valid = false;
        
        $repetition = $this->findCount(array("Uniqueid.value" => $value["value"], "Uniqueid.game_id" => $this->data["Uniqueid"]["game_id"]));
        if (!$repetition)
        	$valid = true;
        	
        return $valid;
    } 
    
    function uniqueWithinTheUser($value, $params = array()) {
        $valid = false;
        
        $repetition = $this->findCount(array("Uniqueid.game_id" => $value["game_id"], "Uniqueid.user_id" => $this->data["Uniqueid"]["user_id"]));
        if (!$repetition)
        	$valid = true;
        	
        return $valid;
    } 
}
?>