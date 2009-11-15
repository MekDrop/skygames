<?php
class Infocomment extends AppModel {

	var $name = 'Infocomment';
	var $useTable = 'infocomments';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Info' => array('className' => 'Info',
								'foreignKey' => 'info_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	function beforeSave()
	{
		$rowBigestNumber = $this->findAll(array('info_id' => $this->data["Infocomment"]["info_id"]), array('seqnumber'), 'seqnumber DESC', 1, 1);
		$this->data["Infocomment"]["seqnumber"] = $rowBigestNumber[0]["Infocomment"]["seqnumber"] + 1;
		
		return true;
	}
}
?>