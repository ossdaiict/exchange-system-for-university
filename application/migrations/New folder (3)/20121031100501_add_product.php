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
                        'product_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
                        'seller_id' => array(
                                'type' => 'INT',
                                'constraint' => 9,
                        ),
                        'name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 200,
                        ),
                        'description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 1000,
                        ),
                        'price' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                        ),
                        'status' => array(
                                'type' => 'TINYINT',
                                'constraint' => 4,
                        ),

                        CREATE TABLE `product` (
                                `price` int(11) NOT NULL,
                                `status` tinyint(4) NOT NULL DEFAULT '0',
                                `category` varchar(50) NOT NULL,
                                `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                `expiry_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
                              )



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