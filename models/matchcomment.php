<?php
class Matchcomment extends AppModel {

	var $name = 'Matchcomment';
	var $useTable = 'matchcomments';
	
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
			'Match' => array('className' => 'Match',
								'foreignKey' => 'match_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	function beforeSave()
	{
		$rowBigestNumber = $this->findAll(array('match_id' => $this->data["Matchcomment"]["match_id"]), array('seqnumber'), 'seqnumber DESC', 1, 1);
		$this->data["Matchcomment"]["seqnumber"] = $rowBigestNumber[0]["Matchcomment"]["seqnumber"] + 1;
		
		return true;
	}
}
?>