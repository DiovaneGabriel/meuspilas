<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MasterSQLModel extends CI_model {
	public function result($where = false, $orderBy = false) {
		$result = new MasterSQL ( $this, $where, $orderBy, true );
		return $result->result;
	}
	public function row($where = false, $orderBy = false) {
		$result = new MasterSQL ( $this, $where, $orderBy, true );
		return $result->row;
	}
	public function getSequence() {
		return $this->SEQUENCE;
	}
	public function nextMoreOne($field, $table, $where = false) {
		$field = MasterSQLUteis::decodeProperties ( $field );
		$table = MasterSQLUteis::decodeProperties ( $table );
		
		if (! $where) {
			$where = '1 = 1';
		}
		
		$query = $this->db->query ( 'SELECT MAX(' . $field . ') ' . $field . ' FROM ' . $table . ' WHERE ' . $where );
		
		MasterSQLUteis::exception ( $this->db->error (), false );
		
		if ($query->num_rows () > 0) {
			return $query->row ()->{$field} + 1;
		} else {
			return 1;
		}
	}
	public function getTypeFields() {
		$tableName = MasterSQLUteis::decodeProperties ( get_class ( $this ) );
		$query = $this->db->query ( "SELECT COLUMN_NAME, DATA_TYPE, NVL(DATA_SCALE,0) DATA_SCALE FROM USER_TAB_COLUMNS WHERE TABLE_NAME = '" . $tableName . "'" );
		
		MasterSQLUteis::exception ( $this->db->error (), false );
		
		if ($query->num_rows () > 0) {
			$arrayObjects = $query->result ();
			$array = array ();
			
			foreach ( $arrayObjects as $object ) {
				$array [$object->COLUMN_NAME] = ( object ) array (
						'dataType' => $object->DATA_TYPE,
						'dataScale' => $object->DATA_SCALE 
				);
			}
			
			return $array;
		} else {
			return false;
		}
	}
}
