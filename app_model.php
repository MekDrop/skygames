<?php
/* SVN FILE: $Id: app_model.php 6311 2008-01-02 06:33:52Z phpnut $ */

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 00:33:52 -0600 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppModel extends Model{
	
	//var $actsAs = array('Bindable'); 
	
	var $habtm = array();
	
	
	function prepareJoinStatement(){
	    $join_statement = "";
	    foreach($this->habtm as $key=>$value){
	        $fk_this = $value[0];
	        $fk_otherModel = $value[1];
	        
	        $otherModelName = $value[2];
	        App::import('Model', $otherModelName);
	        //loadModel(); 
	        $otherModel = new $otherModelName();
	        $otherTableName = $otherModel->useTable;
	        
	        $join_statement .= " JOIN ".$key." on ".$this->name.".id=".$key.".".$fk_this;
	        $join_statement .= " JOIN ".$otherTableName." as ".$otherModelName." on ".$key.".".$fk_otherModel."=".$otherModelName.".id";
	    }
	    return $join_statement;
	}

	function findAllHabtm($conditions = null, $fields = null, $order = null, $limit = null, $page = 1, $recursive = null) {

        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $this->id = $this->getID();
        $offset = null;

        if ($page > 1 && $limit != null) {
            $offset = ($page - 1) * $limit;
        }

        if ($order == null) {
            $order = array();
        } else {
            $order = array($order);
        }

        $queryData = array('conditions' => $conditions,
                            'fields'    => '*',
                            'joins'     => array($this->prepareJoinStatement()),
                            'limit'     => $limit,
                            'offset'    => $offset,
                            'order'     => $order
        );

        $ret = $this->beforeFind($queryData);
        if (is_array($ret)) {
            $queryData = $ret;
        } elseif ($ret === false) {
            return null;
        }

        $return = $this->afterFind($db->read($this, $queryData, $recursive));

        if (isset($this->__backAssociation)) {
            //$this->__resetAssociations();
        }

        return $return;
    } 
	
    
	function unbindAll($params = array())
    {
        foreach($this->__associations as $ass)
        {
            if(!empty($this->{$ass}))
            {
                 $this->__backAssociation[$ass] = $this->{$ass};
                if(isset($params[$ass]))
                {
                    foreach($this->{$ass} as $model => $detail)
                    {
                        if(!in_array($model,$params[$ass]))
                        {
                             $this->__backAssociation = array_merge($this->__backAssociation, $this->{$ass});
                            unset($this->{$ass}[$model]);
                        }
                    }
                }else
                {
                    $this->__backAssociation = array_merge($this->__backAssociation, $this->{$ass});
                    $this->{$ass} = array();
                }
                
            }
        }
        return true;
    } 
	
    
	/**
     * Get Enum Values
     * Snippet v0.1.3
     * http://cakeforge.org/snippet/detail.php?type=snippet&id=112
     *
     * Gets the enum values for MySQL 4 and 5 to use in selectTag()
     */
    function getEnumValues($columnName=null, $respectDefault=false)
    {
        if ($columnName==null) { return array(); } //no field specified


        //Get the name of the table
        $db =& ConnectionManager::getDataSource($this->useDbConfig);
        $tableName = $db->fullTableName($this, false);


        //Get the values for the specified column (database and version specific, needs testing)
        $result = $this->query("SHOW COLUMNS FROM {$tableName} LIKE '{$columnName}'");

        //figure out where in the result our Types are (this varies between mysql versions)
        $types = null;
        if     ( isset( $result[0]['COLUMNS']['Type'] ) ) { $types = $result[0]['COLUMNS']['Type']; $default = $result[0]['COLUMNS']['Default']; } //MySQL 5
        elseif ( isset( $result[0][0]['Type'] ) )         { $types = $result[0][0]['Type']; $default = $result[0][0]['Default']; } //MySQL 4
        else   { return array(); } //types return not accounted for

        //Get the values
        $values = explode("','", preg_replace("/(enum)\('(.+?)'\)/","\\2", $types) );

        if($respectDefault){
                $assoc_values = array("$default"=>Inflector::humanize($default));
                foreach ( $values as $value ) {
                        if($value==$default){ continue; }
                        $assoc_values[$value] = Inflector::humanize($value);
                }
        }
        else{
                $assoc_values = array();
                foreach ( $values as $value ) {
                        $assoc_values[$value] = Inflector::humanize($value);
                }
        }

        return $assoc_values;

    } //end getEnumValues
}
?>