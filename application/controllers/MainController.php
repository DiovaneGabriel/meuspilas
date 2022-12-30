<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MainController extends CI_Controller {
    const MESSAGE_TYPE_SUCCESS = 0;
    const MESSAGE_TYPE_ERROR = 0;

    public $currentArea = '';

    public function __construct($currentArea) {
        parent::__construct();
        $this->currentArea = $currentArea;
        $this->load->model('usuario_model');

        if (!$this->usuario_model->usuarioLogado()) {
            redirect(base_url());
        }
    }
    public static function create_message($text, int $type = self::MESSAGE_TYPE_SUCCESS) {
        $m = [];
        $m['text'] = $text;
        $m['type'] = $type;

        return 'message=' . urlencode(base64_encode(json_encode((object)$m)));
    }
}
