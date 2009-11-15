<?php
class Usercomment extends AppModel {

	var $name = 'Usercomment';
	var $useTable = 'usercomments';

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
			'Guest' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
								)
								);

								function beforeSave()
								{
									$rowBigestNumber = $this->findAll(array('user_id' => $this->data["Usercomment"]["user_id"]), array('seqnumber'), 'seqnumber DESC', 1, 1);
									$this->data["Usercomment"]["seqnumber"] = $rowBigestNumber[0]["Usercomment"]["seqnumber"] + 1;

									return true;
								}
}
?>