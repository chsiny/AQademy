<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'emailToken', 'emailVerified'];

    public function login($username, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('emailVerified', 1);
        $query = $builder->get();
        $user = $query->getRow();
        
        if ($user && password_verify($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function register($username, $email, $encrypted_password, $token) {
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $encrypted_password,
            'emailToken' => $token
        ];

        return $this->insert($data);
    }

    public function verifyEmail($token) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'emailVerified' => 1
        ];
        
        $builder->where('emailToken', $token);
        return $builder->update($data);
    }

    public function verifyToken($token) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('emailToken', $token);
        $result = $builder->get();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function forget_password($username, $email, $token) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'emailToken' => $token
        ];
        
        $builder->where('username', $username);
        $builder->where('email', $email);
        return $builder->update($data);
    }

    public function reset_password($username, $password) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'password' => $password
        ];
        
        $builder->where('username', $username);
        return $builder->update($data);
    }

    public function getUserInfo($username) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getUserPicture($username) {
        $db = \Config\Database::connect();
        $builder = $db->table('Uploads');
        $builder->select('*');
        $builder->where('title', $username);
        $query = $builder->get();
        return $query->getRow();
    }
    
    public function update_profile($username, $newEmail) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'email' => $newEmail
        ];
        
        $builder->where('username', $username);
        $builder->update($data);
        
    }

    public function update_profile_picture($username, $profilePicture) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $data = [
            'profilePicture' => $profilePicture
        ];
        
        $builder->where('username', $username);
        $builder->update($data);
    }
}