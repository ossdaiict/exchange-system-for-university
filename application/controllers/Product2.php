<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product2 extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model('Product2_m', 'p2', true);
        if(!$this->ss->email)
            redirect('login/');
    }
    public function index()
    {
        $data = null;
        $data['cat'] = $this->p2->get_category();
        $this->parser->parse('add_product', $data);
    }
    public function add_product()
    {
        $this->fv->set_rules('c_name', 'Product Name', 'trim|required');
        $this->fv->set_rules('c_description', 'Description', 'trim|required');
        $this->fv->set_rules('c_price', 'Price', 'trim|required|numeric');
        $this->fv->set_rules('c_category', 'Category', 'trim|required');
        //$this->fv->set_rules('c_image', 'Image', 'trim|required');
        if($this->fv->run() == true)
        {
            $config['upload_path'] = './asset/user/img/product/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 200000;
            $config['max_width'] = 1024;
            $config['max_height'] = 1024;
            $this->load->library('upload', $config);
            $img = $this->upload->do_upload('c_main_image');
            if ($img == FALSE)
            {
                $data['cat'] = $this->p2->get_category();
                $data['error'] = $this->upload->display_errors();
                $this->parser->parse('add_product', $data);
            }
            else
            {
                $ins = null;
                $img = $this->upload->data();
                $ins = [
                    'seller_id' => $this->ss->user_id,
                    'main_image' => $img['file_name'],
                    'name' => $this->input->post('c_name'),
                    'description' => $this->input->post('c_description'),
                    'price' => $this->input->post('c_price'),
                    'category' => $this->input->post('c_category')
                ];
                $stat = $this->p2->add_product($ins);
                if($stat == true)
                {
                    $mag['msg'] = 'Product added Successfully';
                    $this->parser->parse('add_product',$mag);
                }
                else {
                    $mag['msg'] = 'Error while inserting try again';
                    $this->parser->parse('add_product',$mag);
                }
            }
        }
        else 
        {
            $data['cat'] = $this->p2->get_category();
            $this->parser->parse('add_product', $data);
        }
    }
}
?>