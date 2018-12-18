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
    public function activities($id)
    {
	    try {
		    $project = Project::findOrFail($id);

		    return rspns_ok($project->activities);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    public function get($id)
    {
	    try {
		    $project = Project::findOrFail($id);
		    $projectArray = $project->toArray();
		    $projectArray['activities'] = $project->activities;

		    return rspns_ok($projectArray);
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

		    return rspns_created($project);
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

		    return rspns_ok($project);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
	    try {
		    $project = Project::findOrFail($id);

		    $project->name = request('name') ?: $project->name;
		    $project->hour_rate = request('hour_rate') ?: $project->hour_rate;
		    $project->save();

		    return rspns_ok($project);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
	    try {
		    $project = Project::findOrFail($id);
		    $deleted = $project->delete();

		    return rspns_ok($deleted);
	    } catch(ModelNotFoundException $e) {
		    return rspns_not_found(null, $e->getMessage());
	    }
    }
}
