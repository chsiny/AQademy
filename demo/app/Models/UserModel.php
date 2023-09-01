<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'uid';
    protected $allowedFields = ['username', 'password'];
    // you protect everything related to the database
    // you handle the authentication to a public function that only
    // gives you true or false
    public function getUser($username, $password)
    {
        $query = $this->where('username', $username)->where('password', $password)->get();
        if ($query->getRow()) return true;
        else return false;
    }
}