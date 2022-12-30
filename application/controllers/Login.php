<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'MainController.php';

class Login extends CI_Controller {
	public $currentArea;
	public $message;
	public $view;
	function __construct() {
		parent::__construct();
		$this->currentArea = 'login';
		$this->load->model('usuario_model');
	}
	public function index() {
		if (!$this->usuario_model->usuarioLogado()) {
			if ($this->input->method() == 'post') {
				$post = $this->input->post();
				$usuario = $this->usuario_model->login($post['email'], $post['senha']);

				if ($usuario) {
					$this->session->set_userdata('usuario', $usuario);
					redirect(base_url('dashboard'));
				} else {
					redirect(base_url() . '?' . MainController::create_message('Usuário ou senha incorretos!</br> Tente novamente.', MainController::MESSAGE_TYPE_ERROR));
				}
			} else {
				$this->view = 'login/index';
				$this->load->view('login_template');
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}
	public function sair() {
		$this->usuario_model->logoutUsuario();
	}
	public function criar_conta() {
		if ($this->input->method() == 'post') {
			$this->salvar_nova_conta();
		} else {
			$this->view = 'login/create';
			$this->load->view('login_template');
		}
	}
	private function salvar_nova_conta() {
		$post = $this->input->post();

		$usuario = [];
		$usuario['nome'] = $post['nome'];
		$usuario['sobrenome'] = $post['sobrenome'];
		$usuario['email'] = $post['email'];
		$usuario['senha_md5'] = md5($post['senha']);

		$this->usuario_model->insert($usuario);

		redirect(base_url() . '?' . MainController::create_message('Usuário criado com sucesso!'));
	}
}
