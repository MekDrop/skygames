<?php
class Resultpicture extends AppModel {

	var $name = 'Resultpicture';
	var $useTable = 'resultpictures';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Result' => array('className' => 'Result',
								'foreignKey' => 'result_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>