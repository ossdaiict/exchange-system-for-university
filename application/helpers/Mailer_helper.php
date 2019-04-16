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
?>