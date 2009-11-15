<?php
class Server extends AppModel {

	var $name = 'Server';
	var $useTable = 'servers';
	var $validate = array(
		'name' => VALID_NOT_EMPTY,		
		'ip' => array('ip'),
		'port' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Game' => array('className' => 'Game',
								'foreignKey' => 'game_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

								var $hasMany = array(

									
			'Servercomment' => array('className' => 'Servercomment',
								'foreignKey' => 'server_id',
									
								)
								);

}
?>