<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\UserModel;
use App\Models\PubModel;


class AuthController extends Controller{
    public $session;
    public function index()
    {
        helper(['cookie','form']);
        echo view('login');
    }
    public function login()
    {
        helper(['cookie','form']);
        
        if ($this->request->getMethod()=='post')
        {
            $session = session();
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // verify your username and password with the ones in database
            // it's what we are going to learning in MVC-Modadel            
            //1. database class;
            $db = \Config\Database::connect();
            //$query = $db->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
            //2. Query Builder;
            $builder = $db->table('users');
            $query = $builder->where('username',$username)->where('password',$password)->get();
            //if($username=="infs" && $password=="3202")
            //3. Model Class
            $model = new UserModel();
            if($model->getUser($username,$password))
            {
                // login with correct password
                // start a session
                $session->set('isLoggedIn', true);
                $session->set('user',$username);
                // set a cookie
                set_cookie('isLoggedIn', 'true', 30);
                $pubs=[];
                // use QB
                //$pubs = $db->table('Publication')->get()
                //        ->getResultArray();  
                // use Model
                $pbm = new PubModel();
                $pubs = $pbm->getPub($username, 2023);
                $d = ['message' =>'A Message from your Controller',
                        'year' =>'2023',
                        'pubs' => $pubs];
                
                return view('main',$d);

            }
            else
            {
                // setFlashdata() is a method provided by the session library in CodeIgniter. 
                // It is used to store data in the session that will only be available for the next server request and then automatically removed.
                // This is particularly useful for displaying one-time messages, such as success or error notifications, after an action has been performed (e.g., form submission, user registration, or data deletion).
                $session->setFlashdata('error', 'Invalid Username or Password!');
                echo "$username <br>";
                echo "$password <br>";
                //echo $_SESSION['user'];
            }
            
        }        
        
        return view('login');
    }


    public function logout()
    {
        helper(['cookie','form']);
        $session = session();
        $session->destroy();        
        helper('cookie');
        delete_cookie('isLoggedIn');
        if(!isset($_SESSION['user'])) 
        {
            echo "Session variable is there!";
            // session expired could raise error;
            //echo $_SESSION['user'];

        }
        else 
        { 
            echo "Session variable is deleted!";
            //echo $_SESSION['user'];
        }
        return view('login');        
    }

    public function getAJAXResult()
    {
        // add code    
        $request = $this->request;
        $session = session();
        $username = $_SESSION['user'];                
        //is('ajax') is equal to isAJAX()
        //if($request->is('get')){
        if($request->isAJAX()){        
            echo "AJAX is working!";
            $pbm = new PubModel();
            $pubs = $pbm->getAllMyPub($username);
            //$response = ['status' => true,
            //            'message' => 'This is an AJAX request.',
            //           'allpubs' => $pubs];
            
            header('Content-Type: application/json');
            echo json_encode($pubs);          
       
        }        
    }
}













/*
echo "Start working!";
        $request = $this->request;
        $session = session();
        $username = $_SESSION['user'];                
        //is('ajax') is equal to isAJAX()
        //if($request->is('get')){
        if($request->isAJAX()){        
            echo "AJAX is working!";
            $pbm = new PubModel();
            $pubs = $pbm->getAllMyPub($username);
            //$response = ['status' => true,
            //            'message' => 'This is an AJAX request.',
            //           'allpubs' => $pubs];
            
            header('Content-Type: application/json');
            echo json_encode($pubs);          
       
        }        
        echo "Not working!"; 
        */