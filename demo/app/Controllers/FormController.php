<?php

namespace App\Controllers;

use Config\Services;

class FormController extends BaseController
{
    protected $helpers = ['form'];

    public function getFormData()
    {
        
        if (strtolower($this->request->getMethod()) !== 'post') {            
            return view('signup');
        }

        $rules = [
            'username' => 'required|min_length[4]|alpha_numeric',
            'password' => 'required|min_length[10]',
            'passconf' => 'required|matches[password]',
            'email'    => 'required|valid_email',
        ];             

        if (! $this->validate($rules)) {
        
            echo "Not Validated!";
            return view('signup');
        }

        return view('success');
    }
}