<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * WedPlan landing page
     *
     * @return home.index view
     */
    public function index()
    {

        return view('home.index');
    }

}
