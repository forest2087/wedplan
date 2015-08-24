<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Product overview page
     * @return view
     */
    public function index() {
        return view('package.index')->with('content', 'product page');
    }

    /**
     * Product detailed description page
     * @param $id
     * @return $this
     */
    public function show($id) {
        if (view()->exists('package.' . $id)) {
            return view('package.' . $id)->with('title', $id);
        } else {
            return view('package.index')->with('content', 'product page');
        }
    }


}