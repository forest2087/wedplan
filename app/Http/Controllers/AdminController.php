<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Payment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //list transactions
    public function index() {
        $payments = Payment::all();
        return view('admin.index', ['payments' => $payments] );
    }

}