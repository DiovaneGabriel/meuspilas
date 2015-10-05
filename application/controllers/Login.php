<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'usuario_model', '', TRUE );
	}
	public function index() {
		
// 		self::sair();
		
		if ($this->usuario_model->usuarioLogado ()) {
			self::logado();
		} else {
			$data ['currentArea'] = 'login';
			$this->load->view ( 'login/index', $data );
		}
	}
	public function logado() {
		echo "<pre>";
		var_dump ( $this->session->usuario );
		die ();
	}
	public function entrar() {
		$usuario = $this->usuario_model->login ( $_POST ['email'], $_POST ['senha'] );
		
		if ($usuario) {
			$this->session->set_userdata ( 'usuario', $usuario );
			self::logado();
			header ( 'Location: ' . $homePage );
		} else {
			$this->session->message = 'Usuário ou senha incorretos!</br> Tente novamente.';
			header ( 'Location: ' . base_url () );
		}
	}
	public function sair() {
		$this->usuario_model->logoutUsuario ();
	}
}
