<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_user_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'familia_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'sobrenome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'senha_md5' => array(
                'type' => 'CHAR',
                'constraint' => '32',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('usuario');
    }

    public function down() {
        $this->dbforge->drop_table('usuario');
    }
}
