<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'usuario_model', '', TRUE );
	}
	public function index() {
		
		if ($this->usuario_model->usuarioLogado ()) {
			self::logado ();
		} else {
			$data ['currentArea'] = 'login';
			$this->load->view ( 'login/index', $data );
		}
	}
	public function logado() {
		$homePage = base_url('dashboard');
		$data ['currentArea'] = 'dashboard';
// 		$this->load->view ( 'dashboard/index', $data );
		header ( 'Location: ' . $homePage );
	}
	public function entrar() {
		$usuario = $this->usuario_model->login ( $_POST ['email'], $_POST ['senha'] );
		$homePage = base_url('dashboard');
		
		
		if ($usuario) {
			$this->session->set_userdata ( 'usuario', $usuario );
			self::logado ();
		} else {
			$this->session->message = 'Usuário ou senha incorretos!</br> Tente novamente.';
			header ( 'Location: ' . base_url () );
		}
	}
	public function sair() {
		$this->usuario_model->logoutUsuario ();
	}
}
