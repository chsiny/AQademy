<?php

namespace App\Libraries;

use MongoDB\Client;

class MongoDB
{
    protected $client;
    protected $db;

    public function __construct()
    {
        $this->client = new Client('mongodb://localhost:27017');
        $this->db = $this->client->selectDatabase('wis');
    }

    public function getDb()
    {
        return $this->db;
    }
}