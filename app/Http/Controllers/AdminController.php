<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Payment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Admin dashboard index, display list of transactions
     * todo - add more tools
     * @return \Illuminate\View\View
     */
    public function index() {
        $payments = Payment::all();
        return view('admin.index', ['payments' => $payments] );
    }

}