<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Category extends CI_Migration {
        public function __construct()
        {
                parent::__construct();
                $this->data=[
                        [
                                'category'=>'Electrics', 
                                'description'=>'all items related to tv, mobile laptop etc', 
                                'product_specification'=>'size, model. brand etc'
                        ],
                        [
                                'category'=>'Stationery',
                                'description'=>'all items related to books and notes', 
                                'product_specification'=>'subject, author etc'
                        ]
                ];
        }
        public function up()
        {
                $this->dbforge->add_field(array(
                        'category' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 50,
                        ),
                        'description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                                'null' => TRUE,
                        ),
                        'product_specification' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('category', TRUE);
                $this->dbforge->create_table('category');
                $this->load->database();
                $this->db->insert_batch('category', $this->data);
        }
        public function down()
        {
                $this->db->delete('category', $this->data);
                $this->dbforge->drop_table('category');
        }
}