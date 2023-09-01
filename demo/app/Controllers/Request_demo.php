<?php
namespace App\Controllers;

use CodeIgniter\Controller;
//use CodeIgniter\HTTP\IncomingRequest;

class Request_demo extends Controller
{
    //index($first, $second)
    public function index()
    {
        echo 'Demo Request Class here!<br>';

        $request = service('request');

        // Get the request method
        $method = $request->getMethod();
        // Get the request URI
        $uri = $request->uri->getPath();
        // Get the request IP address
        $ip = $request->getIPAddress();
        // Get Server data
       
        // Do something with the request information
        echo "Method: $method<br>";
        echo "URI: $uri<br>";
        echo "IP Address: $ip<br>";        
    }    
}

?>