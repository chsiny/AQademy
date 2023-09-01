<?php
namespace App\Controllers;
//use CodeIgniter\HTTP\RequestInterface;
//use CodeIgniter\HTTP\ResponseInterface;
//use Psr\Log\LoggerInterface;

class Papers extends BaseController
{
    //index($first, $second)
    public function index()
    {
        return 'Display Publications here!<br>';
    }
    public function paperLookup()
    {
        return view('2021');        
    }
    public function paperLookupByYear($year=2019)
    {
        return view($year);
    }  
    public function venues()
    {
        echo 'US, UK, AUS, CN.';
    }   
    public function display1()
    {
        return 'Display 1!<br>';
    }
    public function display2()
    {
        return 'Display 2!<br>';
    }
    public function display3()
    {
        return 'Display 3!<br>';
    } 
    public function paperLookupBySeq($seq1=2020, $seq2=01,$seq3=01)
    {
        echo $seg1;
        echo $seg2;
        echo $seg3;
    }
}

?>