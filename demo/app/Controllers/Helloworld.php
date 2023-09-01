<?php
namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
class Helloworld extends BaseController
{
    public int $init_value = 0;
    
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
       // echo $this->init_value;
        $this->init_value=1;
       // echo $this->init_value;        
    }
    public function index($first='Sen', $second='Wang')
    {
        $table = new \CodeIgniter\View\Table();
        $data = [
            ['Name', 'Color', 'Size'],
            ['Fred', 'Blue', 'Small'],
            ['Mary', 'Red', 'Large'],
            ['John', 'Green', 'Medium'],
        ];
        $template = [
            'table_open' => '<table border="4" cellpadding="1" cellspacing="2" class="mytable">',
        ];
        $table->setTemplate($template);
        echo $table->generate($data);           

        return 'Hello World! (in Hello World)'.$first.' '.$second.'<br>';
    }
    public function comment()
    {
        return 'I am not flat! (in Hello World)';
    }   

}
?>