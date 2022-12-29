<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Movimentos extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'usuario_model', '', TRUE );
		$this->load->model ( 'conta_model', '', TRUE );
	}
	public function index() {
		if ($this->usuario_model->usuarioLogado ()) {
			$data ['currentArea'] = 'movimentos';
			$this->load->view ( 'movimento/index', $data );
		} else {
			$data ['currentArea'] = 'login';
			$this->load->view ( 'login/index', $data );
		}
	}
	public function adicionar() {
		
		$data ['entradaSaida'] = $this->uri->segment ( 3 );
		$data ['contas'] = $this->conta_model->getContas();
		
		if($data ['entradaSaida'] == 'e'){
			$data ['titulo'] = 'Adicionar Receita';
		}else{
			$data ['titulo'] = 'Adicionar Despesa';
			
		}
		
		if ($this->usuario_model->usuarioLogado ()) {
			$data ['currentArea'] = 'movimento';
			$this->load->view ( 'movimento/edit', $data );
		} else {
			$data ['currentArea'] = 'login';
			$this->load->view ( 'login/index', $data );
		}
	}
	public function salvar() {
		
		var_dump($_POST);die();
	}
}
