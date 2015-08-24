<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //only admin allow to edit any user profile
        if (Auth::user()->role_id<=1) {
            $id = Auth::user()->id;
        }

        $user = User::find($id);

        //return to user index if user not found
        if(is_null($user)){
            //flash msg error
            \Session::flash('flash_danger', 'User not found.');
            return redirect('user');
        }

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //only admin allow to update user
        if (Auth::user()->role_id<=1) {
            $id = Auth::user()->id;
        }

        $user = User::find($id);

        //redirect to index if user not found
        if(is_null($user)){
            //flash msg error
            \Session::flash('flash_danger', 'User not found.');
            return redirect('user');
        }

        $user->update($request->all());

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
