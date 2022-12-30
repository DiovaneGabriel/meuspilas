<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MainModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        // $this->load->helper("formater_helper");

        $sql = "set autocommit = 1;";
        $this->execute_sql($sql);
    }
    public function execute_sql($sql) {
        $this->db->reset_query();
        $return = $this->db->query($sql);
        $this->db->flush_cache();

        return $return;
    }
    // public function execute_query($sql) {
    //     $this->db->reset_query();
    //     $query = $this->db->query($sql);
    //     $return = false;

    //     if ($this->db->error()['message']) {
    //         $error = $this->db->error();
    //         $this->db->flush_cache();
    //         self::error($error);
    //     } elseif ($query->num_rows() > 0) {
    //         $return = $query->result();
    //     }
    //     $this->db->flush_cache();

    //     return $return;
    // }
    protected function get_row($show_query = false) {
        return $this->get_result($show_query, false);
    }
    protected function get_result($show_query = false, $array = true) {
        $query = $this->db->get();
        $return = false;

        if ($this->db->error()['message']) {
            $error = $this->db->error();
            $this->db->flush_cache();
            $this->error($error);
        } elseif ($query->num_rows() > 0) {
            $return = $array ? $query->result() : $query->row();
        }
        $this->db->flush_cache();
        if ($show_query) {
            die($this->db->last_query());
            // die(sql_format($this->db->last_query()));
        }
        return $return;
    }
    // protected function get_result_array($show_query = false) {
    //     return $this->get_result($show_query, true);
    // }
    // public function commit() {
    //     $sql = "commit;";
    //     $this->execute_sql($sql);
    // }
    // public function rollback() {
    //     $sql = "rollback;";
    //     $this->execute_sql($sql);
    // }
    // protected function get_select() {
    //     $sql = $this->db->get_compiled_select();
    //     $sql = str_replace("`", "", $sql);

    //     $this->db->flush_cache();

    //     return $sql;
    // }
    public function insert_row($table, $content) {
        $this->db->insert($table, $content);
        return $this->db->insert_id();
    }
    private function error($error) {
        dump($error);
    }
}
