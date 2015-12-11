<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class MasterSQLUteis {
	static function cast($destination, $sourceObject) {
		if (is_string ( $destination )) {
			$destination = new $destination ();
		}
		$sourceReflection = new ReflectionObject ( $sourceObject );
		$destinationReflection = new ReflectionObject ( $destination );
		$sourceProperties = $sourceReflection->getProperties ();
		foreach ( $sourceProperties as $sourceProperty ) {
			$sourceProperty->setAccessible ( true );
			$name = $sourceProperty->getName ();
			$value = $sourceProperty->getValue ( $sourceObject );
			if ($destinationReflection->hasProperty ( $name )) {
				$propDest = $destinationReflection->getProperty ( $name );
				$propDest->setAccessible ( true );
				$propDest->setValue ( $destination, $value );
			} else {
				$destination->$name = $value;
			}
		}
		return $destination;
	}
	static function decodeProperties($param) {
		if (is_array ( $param )) {
			
			$arrayReturn = array ();
			
			foreach ( $param as $key => $value ) {
				
				$arrayReturn [self::decodeProperties ( $key )] = $value;
			}
			$param = $arrayReturn;
		} else {
			$param = strtoupper ( preg_replace ( '/([A-Z])/', '_$1', lcfirst ( $param ) ) );
		}
		
		return str_replace ( " _", " ", $param );
	}
	static function isDate($date, $format = 'Y-m-d H:i:s') {
		if (is_string ( $date )) {
			$d = DateTime::createFromFormat ( $format, $date );
			return $d && $d->format ( $format ) == $date;
		} else {
			return false;
		}
	}
	static function exception($array, $function = true) {
		if ($array ['code'] == "000000") {
			$returnErro = FALSE;
		} else {
			$returnErro = $array ['message'];
		}
		
		if ($function) {
			return $returnErro;
		} else {
			
			if ($returnErro) {
				$_SESSION ['message'] = array (
						'content' => $returnErro,
						'type' => 'error' 
				);
				redirect ( base_url () );
			}
		}
	}
	static function tableField($newField, $oldField, $table) {
		$return = str_replace ( $oldField, $table . '.' . $oldField, $newField ) . ' AS ' . $oldField;
		
		return $return;
	}
	static function oracleError($error) {
		if ($error ['code'] == "HY000/2292") {
			return 'Restrição de integridade. Registro filho encontrado!';
		} else {
			return $error ['message'];
		}
	}
	static function sortArrayObject(array $array, $property) {
		Uteis::dump ( $object );
	}
}