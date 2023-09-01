<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class EmailController extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('email_form');
    }
    public function send()
    {
        helper(['form']);
        // add code here!
        $receiver = $this->request->getVar('receiver');
            $sender = $this->request->getVar('sender');
            $subject = $this->request->getVar('subject');
            $message = $this->request->getVar('message');
            // echo $receiver, $sender, $subject, $message;
            $email = new Email();

            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $email->initialize($emailConf);
            
            $email->setTo($receiver);
            $email->setFrom($sender);
            $email->setSubject($subject);
            $email->setMessage($message);


        if ($email->send()) {
            Echo 'Email sent successfully!';
            return view('email_form');
        } else {
            Echo 'Error sending email. Please try again later.';
            return view('email_form');
        }
    }






/*    $receiver = $this->request->getVar('receiver');
    $sender = $this->request->getVar('sender');
    $subject = $this->request->getVar('subject');
    $message = $this->request->getVar('message');
    // echo $receiver, $sender, $subject, $message;
    $email = new Email();

    $emailConf = [
        'protocol' => 'smtp',
        'wordWrap' => true,
        'SMTPHost' => 'mailhub.eait.uq.edu.au',
        'SMTPPort' => 25
    ];
    $email->initialize($emailConf);
    
    $email->setTo($receiver);
    $email->setFrom($sender);
    $email->setSubject($subject);
    $email->setMessage($message);*/
}