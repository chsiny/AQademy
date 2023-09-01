<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload extends Model
{
    public function upload($title, $filename)
    {
        $file = [
            'title' => $title,
            'filename' => $filename,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('Uploads');
        if ($builder->insert($file)) {
            return true;
        } else {
            return false;
        }
    }
        
}