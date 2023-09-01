<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class User extends BaseController {

    protected $helpers = ['form'];

    public function index() {
        $data['error'] = "";
        
        $session = session();
        $username = $session->get('username');
        $password = $session->get('password');
        if ($username && $password) {
            $model = new \App\Models\User_model();
            $data['user'] = $model->getUserInfo($username);
            $data['profile_picture'] = $model->getUserPicture($username);
            if ($session->getFlashdata('validation')) { // check if it exists
                $validation = session('validation'); // to retrieve value
            }
            echo view("template/header");
            echo view("user_profile", $data);
            echo view("update_profile_form");
            echo view("template/footer");
        } else {
            return redirect()->to(base_url('/login'));

        }
    }

    public function register_page() {
        echo view('template/header');
        echo view('register_page');
        echo view('template/footer');
    }

    public function register() {
        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[4]|max_length[15]|is_unique[users.username]',
            'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'password' => 'required|min_length[4]|max_length[20]',
            'confirm_password' => 'required|min_length[4]|max_length[20]|matches[password]'
        ];

        if (! $this->validate($rules)) {
            echo view('template/header');
            echo view('register_page');
            echo view('template/footer');
        } else {
            $username = $this->request->getPost('username');
            $userEmail = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Encrypt the password
            $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

            // Email verification
            $token = bin2hex(random_bytes(32));

            $model = new \App\Models\User_model();
            $user_id = $model->register($username, $userEmail, $encrypted_password, $token);

            // If the user was successfully inserted, log them in and redirect to the home page
            if ($user_id) {
                // Email verification link
                $email = new Email();
                // $email = \Config\Services::email();
                $emailConf = [
                    'protocol' => 'smtp',
                    'wordWrap' => true,
                    'SMTPHost' => 'mailhub.eait.uq.edu.au',
                    'SMTPPort' => 25
                ];

                $sender = 'infs3202-07887fa4@uqcloud.net';
                $verificationLink = "https://infs3202-07887fa4.uqcloud.net/demo/user/verify_email/" . $token;
                $message = "
                Dear " . $username . ",\n\n

                Thank you for registering with our website. To complete your registration, please verify your email address by clicking on the link below:\n\n

                " . $verificationLink . "\n\n

                If you did not register for our website, please disregard this email.\n\n

                Thank you,\n
                AQademy";
                $email->initialize($emailConf);
                $email->setTo($userEmail);
                $email->setFrom($sender);
                $email->setSubject('Email verification');
                $email->setMessage($message);

                if ($email->send()) {
                    echo view('template/header');
                    // echo $token;
                    echo 'Success. Please check your email to verify.';
                    // echo view('emailSendSuccess_page'); 
                    echo view('template/footer');
                } else {
                    echo view('template/header');
                    echo 'Error sending email, please try again later.';
                    echo view('register_page');
                    echo view('template/footer');
                }

                // return redirect()->to(base_url('/login'));
            } else {
                // If the user was not inserted, show an error message
                $data['error'] = 'An error occurred while registering. Please try again.';
                echo view('template/header');
                echo view('register_page', $data);
                echo view('template/footer');
            }
        }
    }

    public function verify_email($token) {

        $model = new \App\Models\User_model();
        $result = $model->verifyEmail($token);

        if ($result) {
            echo view('template/header');
            echo 'Email verify successfully! You can login now.';
            echo view('template/footer');
        } else {
            echo view('template/header');
            echo 'Email verify unsuccessfully, please try again later.';
            echo view('template/footer');
        }
    }

    public function forget_password() {
        echo view('template/header');
        echo view('forget_password_form');
        echo view('template/footer');
    }

    public function send_verification() {
        $username = $this->request->getPost('username');
        $userEmail = $this->request->getPost('email');
        $token = bin2hex(random_bytes(32));

        $model = new \App\Models\User_model();
        $result = $model->forget_password($username, $userEmail, $token);

        if ($result) {

            // email verification
            $email = new Email();
            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];

            $sender = 'infs3202-07887fa4@uqcloud.net';
            $verificationLink = "https://infs3202-07887fa4.uqcloud.net/demo/user/reset_password_form/" . $token;
            $message = "
            Dear " . $username . ",\n\n

            To reset your password, please verify your email address by clicking on the link below:\n\n

            " . $verificationLink . "\n\n

            If you did not want to reset your password, please disregard this email.\n\n

            Thank you,\n
            AQademy";
            $email->initialize($emailConf);
            $email->setTo($userEmail);
            $email->setFrom($sender);
            $email->setSubject('Reset password');
            $email->setMessage($message);

            if ($email->send()) {
                echo view('template/header');
                echo 'Success. Please check your email to verify.';
                echo view('template/footer');
            } else {
                echo view('template/header');
                echo 'Error sending email, please try again later.';
                echo view('forget_password_form');
                echo view('template/footer');
            }
        } else {
            echo view('template/header');
            echo '<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or email!!</div>';
            echo view('forget_password_form');
            echo view('template/footer');
        }
    }

    public function reset_password_view($token) {
        $model = new \App\Models\User_model();
        $result = $model->verifyEmail($token);
        if ($result) {
            echo view('template/header');
            echo 'Email verified successfully, you can reset your password now.';
            echo view('reset_password_form');
            echo view('template/footer');
        } else {
            echo view('template/header');
            echo 'Email verified unsuccessfully, please try again later.';
            echo view('template/footer');
        }
    }

    public function reset_password() {

        $rules = [
            'username' => 'required|alpha_numeric_punct|min_length[4]|max_length[15]',
            'newPassword' => 'required|min_length[4]|max_length[20]',
            'confirm_password' => 'required|min_length[4]|max_length[20]|matches[newPassword]'
        ];

        if (! $this->validate($rules)) {
            echo view('template/header');
            echo view('reset_password_form');
            echo view('template/footer');
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('newPassword');
            // Encrypt the password
            $encrypted_password = password_hash($password, PASSWORD_BCRYPT);

            $model = new \App\Models\User_model();
            $result = $model->reset_password($username, $encrypted_password);
            if ($result) {
                echo view('template/header');
                echo 'Password reset successfully!';
                echo view('template/footer');
            } else {
                echo view('template/header');
                echo 'Password reset unsuccessfully, please try again later.';
                echo view('reset_password_form');
                echo view('template/footer');
            }
        }
    }

    public function update_profile() {

        $newEmail = $this->request->getPost('newEmail');
        $newPassword = $this->request->getPost('newPassword');
        $session = session();
        $username = $session->get('username');

        $model = new \App\Models\User_model();
        $model->update_profile($username, $newEmail);

        // $data['newEmail'] = $newEmail;

        return redirect()->to(base_url('/user'));

        // echo view('template/header');
        // echo view('update_profile_form', $data);
        // echo view('template/footer');

    }

}