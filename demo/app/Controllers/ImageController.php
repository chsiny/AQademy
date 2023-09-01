<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ImageModel;
use CodeIgniter\Files\File;

class ImageController extends Controller
{
    public function index()
    {
        helper(['form', 'url']);
        //phpinfo();
        
        return view('image_form');
    }

    public function upload()
    {
        helper(['form', 'url']);
        
        $rules = [
            'image' => 'uploaded[image]|max_size[image,1024]|ext_in[image,jpg,jpeg,png,gif]',
        ];
        
        if ($this->validate($rules)) {
            $image = $this->request->getFile('image');
            
            $newName = $image->getRandomName();
            
            $path = ROOTPATH.'writable/uploads/';

            $image->move($path,$newName);

            $imageModel = new ImageModel();

            // Crop the image
            $cropImage = $imageModel->crop($path,$newName);

            // Rotate the image
            $rotImage = $imageModel->rotate($path, $newName,60);          
            
            $data['success'] = 'Image uploaded successfully.';
            $data['original'] = '/demo/writable/uploads/'.$newName;
            $data['original_info'] = new File(ROOTPATH.'writable/uploads/'.$newName); 
            $data['crop'] = '/demo/writable/uploads/'.$cropImage;
            $data['rot'] = '/demo/writable/uploads/'.$rotImage;            

            return view('image_form', $data);
        } else {
            $data['validation'] = $this->validator;
            return view('image_form', $data);
        }
    }
    public function getFiles()
    {
        helper(['form', 'url']);
        $path = 'uploads/';
        $files = scandir(WRITEPATH.$path);
        $data['files'] = $files;
		return view('image_form', $data);
    }
    public function zipFiles()
    {
        helper(['form', 'url']);
        $path = 'uploads/';
        $files = scandir(WRITEPATH.$path);
        $files = array_diff($files,['.','..']);

        $zip = new \ZipArchive();
        $zipFileName = WRITEPATH.'uploads/archive.zip';
        //echo $zipFileName;

        if ($zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            die('Unable to open/create zip file');
        }
        
        // Add each file to the zip archive
        foreach ($files as $file) {
            // Get the full path to the file            
            if ($file === 'archive.zip') 
            {
                echo "Skipping the existing archive.zip"."<br>";
                continue;
            }
            $filePath = WRITEPATH.'uploads/'.$file;            
            // Add the file to the zip archive
            $zip->addFile($filePath, $zipFileName);
        }
        
        // Close the zip archive
        $zip->close();
        echo "Successfully zip all the image files to ".$zipFileName;
        return view('image_form');
    }
    
    public function delFiles()
    {
        helper(['form', 'filesystem']);
        $delPath = WRITEPATH.'uploads/';
        delete_files($delPath);
        echo "Successfully delete all the image files!";
        return view('image_form');
    }
}