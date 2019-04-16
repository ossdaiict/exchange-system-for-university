<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_mailer extends CI_Controller
{
    public function index()
    {
        //TESTING DATA

        //$this->send_mail_MAB_by_buyer('201812112@daiict.ac.in', array('id' => 50, 'name' => 'MOTO'));
        // $var = array(
        //     'name' => 'MOTO',
        //     'id' => 50,
        //     'seller' => 'GUNDECHA',
        //     'buyer' => 'Vardhan'
        // );
        // $to = '201812112@daiict.ac.in';
        // $this->send_mail_MAB_by_buyer($to, $var);
        // $this->send_mail_MAB_by_seller($to, $var);
        // $this->send_mail_report_threshold_to_seller($to, 'MOTO');
        // $this->send_mail_forgot_password($to, "12345678");
        // $this->send_mail_MAB_rejected_by_seller($to, $var);
        // $this->send_mail_MAB_rejected_by_buyer($to, $var);
        // $this->send_mail_register_verification($to, "BHAI");
    }

    public function send_mail_MAB_by_seller($to_buyer, $product_id, $product_name, $seller_name)
    {
        $data['id'] = $product_id;
        $data['name'] = $product_name;
        $data['seller'] = $seller_name;
        $subject = $data['name']." is marked as sold to you";
        $msg = $this->parser->parse('mail/marked_as_bought_by_seller',$data);
        $p = tomail($to_buyer, $subject, $msg);

        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_MAB_by_buyer($to_seller, $product_id, $product_name, $buyer_name)
    {
        $data['id'] = $product_id;
        $data['name'] = $product_name;
        $data['buyer_name'] = $buyer_name;
        $msg = $this->parser->parse('mail/marked_as_bought_by_buyer',$data);
        $subject = $data['name']." is marked as bought";
        $p = tomail($to_seller, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_register_verification($to, $key)
    {
        $data['key'] = $key;
        $msg = $this->parser->parse('mail/registration',$data);
        $subject = 'Thank You for Registering';
        $p = tomail($to, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_report_threshold_to_seller($to_seller, $name)
    {
        $data['name'] = $name;
        $msg = $this->parser->parse('mail/report',$data);
        $subject = $name." is blocked";
        $p = tomail($to_seller, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_forgot_password($to, $password)
    {
        $data['pass'] = $password;
        $msg = $this->parser->parse('mail/forgot_password',$data);
        $subject = 'Forgot Password';
        $p = tomail($to, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_MAB_rejected_by_seller($to_buyer, $product_name, $buyer_name)
    {
        $data['name'] = $product_name;
        $data['buyer'] = $buyer_name;
        $msg = $this->parser->parse('mail/mab_rejected_by_seller', $data);
        $subject = "Change request for product status rejected";
        $p = tomail($to_buyer, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }

    public function send_mail_MAB_rejected_by_buyer($to_seller, $product_name, $seller_name)
    {
        $data['name'] = $product_name;
        $data['seller'] = $seller_name;
        $msg = $this->parser->parse('mail/mab_rejected_by_buyer',$data);
        $subject = "Change request for product status rejected";
        $p = tomail($to_seller, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }
}
?>