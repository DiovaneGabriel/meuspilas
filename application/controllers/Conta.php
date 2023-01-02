<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'Cadastro.php';

class Conta extends Cadastro {
	function __construct() {
		parent::__construct('conta', 'conta\editar', 'Nova Conta');
	}
	public function index() {
		$this->load_view('conta/index');
	}
	public function editar($id = 'novo') {
		$this->load_view('conta/edit');
	}
}
