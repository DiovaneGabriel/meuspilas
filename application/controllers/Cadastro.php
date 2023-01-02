<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once 'MainController.php';

class Cadastro extends MainController {
	public $newUrl;
	public $newLabel;
	function __construct($currentArea, $newUrl, $newLabel) {
		parent::__construct($currentArea);
		$this->newUrl = $newUrl;
		$this->newLabel = $newLabel;
	}
}
