<?php
class Info extends AppModel {

	var $name = 'Info';
	var $useTable = 'infos';
	var $validate = array(
		'infocat_id' => array('numeric'),
		'lang_id' => array('numeric'),
		'game_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Infocat' => array('className' => 'Infocat',
								'foreignKey' => 'infocat_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Lang' => array('className' => 'Lang',
								'foreignKey' => 'lang_id',
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
			'Infocomment' => array('className' => 'Infocomment',
								'foreignKey' => 'info_id',
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

}
?>