<?php

namespace App\Controllers;

class Home extends BaseController
{
    
    public function index()
    {
        $data['error']= "";
        $model = new \App\Models\Posts_model();
        $data['posts'] = $model->getPosts(0, 18);
        // check whether the cookie is set or not, if set redirect to welcome page, if not set, check the session
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            echo view("template/header");
            echo view("home", $data);
            echo view("template/footer");
        }
        else {
            $session = session();
            $username = $session->get('username');
            $password = $session->get('password');
            if ($username && $password) {
                echo view("template/header");
                echo view("home", $data);
                echo view("template/footer");
            } else {
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        }

    }

    public function loadPosts()
    {
        $model = new \App\Models\Posts_model();
        $start = $this->request->getPost('start');
        $data['posts'] = $model->getPosts($start, 3); // Load the next 3 posts
        echo view('loadPosts', $data);
    }

    public function addPost()
    {
        echo view('template/header');
        echo view('post_form');
        echo view('template/footer');
    }

    public function createPost()
    {
        $session = session();
        $timezone = 'Australia/Brisbane';
        $timestamp = time();
        $datetime = new \DateTime("now", new \DateTimeZone($timezone));
        $datetime->setTimestamp($timestamp);
        $datetime_str = $datetime->format('Y-m-d H:i:s');
        $username = $session->get('username');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $model = new \App\Models\Posts_model();

        $model->insert([
            'title' => $title,
            'content' => $content,
            'username' => $username,
            'datetime' => $datetime_str
        ]);

        // Redirect to the home page or the newly created post page
        return redirect()->to(base_url('/login'));
    }
}
