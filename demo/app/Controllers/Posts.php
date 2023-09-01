<?php

namespace App\Controllers;

class Posts extends BaseController
{
    protected $helpers = ['url'];

    public function index($postId)
    {
        $model = new \App\Models\Posts_model();
        $post = $model->getPost($postId);
        $comments = $model->getComments($postId);

        $data = [
            'post' => $post,
            'comments' => $model->getComments($postId)
        ];

        echo view('template/header');
        echo view('post_view', $data);
        echo view('template/footer');
    }

    public function loadPosts()
    {
        $model = new \App\Models\Posts_model();
        $start = $this->request->getPost('start');
        $data['posts'] = $model->getPosts($start, 3); // Load the next 3 posts
        echo view('loadPosts', $data);
    }

    public function upvote($postId)
    {
        $model = new \App\Models\Posts_model();
        $model->upvotePost($postId);

        // Return the upvotes count as a JSON response
        $post = $model->getPost($postId);
        $response = array('success' => true, 'upvotes' => $post->upvotes);
        return $this->response->setJSON($response);

    }

    public function bookmark($postId)
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            // If the user is not logged in, return an error response
            return redirect()->to(base_url('login'));
        }

        // Check if the post is already bookmarked by the user
        $model = new \App\Models\Posts_model();
        $isBookmarked = $model->isBookmark($username, $postId);

        if ($isBookmarked) {
            // If the post is already bookmarked, return an appropriate response
            return $this->response->setJSON([
                'status' => 'already_bookmarked',
                'message' => 'This post is already bookmarked'
            ]);
        } else {

            $result = $model->bookmark($username, $postId);
    
            if ($result) {
                // Return a success response
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Post bookmarked successfully'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error'
                ]);
            }
        }

    }

    public function getBookmarks() 
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            // If the user is not logged in, return an error response
            return redirect()->to(base_url('login'));
        }
        
        $model = new \App\Models\Posts_model();
        $data['posts'] = $model->getBookmarks($username);

        echo view("template/header");
        echo view("bookmarks", $data);
        echo view("template/footer");

    }

    public function deleteBookmark($postId)
    {
        $session = session();
        $username = $session->get('username');

        if (!$username) {
            // If the user is not logged in, return an error response
            return redirect()->to(base_url('login'));
        }

        $model = new \App\Models\Posts_model();
        $result = $model->deleteBookmark($username, $postId);
        
        return redirect()->to(base_url('bookmarks')); 

    }

    public function createComment()
    {
        $session = session();

        $username = $session->get('username');

        // check if user is logged in
        if (!$username) {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }

        $model = new \App\Models\Posts_model();

        $content = $this->request->getPost('content');
        $postId = $this->request->getPost('postId');
        $timezone = 'Australia/Brisbane';
        $timestamp = time();
        $datetime = new \DateTime("now", new \DateTimeZone($timezone));
        $datetime->setTimestamp($timestamp);
        $datetime_str = $datetime->format('Y-m-d H:i:s');
        $model->createComment($username, $content, $postId, $datetime_str);

        return redirect()->to(base_url('/post/'.$postId));
    }

    public function autocomplete() 
    {
        
        $model = new \App\Models\Posts_model();
        $query = $this->request->getVar('q');
        $results = $model->searchPosts($query);
        echo json_encode($results);
    }

    // public function search() 
    // {
    //     $model = new \App\Models\Posts_model();
    //     $postId = $this->request->getGet('postId');
    //     $post = $model->getPost($postId);
    //     $comments = $model->getComments($postId);

    //     $data = [
    //         'post' => $post,
    //         'comments' => $model->getComments($postId)
    //     ];

    //     echo view('template/header');
    //     echo view('post_view', $data);
    //     echo view('template/footer');

    // }

    public function searchPostsView()
    {
        $model = new \App\Models\Posts_model();
        $query = $this->request->getGet('searchTitle');
        // $query = urlencode($query);
        $results = $model->searchPosts($query);
        // $post = $model->getPost($postId);
        // $comments = $model->getComments($postId);

        $data['posts'] = $model->searchPosts($query);

        echo view('template/header');
        echo view('searchPost', $data);
        echo view('template/footer');
    }

}