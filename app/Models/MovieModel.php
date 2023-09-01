<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\MongoDB;

class MovieModel extends Model
{
    protected $mongoDb;
    protected $db;
    protected $collection;

    public function __construct()
    {
        $this->mongoDb = new MongoDB();
        $this->db = $this->mongoDb->getDb();
        $this->collection = $this->db->selectCollection('movies');
    }

    public function getOneMovie()
    {
        return $this->collection->findOne();
    }

    public function getAllMovies()
    {
        return $this->collection->find([],
        [
            'progection' => [
                'title' => 1,
                'year' => 1,
                'countries' => 1,
                'directors' => 1
            ],
            'limit' => 1000
        ]);
    }

    public function getMovieByYear($year = 2000)
    {
        return $this->collection->find(['year' => $year]);
    }

    public function getMovieByCountry($countries = 'USA')
    {
        return $this->collection->find(['countries' => $countries]);
    }

    public function getMovieByRatingAndCountry($rating = '6.5', $country = 'UK')
    {
        return $this->collection->find(
            ['imdb.rating.$numberDouble' => $rating,
            'countries' => $country],
            [
                'projection' => [
                    'title' => 1,
                    'year' => 1,
                    'countries' => 1,
                    'directors' => 1,
                    'imdb.rating.$numberDouble' => 1
                ],
                'limit' => 1000
            ]);
    }
}