<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_blog extends CI_Migration {

        public function up()
        {
                $this->dbforge->drop_table('blog');
                $this->dbforge->drop_table('blog3');
        }

        public function down()
        {
                $this->dbforge->drop_table('blog');
        }
}