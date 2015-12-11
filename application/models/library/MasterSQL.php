<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

require_once 'MasterSQLUteis.php';
class MasterSQL extends CI_Model {
	private $className;
	private $fields;
	private $join;
	private $joinCondition;
	private $table;
	public $query;
	public $result;
	public $error;
	public $success;
	public $row;
	public $affectedRows;
	public $returnPk;
	public $count = 0;
	public $exists = false;
	const EQUALS = '=';
	const NOT_EQUALS = '!=';
	const SMALLER_EQUALS = '<=';
	const LARGER_EQUALS = '>=';
	const SMALLER = '<';
	const LARGER = '>';
	const IS_NULL = 'IS NULL';
	const IS_NOT_NULL = 'IS NOT NULL';
	const IN = 'in';
	public function __construct($object = false, $where = false, $orderBy = false, $execute = false) {
		if ($object) {
			
			$this->className = get_class ( $object );
			$this->fields = array_keys ( MasterSQLUteis::decodeProperties ( get_object_vars ( $object ) ) );
			$this->table = MasterSQLUteis::decodeProperties ( $this->className );
			$this->where = $where;
			$this->orderBy = $orderBy;
			if ($execute) {
				self::select ();
			}
		}
	}
	public function setWhere($field, $value = false, $operation = self::EQUALS) {
		if (MasterSQLUteis::isDate ( $value )) {
			$value = "to_date('" . $value . "','RRRR-MM-DD HH24:MI:SS')";
		}
		
		if ($value === false) {
			$this->db->where ( $field );
		} else {
			if ($operation == self::EQUALS) {
				$this->db->where ( MasterSQLUteis::decodeProperties ( $field ), $value );
			} else if ($operation == self::IN) {
				$this->db->where_in ( MasterSQLUteis::decodeProperties ( $field ), $value );
			} else if ($operation == self::IS_NULL || $operation == self::IS_NOT_NULL) {
				$this->db->where ( MasterSQLUteis::decodeProperties ( $field ) . ' ' . $operation );
			} else {
				
				$this->db->where ( MasterSQLUteis::decodeProperties ( $field ) . ' ' . $operation . ' ' . $value );
			}
		}
	}
	public function setOrderBy($field, $order = 'asc') {
		$this->db->order_by ( MasterSQLUteis::decodeProperties ( $field ), $order );
	}
	public function setJoin($object, $condition) {
		$this->join = MasterSQLUteis::decodeProperties ( get_class ( $object ) );
		$this->joinCondition = MasterSQLUteis::decodeProperties ( $condition );
	}
	public function select($lazy = true) {
		$class = new $this->className ();
		
		$typeFields = $class->getTypeFields ();
		
		$customFields = (isset ( $class->getMapping ()['customFields'] ) ? $class->getMapping ()['customFields'] : false);
		
		$fields = array ();
		foreach ( $this->fields as $field ) {
			
			$oldField = $field;
			
			/*
			 * verifica se não há algum campo com a consulta personalizada
			 *
			 */
			if ($customFields) {
				
				if (in_array ( $field, array_keys ( MasterSQLUteis::decodeProperties ( $customFields ) ) )) {
					$field = MasterSQLUteis::decodeProperties ( $customFields )[$field];
				}
			} /*
			   * faz o tratamento para buscar os dados de acordo com o tipo correto date, number...
			   *
			   */
			
			if (array_key_exists ( $field, $typeFields )) {
				if ($typeFields [$field]->dataType == 'DATE') {
					$field = "TO_CHAR(" . $field . ",'RRRR-MM-DD HH24:MI')";
				} elseif ($typeFields [$field]->dataType == 'NUMBER') {
					if ($typeFields [$field]->dataScale > 0) {
						$field = "(" . $field . " * (1 * Power(10,''||" . $typeFields [$field]->dataScale . "))) ";
					}
				}
				
				$field = MasterSQLUteis::tableField ( $field, $oldField, $this->table );
			}
			
			array_push ( $fields, $field );
		}
		
		$this->db->select ( $fields, false );
		$this->db->from ( $this->table );
		
		if ($this->join) {
			$this->db->join ( $this->join, $this->joinCondition );
		}
		
		$this->query = $this->db->get ();
		$this->error = MasterSQLUteis::exception ( $this->db->error () );
		MasterSQLUteis::exception ( $this->db->error (), false );
		
		if ($this->query->num_rows () > 0) {
			$return = $this->query->result ();
		} else {
			return false;
		}
		
		$arrayObject = array ();
		
		$array = ( array ) $class;
		$fks = (isset ( $class->getMapping ()['foreignKeys'] ) && ! $lazy ? $class->getMapping ()['foreignKeys'] : false);
		
		foreach ( $return as $object ) {
			
			$object = ( array ) $object;
			
			foreach ( $object as $key => $value ) {
				if (array_key_exists ( $key, $typeFields )) {
					if ($typeFields [$key]->dataType == 'NUMBER') {
						if ($typeFields [$key]->dataScale > 0) {
							$object [$key] = ( float ) ($value / (1 * (pow ( 10, $typeFields [$key]->dataScale ))));
						} else {
							$object [$key] = ( int ) $value;
						}
					}
				}
			}
			
			$object = ( object ) $object;
			
			$i = 0;
			
			foreach ( $array as $campo => $valor ) {
				$o = ( array ) $object;
				$returnFk = false;
				
				if ($fks) {
					
					if (in_array ( $campo, array_keys ( $fks ) )) {
						
						$query = new self ( new $fks [$campo] ['class'] () );
						$query->setWhere ( $fks [$campo] ['pk'], $o [MasterSQLUteis::decodeProperties ( $campo )] );
						$query->setOrderBy ( $fks [$campo] ['orderBy'], isset ( $fks [$campo] ['orderByOrder'] ) ? $fks [$campo] ['orderByOrder'] : 'asc' );
						$query->select ( $lazy );
						
						if ($fks [$campo] ['method'] == 'oneToOne') {
							$returnFk = $query->row;
						} else {
							$returnFk = $query->result;
						}
					}
				}
				
				if ($returnFk) {
					$array [$campo] = $returnFk;
				} else {
					$array [$campo] = $o [MasterSQLUteis::decodeProperties ( $campo )];
				}
			}
			
			array_push ( $arrayObject, MasterSQLUteis::cast ( new $this->className (), ( object ) $array ) );
		}
		
		$this->result = $arrayObject;
		$this->row = $arrayObject [0];
 		$this->count = count($this->result) == null ? 0 : count($this->result);
 		$this->exists = $this->count == 0 ? false : true;
	}
	public function delete() {
		$this->db->delete ( $this->table );
		
		$this->error = MasterSQLUteis::exception ( $this->db->error () );
		
		if ($this->error) {
			$this->success = MasterSQLUteis::oracleError ( $this->db->error () );
		} else {
			$this->success = true;
		}
	}
	public function update($array) {
		$array = MasterSQLUteis::decodeProperties ( $array );
		
		foreach ( $array as $key => $value ) {
			if (MasterSQLUteis::isDate ( $value )) {
				$this->db->set ( $key, "to_date('" . $value . "','RRRR-MM-DD HH24:MI:SS')", FALSE );
			} else {
				$this->db->set ( $key, $value );
			}
		}
		
		$this->db->update ( $this->table );
		$this->error = MasterSQLUteis::exception ( $this->db->error () );
		$this->affectedRows = $this->db->affected_rows ();
		
		if ($this->error) {
			$this->success = $this->error;
		} else {
			$this->success = true;
		}
	}
	public function insert($array) {
		$class = new $this->className ();
		
		if (isset ( $class->getMapping ()['pk'] ) && isset ( $class->getMapping ()['sequence'] )) {
			
			$pk = $class->getMapping ()['pk'];
			$sequence = $class->getMapping ()['sequence'];
			
			$this->db->select ( $sequence . '.NEXTVAL AS SEQUENCE' );
			$this->db->from ( 'DUAL' );
			
			$query = $this->db->get ();
			
			MasterSQLUteis::exception ( $this->db->error (), false );
			
			$this->returnPk = $query->row ()->SEQUENCE;
			$array [$pk] = $this->returnPk;
		}
		
		$array = ( array ) MasterSQLUteis::cast ( new $this->className (), ( object ) $array );
		$array = MasterSQLUteis::decodeProperties ( $array );
		
		// /////
		// verifica se há campos customizados e os exclui do insert
		// ////
		
		$customFields = isset ( $class->getMapping ()['customFields'] ) ? $class->getMapping ()['customFields'] : false;
		
		if ($customFields) {
			$customFields = array_keys ( MasterSQLUteis::decodeProperties ( $customFields ) );
			
			foreach ( $customFields as $customField ) {
				unset ( $array [$customField] );
			}
		}
		// /////
		
		foreach ( $array as $key => $value ) {
			if (MasterSQLUteis::isDate ( $value )) {
				$this->db->set ( $key, "to_date('" . $value . "','RRRR-MM-DD HH24:MI:SS')", FALSE );
			} else {
				$this->db->set ( $key, $value );
			}
		}
		$this->db->insert ( $this->table );
		
		$this->error = MasterSQLUteis::exception ( $this->db->error () );
		$this->affectedRows = $this->db->affected_rows ();
		if ($this->error) {
			$this->success = $this->error;
		} else {
			$this->success = true;
		}
		return $this->returnPk;
	}
}
