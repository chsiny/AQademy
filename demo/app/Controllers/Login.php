<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index() {
        $data['error']= "";
        $model = new \App\Models\Posts_model();
        // $data['posts'] = $model->getPosts(0, 12);
        // check whether the cookie is set or not, if set redirect to welcome page, if not set, check the session
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            return redirect()->to(base_url('/'));
            // echo view("template/header");
            // echo view("home", $data);
            // echo view("template/footer");
        }
        else {
            $session = session();
            $username = $session->get('username');
            $password = $session->get('password');
            if ($username && $password) {
                return redirect()->to(base_url('/'));
                // echo view("template/header");
                // echo view("home", $data);
                // echo view("template/footer");
            } else {
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        }
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username, password or emial is not verified. </div> ";
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $captcha_response = $this->request->getPost('g-recaptcha-response'); // get the reCAPTCHA response from the form
        $secret_key = '6Ld7a7YlAAAAALPnkzwibX5Gcw9anq0Vjtv_3FH6'; // replace with your reCAPTCHA secret key
        $url = 'https://www.google.com/recaptcha/api/siteverify'; // reCAPTCHA verification endpoint
        $data = [
            'secret' => $secret_key,
            'response' => $captcha_response
        ];
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $result = json_decode(file_get_contents($url, false, $context)); // send a request to the reCAPTCHA verification endpoint
        if ($result->success) { // check if the reCAPTCHA verification was successful
            $model = new \App\Models\User_model();
            $check = $model->login($username, $password);
            // $model = new \App\Models\Posts_model();
            // $data['posts'] = $model->getPosts();
            $if_remember = $this->request->getPost('remember');
            if ($check) {
                $session = session();
                $session->set('username', $username);
                $session->set('password', $password);
                if ($if_remember) {
                    # Create a cookie
                    setcookie('username', $username, time() + (600), "/");
                    setcookie('password', $password, time() + (600), "/");
                }
                return redirect()->to(base_url('/'));
                // echo view("template/header");
                // echo view("home", $data);
                // echo view("template/footer");
            } else {
                // return redirect()->to(base_url('/login'));
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username, password or emial is not verified. </div> ";
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        } else {
            // reCAPTCHA verification failed
            $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> reCAPTCHA verification failed. Please try again. </div> ";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }

    }

    public function logout() {
        $session = session();
        $session->destroy();
        //destroy the cookie
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        return redirect()->to(base_url('/'));
    }
}