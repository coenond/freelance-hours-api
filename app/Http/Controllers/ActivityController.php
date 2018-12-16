<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Project;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get($id)
    {
        try {
            $activity = Activity::findOrFail($id);

            $activityArray = $activity->toArray();
            $activityArray['tax'] = $activity->tax;
            $activityArray['project'] = $activity->project;
            $activityArray['duration'] = $activity->durationInMinutes();

            return rspns_ok($activityArray);
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
