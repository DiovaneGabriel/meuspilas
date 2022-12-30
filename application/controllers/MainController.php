<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MainController extends CI_Controller {
    const MESSAGE_TYPE_SUCCESS = "success";
    const MESSAGE_TYPE_ERROR = "error";

    public $currentArea;
    public $view;

    public function __construct($currentArea) {
        parent::__construct();
        $this->currentArea = $currentArea;
        $this->load->model('usuario_model');

        if (!$this->usuario_model->usuarioLogado()) {
            redirect(base_url());
        }
    }
    public static function create_message($text, string $type = self::MESSAGE_TYPE_SUCCESS) {
        $m = [];
        $m['text'] = $text;
        $m['type'] = $type;

        return 'message=' . urlencode(base64_encode(json_encode((object)$m)));
    }
    protected function load_view($view, $data = null) {
        $this->view = $view;
        $this->load->view('template_default', $data);
    }
}
