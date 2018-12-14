<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
	    try {
		    $user = User::findOrFail(request('user_id'));

		    return rspns_ok($user->projects()->get());
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
	    try {
		    $user = User::findOrFail(request('user_id'));

		    $project = new Project();
		    $project->name = request('name');
		    $project->hour_rate = request('hour_rate');
		    $project->user()->associate($user);

		    $project->save();

		    rspns_created($project);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Return the specified resource.
     */
    public function show($id)
    {
	    try {
		    $project = Project::findOrFail($id);

		    rspns_ok($project);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     */
    public function edit($id)
    {
	    try {
		    $project = Project::findOrFail($id);

		    $project->name = request('name') ?: $project->name;
		    $project->hour_rate = request('hour_rate') ?: $project->hour_rate;
		    $project->save();

		    rspns_ok($project);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     */
    public function destroy($id)
    {
        //
    }
}
