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
        $date = time();
        $dt = date("Y-m-d H:m:s", $date);
        $data = null;
        $val = $this->p2->get_status(array('seller_id' => $this->ss->user_id, 
        'expiry_date < ' => $dt));
        if(count($val)>0)
        {
            $data['past'] = $val;
            $this->parser->parse('add_product', $data);
        }
        else 
        {
            $data['cat'] = $this->p2->get_category();
            $this->parser->parse('add_product', $data);   
        }
    }
    public function add_product()
    {
        $this->load->helper('date');
        $expiry_date = now() + (60*60*24*90);
        $dt = date("Y-m-d H:m:s", $expiry_date);
        $this->fv->set_rules('c_name', 'Product Name', 'trim|required');
        $this->fv->set_rules('c_description', 'Description', 'trim|required');
        $this->fv->set_rules('c_price', 'Price', 'trim|required|numeric');
        $this->fv->set_rules('c_category', 'Category', 'trim|required|callback_cat_check');
        $this->fv->set_rules('c_is_negotiable', 'Negotiable', 'trim|required|less_than[2]|greater_than[-1]');
        $this->fv->set_rules('c_return_window', 'Return Window', 'trim|required|less_than[8]|greater_than[-1]');
        //$this->fv->set_rules('c_image', 'Image', 'required');
        if($this->fv->run() == true)
        {
            //varibales for image
            $config['upload_path'] = './asset/user/img/product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;

            //IMAGE UPLOAD and library calling
            $this->load->library('upload', $config);
            $img = $this->upload->do_upload('c_main_image');
            
            //If upload fails redirect to  add product page
            if ($img == FALSE)
            {
                $data['cat'] = $this->p2->get_category();
                $data['error'] = $this->upload->display_errors();
                $this->parser->parse('add_product', $data);
            }
            
            //if upload succeed then insert data
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
                    'category' => $this->input->post('c_category'),
                    'return_window' => $this->input->post('c_return_window'),
                    'is_negotiable' => $this->input->post('c_is_negotiable'),
                    'expiry_date' => $dt
                ];
                $stat = $this->p2->add_product($ins);
                $mag['msg'] = "Product added successfully";
                //if insert is successful then upload secondary images
                if($stat == true)
                {
                    $id = $this->db->insert_id();
                    $uploadImgData = NULL;
                    $img = count($_FILES['c_sec_image']['name']);

                    //check whether secondary image field contains any value or not
                    if($img > 0 && $_FILES['c_sec_image']['name'][0] != "")
                    {
                        $rr = NULL;
                        for($i = 0; $i < $img; $i++)
                        {
                            $_FILES['file']['name']       = $_FILES['c_sec_image']['name'][$i];
                            $_FILES['file']['type']       = $_FILES['c_sec_image']['type'][$i];
                            $_FILES['file']['tmp_name']   = $_FILES['c_sec_image']['tmp_name'][$i];
                            $_FILES['file']['error']      = $_FILES['c_sec_image']['error'][$i];
                            $_FILES['file']['size']       = $_FILES['c_sec_image']['size'][$i];

                            //$this->load->library('upload', $config);

                            // Upload file to server
                            if($this->upload->do_upload('file')){
                                // Uploaded file data
                                $imageData = $this->upload->data();
                                $uploadImgData[$i]['product_id'] = $id;
                                $uploadImgData[$i]['other_image'] = $imageData['file_name'];
                                if($this->upload->display_errors() == "")
                                    $mag['error_msg'] = $rr++." files unable to upload due to image size greater than 2 MB.";
                            }
                        }
                        $v = $this->p2->add_image($uploadImgData);
                        if($v == true)
                        {
                            $this->parser->parse('add_product',$mag);
                        }
                        else {
                            $mag['error_msg'] = "Error uploading other images. please try after sometime";
                            $this->parser->parse('add_product',$mag);
                        }
                    }
                    //if secondary image doesn't have any value then redirect to page
                    else
                    {
                        $this->parser->parse('add_product', $mag);
                    }
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
    public function cat_check($str)
    {
        $cat = array('category' => $str);
        if( ! $this->p2->get_category_where($cat))
        {
            $this->fv->set_message('cat_check', 'The {field} field must have valid category from the list');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    public function update($val)
    {
        $sel = substr($this->ss->email, 0, 9);
        $wh = array('seller_id' => $sel, 'product_id' => $val);
        $data['product'] = $this->p2->upload_product_check($wh);
        
        //if product is not uploaded by user then redirect to other page(ERROR 404)
        if(count($data['product']) === 0)
        {
            redirect('./Product2/');
        }

        //else open update form
        else 
        {
            $data['cat'] = $this->p2->get_category();
            $this->parser->parse('update_product', $data);
        }
    }
    public function update_product($id)
    {
        //$this->parser->parse('update_product', $data);
        $this->fv->set_rules('u_name', 'Product Name', 'trim|required');
        $this->fv->set_rules('u_description', 'Description', 'trim|required');
        $this->fv->set_rules('u_price', 'Price', 'trim|required|numeric');
        $this->fv->set_rules('u_is_negotiable', 'Negotiable', 'trim|required|less_than[2]|greater_than[-1]');
        $this->fv->set_rules('u_return_window', 'Return Window', 'trim|required|less_than[8]|greater_than[-1]');
        if($this->fv->run() == true)
        {
            $where = array('product_id' => $id);
            $upd = NULL;
            $upd = [
                'name' => $this->input->post('u_name'),
                'description' => $this->input->post('u_description'),
                'price' => $this->input->post('u_price'),
                'return_window' => $this->input->post('u_return_window'),
                'is_negotiable' => $this->input->post('u_is_negotiable')
            ];
            $this->p2->update_product_m($upd,$where);
            $config['upload_path'] = './asset/user/img/product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['encrypt_name'] = TRUE;
            $config['detect_mime'] = TRUE;

            //IMAGE UPLOAD and library calling
            $this->load->library('upload', $config);
            if($_FILES['u_main_image']['name'] != '')
            {
                $img = $this->upload->do_upload('u_main_image');

                if ($img == FALSE)
                {
                    $data['error'] = $this->upload->display_errors();
                    $this->parser->parse('update_product', $data);
                }
                else 
                {
                    // $this->load->helper('file');
                    // $image_del = $this->p2->get_main_image($id);
                    // $path = base_url('/assets/user/img/product/'.$image_del[0]->main_image);
                    // echo $path;
                    // delete_files($path)or die("UNABLE");
                    // unlink(realpath($image_del[0]->main_image))or die("DEL NAI KIYA");
                    $img = $this->upload->data();
                    $upd = [
                        'main_image' => $img['file_name']
                    ];
                    $this->p2->update_product_m($upd,$where);
                }   
            }
            if(count($_FILES['u_sec_image']['name']) > 0 && $_FILES['u_sec_image']['name'][0] != "")
            {
                //$config = NULL;
                $uploadImgData = NULL;
                $img = count($_FILES['u_sec_image']['name']);

                $rr = NULL;
                for($i = 0; $i < $img; $i++)
                {
                    $_FILES['file']['name']       = $_FILES['u_sec_image']['name'][$i];
                    $_FILES['file']['type']       = $_FILES['u_sec_image']['type'][$i];
                    $_FILES['file']['tmp_name']   = $_FILES['u_sec_image']['tmp_name'][$i];
                    $_FILES['file']['error']      = $_FILES['u_sec_image']['error'][$i];
                    $_FILES['file']['size']       = $_FILES['u_sec_image']['size'][$i];

                    // $this->load->library('upload', $config);

                    // Upload file to server
                    if($this->upload->do_upload('file')){
                        // Uploaded file data
                        $imageData = $this->upload->data();
                        $uploadImgData[$i]['product_id'] = $id;
                        $uploadImgData[$i]['other_image'] = $imageData['file_name'];
                        if($this->upload->display_errors() != "")
                        {
                            $mag['error_msg'] = $rr++." files unable to upload due to image size greater than 2 MB.";
                        }
                    }
                }

                $secondary_image = $this->p2->get_secondary_image(array('product_id' => $id));
                if($secondary_image != NULL)
                {
                    $succ = $this->p2->delete_secondary_image(array('product_id' => $id));
                }
                $v = $this->p2->add_image($uploadImgData);
            }
            redirect('./Product2/update/'.$id);
        }
        else {
            $sel = substr($this->ss->email, 0, 9);
            $wh = array('seller_id' => $sel, 'product_id' => $id);
            $data['product'] = $this->p2->upload_product_check($wh);
            $data['cat'] = $this->p2->get_category();
            $this->parser->parse('update_product', $data);
        }
    }
    public function availablity($id)
    {
        $this->load->helper('date');
        $expiry_date = now() + (60*60*24*90);
        $dt = date("Y-m-d H:m:s", $expiry_date);

        $upd = array('expiry_date' => $dt);
        $this->p2->update_product_m($upd, array('product_id' => $id));
        redirect("./Product2/");
    }
}
?>