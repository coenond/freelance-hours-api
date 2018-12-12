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
}
