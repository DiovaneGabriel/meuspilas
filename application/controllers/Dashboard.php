<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'MainController.php';

class Dashboard extends MainController {
	function __construct() {
		parent::__construct('dashboard');
		$this->load->model('usuario_model', '', TRUE);
	}
	public function index() {
		$this->load->view('dashboard/index');
	}
}
