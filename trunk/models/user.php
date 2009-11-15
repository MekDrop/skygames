<?php
class User extends AppModel
{
	var $name = 'User';

	var $belongsTo = 'Group';


	var $validate = array(
	 	'username' => 
	array(
				'unique' => array('rule' => 'isUnique', 'required' => true, 'message' => 'Error', 'on' => 'create'),
				'valid' => array('rule' => VALID_NOT_EMPTY, 'required' => true, 'message' => 'Error', 'on' => 'create'),
	),

		'password' => array('rule' => array('minLength', 3), 'required' => true,
			'message' => 'Error', 'on' => 'create'),
		
		'email' => 
		array(
				'unique' => array('rule' => 'isUnique', 'required' => true, 'message' => 'Error', 'on' => 'create'),
				'valid' => array('rule' => 'email', 'required' => true, 'message' => 'Error'), 
			),
		
	);


	var $hasMany = array (

    		'Team' => array('className' => 'Team',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
			'Uniqueid' => array('className' => 'Uniqueid',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
								),
								/*
								 'Usercomment' => array('className' => 'Usercomment',
								 'foreignKey' => 'user_id',
								 	
								 ),
								 */
			'Org' => array('className' => 'Org',
								'foreignKey' => 'user_id',
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


								/*
								 var $hasOne = array (

								 'Userdetail' => array('className' => 'Userdetail',
								 'foreignKey' => 'user_id'
								 	
								 )

								 );
								 */


								//var $recursive = 2;

								var $hasAndBelongsToMany = array(
			'Clan' => array(
    			'className' => 'Team',
				'with' => 'Membership'),

			'Organization' => array(
    			'className' => 'Org',
				'with' => 'Staff')
									
								);


								function beforeValidate()
								{
									$this->validate['username']['unique']['message'] = __('This username already registered.', true);
									$this->validate['username']['valid']['message'] = __('Enter username.', true);
									$this->validate['password']['message'] = __('Enter password (min 3 charcters).', true);
									$this->validate['email']['valid']['message'] = __('Email is incorrect.', true);
									$this->validate['email']['unique']['message'] = __('Email already registered.', true);

									return true;
								}
}
?>