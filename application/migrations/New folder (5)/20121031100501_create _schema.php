<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Category extends CI_Migration {
        public function up()
        {
                $this->load->database();
                $this->db->query("CREATE SCHEMA campus_exchange");
		$this->db->query("SET search_path TO campus_exchange");
        }
        public function down()
        {
                $this->load->database();
                $this->db->query("DROP SCHEMA campus_exchange");
		$this->db->query("SET search_path TO public");
        }
}