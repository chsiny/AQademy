<?php

namespace App\Controllers;

use App\Libraries\MongoDB;
use CodeIgniter\Controller;
use App\Models\MovieModel;
use App\Config\Services;

class MovieController extends Controller
{
    protected $mv;

    public function index()
    {
        // Initialize the MongoDB library

        $this->mv = new MovieModel();
        $mvs = $this->mv->getAllMovies();

        // Pass the movies data to the view
        $data['mvs'] = $mvs;
        return view('movie_view', $data);
    }
}