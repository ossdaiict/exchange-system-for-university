<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_mailer extends CI_Controller
{
    public function index()
    {
        $this->registration_mail('201812112@daiict.ac.in');
    }
   /* public function registration_mail($to,$secret_key)
    {
        $con = NULL;
        $msg = ;
        $p = tomail($to,'Thanks for Registration',$msg);
        echo $p;
    } */
    public function send_mail_MAB_by_seller($to_buyer, )
    {

    }

    public function send_mail_MAB_by_buyer($to_seller, )
    {

    }

    public function send_mail_register_verification($to, $key)
    {

    }

    public function send_mail_report_threshold_to_seller($to_seller, )
    {

    }

    public function send_mail_forgot_password($to, )
    {
        
    }

    public function send_mail_MAB_rejected_by_seller()
    {

    }

    public function send_mail_MAB_rejected_by_buyer()
    {
        
    }
}
?>