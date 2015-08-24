<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('package.index')->with('content', 'product page');
    }

    public function show($id) {
        if (view()->exists('package.' . $id)) {
            return view('package.' . $id)->with('title', $id);
        } else {
            return view('package.index')->with('content', 'product page');
        }
    }


}