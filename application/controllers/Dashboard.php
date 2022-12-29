<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'usuario_model', '', TRUE );
	}
	public function index() {
		if ($this->usuario_model->usuarioLogado ()) {
			$data ['currentArea'] = 'dashboard';
			$this->load->view ( 'dashboard/index', $data );
		} else {
			$data ['currentArea'] = 'login';
			$this->load->view ( 'login/index', $data );
		}
	}
}
