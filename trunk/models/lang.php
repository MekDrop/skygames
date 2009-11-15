<?php
class Lang extends AppModel {

	var $name = 'Lang';
	var $useTable = 'langs';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Gameword' => array('className' => 'Gameword',
								'foreignKey' => 'lang_id',
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
			'Info' => array('className' => 'Info',
								'foreignKey' => 'lang_id',
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
			'Threadcat' => array('className' => 'Threadcat',
								'foreignKey' => 'lang_id',
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