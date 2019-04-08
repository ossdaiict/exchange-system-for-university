<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Product extends CI_Migration {
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
                $this->dbforge->add_field([
                        'product_id' => [
                                'type' => 'SERIAL',
                        ],
                        'seller_id' => [
                                'type' => 'INT',
                                'constraint' => 9,
                        ],
                        'name' => [
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ],
                        'description' => [
                                'type' => 'VARCHAR',
                                'constraint' => 1000,
                        ],
                        'price' => [
                                'type' => 'INT',
                                'constraint' => 11,
                        ],
                        'status' => [
                                'type' => 'TINYINT',
                                'default'=> 0
                        ],
                        'status' => [
                                'type' => 'VARCHAR',
                                'constraint' => 50,
                        ],
                        'date_added' => [
                                'type' => 'TIMESTAMP',
                                'default' => 'CURRENT_TIMESTAMP'
                        ],
                        'expiry_date' => [
                                'type' => 'TIMESTAMP',
                        ]
                ]);
                $this->dbforge->add_key('product_id', TRUE);
                $this->dbforge->create_table('product');
                $this->load->database();
                $this->db->insert_batch('product', $this->data);
        }
        public function down()
        {
                $this->db->delete('category', $this->data);
                $this->dbforge->drop_table('category');
        }
}