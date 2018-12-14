<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Get user
     */
    public function index()
    {
        try {
        	$user = User::findOrFail(request('user_id'));
        	return rspns_ok($user);
        } catch(ModelNotFoundException $e) {
	        return rspns_not_found(null, $e->getMessage());
        }
    }

    public function edit($id) {
	    try {
		    $user = User::findOrFail($id);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }

    	// ToDo
	    return rspns_ok($user);
    }

	public function update(Request $request, $id) {
		try {
			$user = User::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return rspns_not_found(null, $e->getMessage());
		}

		// ToDo
		return rspns_ok($user);
	}

	public function destory($id) {
		try {
			$user = User::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return rspns_not_found(null, $e->getMessage());
		}

		// ToDo
		return rspns_ok($user);
	}
}
