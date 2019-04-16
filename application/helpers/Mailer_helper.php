<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
 
if (! function_exists('tomail')) 
{
    // function tomail($to, $message_body)
    // {
    //     $ci = get_instance();
    //     $ci->load->helper('email');
    //     $con = array(
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'team007se@gmail.com',
    //         'smtp_port' => 465,
    //         'smtp_timeout' => 30,
    //         'smtp_pass' => 'teambond007'
    //     );

    //     $ci->em->initialize($con);
    //     $ci->em->from('team007se@gmail.com', 'Campus Exchange System');
    //     $ci->em->to($to);
        
    //     $ci->em->subject('Email Test');
    //     $ci->em->message($message_body);

    //     $ret = $ci->em->send();
    //     if($ret == TRUE)
    //     {
    //         return "Mail sent successfully";
    //     }
    //     else
    //     {
    //         return $ci->em->print_debugger();
    //     }
    // }

    function tomail($to, $subject, $message_body)
    {
        $ci = get_instance();
        $con = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'team007se@gmail.com',
            'smtp_port' => 465,
            'smtp_timeout' => 30,
            'smtp_pass' => 'teambond007'
        );

        $ci->em->initialize($con);
        $ci->em->from('team007se@gmail.com', 'Campus Exchange System');
        $ci->em->to($to);
        
        $ci->em->subject($subject);
        $ci->em->message($message_body);

        $ret = $ci->em->send();
        if($ret == TRUE)
        {
            return TRUE;
        }
        else
        {
            return $ci->em->print_debugger();
        }
    }
}


    // public function send_mail_MAB_by_seller($to_buyer, $product_id, $product_name, $seller_name)
    // {
    //     $data['id'] = $product_id;
    //     $data['name'] = $product_name;
    //     $data['seller'] = $seller_name;
    //     $subject = $data['name']." is marked as sold to you";
    //     $msg = $this->parser->parse('mail/marked_as_bought_by_seller',$data);
    //     $p = tomail($to_buyer, $subject, $msg);

    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }

    // public function send_mail_MAB_by_buyer($to_seller, $product_id, $product_name, $buyer_name)
    // {
    //     $data['id'] = $product_id;
    //     $data['name'] = $product_name;
    //     $data['buyer_name'] = $buyer_name;
    //     $msg = $this->parser->parse('mail/marked_as_bought_by_buyer',$data);
    //     $subject = $data['name']." is marked as bought";
    //     $p = tomail($to_seller, $subject, $msg);
        
    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }
if (! function_exists('send_mail_register_verification')) 
{
    function send_mail_register_verification($to, $student_id, $key)
    {
        $ci = get_instance();
        $data['id'] = $student_id;
        $data['key'] = $key;
        $msg = $ci->parser->parse('mail/registration',$data);
        $subject = 'Thank You for Registering';
        $p = tomail($to, $subject, $msg);
        
        //IF ERROR THEN WHAT???
        if($p != TRUE)
        {
            
        }
    }
}
    // public function send_mail_report_threshold_to_seller($to_seller, $name)
    // {
    //     $data['name'] = $name;
    //     $msg = $this->parser->parse('mail/report',$data);
    //     $subject = $name." is blocked";
    //     $p = tomail($to_seller, $subject, $msg);
        
    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }

    // public function send_mail_forgot_password($to, $password)
    // {
    //     $data['pass'] = $password;
    //     $msg = $this->parser->parse('mail/forgot_password',$data);
    //     $subject = 'Forgot Password';
    //     $p = tomail($to, $subject, $msg);
        
    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }

    // public function send_mail_MAB_rejected_by_seller($to_buyer, $product_name, $buyer_name)
    // {
    //     $data['name'] = $product_name;
    //     $data['buyer'] = $buyer_name;
    //     $msg = $this->parser->parse('mail/mab_rejected_by_seller', $data);
    //     $subject = "Change request for product status rejected";
    //     $p = tomail($to_buyer, $subject, $msg);
        
    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }

    // public function send_mail_MAB_rejected_by_buyer($to_seller, $product_name, $seller_name)
    // {
    //     $data['name'] = $product_name;
    //     $data['seller'] = $seller_name;
    //     $msg = $this->parser->parse('mail/mab_rejected_by_buyer',$data);
    //     $subject = "Change request for product status rejected";
    //     $p = tomail($to_seller, $subject, $msg);
        
    //     //IF ERROR THEN WHAT???
    //     if($p != TRUE)
    //     {
            
    //     }
    // }

?>