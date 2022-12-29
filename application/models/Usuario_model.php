<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Usuario_model extends CI_Model {
	public function login($email, $senha) {
		$this->db->select ( "id,
						     familia_id,
						     nome,
						     sobrenome,
						     senha_md5,
						     email" );
		$this->db->from ( "usuario" );
		$this->db->where ( "email", $email );
		$this->db->where ( "senha_md5", md5 ( $senha ) );
		
		$query = $this->db->get ();
		
		if ($query->num_rows () > 0) {
			return $query->row ();
		} else {
			return false;
		}
	}
	public function usuarioLogado() {
		if (isset ( $this->session->usuario->id )) {
			return true;
		} else {
			return false;
		}
		return false;
	}
	public function logoutUsuario() {
		$this->session->unset_userdata ( 'usuario' );
		
		header ( 'Location: ' . base_url () );
	}
}