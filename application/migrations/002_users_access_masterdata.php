<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users_access_masterdata extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'access_id' => array(
                                'type' => 'int',
                                'constraint' => 5,
                                'unsigned' => TRUE
                        ),
                        'access_name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                ));
                $this->dbforge->add_key('access_id', TRUE);
                $this->dbforge->create_table('user_access_masterdata');
        }

        public function down()
        {
                $this->dbforge->drop_table('user_access_masterdata');
        }
}
