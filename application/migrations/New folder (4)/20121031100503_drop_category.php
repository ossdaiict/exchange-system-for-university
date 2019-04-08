<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Category extends CI_Migration {
        public function up()
        {
                $this->db->delete('category', $this->data);
                $this->dbforge->drop_table('category');
        }
        public function down()
        {
                $this->db->delete('category', $this->data);
                $this->dbforge->drop_table('category');
        }
}