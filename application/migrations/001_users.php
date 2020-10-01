<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'users_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'users_fullname' => array(
                                'type' => 'TEXT',
                                'constraint' => '255',
                                'null' => TRUE,
                        ),
                        'users_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'users_pass' => array(
                                'type' => 'TEXT',
                                'constraint' => '255',
                        ),
                        'users_access' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('users_id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}
