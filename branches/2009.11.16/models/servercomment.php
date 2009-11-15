<?php
class Servercomment extends AppModel {

	var $name = 'Servercomment';
	var $useTable = 'servercomments';

	var $validate = array(
		'body' => VALID_NOT_EMPTY
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								),
			'Server' => array('className' => 'Server',
								'foreignKey' => 'server_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

								function beforeSave()
								{
									$rowBigestNumber = $this->findAll(array('server_id' => $this->data["Servercomment"]["server_id"]), array('seqnumber'), 'seqnumber DESC', 1, 1);
									$this->data["Servercomment"]["seqnumber"] = (isset($rowBigestNumber[0]["Servercomment"]["seqnumber"]) ? $rowBigestNumber[0]["Servercomment"]["seqnumber"] : 0) + 1;

									return true;
								}
}
?>