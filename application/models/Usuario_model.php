<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once 'MainModel.php';

class Usuario_model extends MainModel {
	public function login($email, $senha) {
		$this->db->select("*");
		$this->db->from("usuario");
		$this->db->where("email", $email);
		$this->db->where("senha_md5", md5($senha));

		return $this->get_row();
	}
	public function usuarioLogado() {
		return isset($this->session->usuario->id);
	}
	public function logoutUsuario() {
		$this->session->unset_userdata('usuario');

		redirect(base_url());
	}
	public function insert($content) {
		return $this->insert_row("usuario", $content);
	}
}
