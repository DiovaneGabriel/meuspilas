<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Conta_model extends CI_Model {
	public function getContas($id = false) {
		$this->db->select ( "id,
						     familia_id,
						     descricao,
							 saldo" );
		$this->db->from ( "conta" );
		$this->db->where ( "familia_id", $this->session->usuario->familia_id );
		
		if ($id) {
			$this->db->where ( "id", $id );
		}
		
		$query = $this->db->get ();
		
		if ($query->num_rows () > 0) {
			if ($id) {
				return $query->row ();
			} else {
				return $query->result ();
			}
		} else {
			return false;
		}
	}
}