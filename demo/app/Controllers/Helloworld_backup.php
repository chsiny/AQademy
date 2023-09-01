<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Helloworld extends BaseController
{
    
    //index($first, $second)
    public function index($first='Sen', $second='Wang')
    {
        return 'Hello World! (in Hello World) from '.$first.' '.$second.'<br>';
    }
    public function comment()
    {
        return 'I am not flat! (in Hello World)';
    }  
    protected function utility()
    {
        return 'I am a procted utility';
    }
    private function check()
    {
        return 'I am a private checker';
    }
    public int $init_value = 0;
    
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        echo $this->init_value.'<br>';
        $this->init_value=1;
        echo $this->init_value.'<br>';        
    }

}

?>
