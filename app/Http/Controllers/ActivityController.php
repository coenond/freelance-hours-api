<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Activity;
use App\Project;
use App\Tax;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        try {
            $activities = Activity::all();

            $data = $activities->toArray();

            foreach ($data as $key => $activity) {
	            $data[$key]['duration'] = $activities[$key]->duration;
	            $data[$key]['tax_rate'] = floatval($activities[$key]->tax->rate);
	            $data[$key]['tax_amount'] = $activities[$key]->taxAmount;
	            $data[$key]['cost_excl'] = $activities[$key]->cost_excl;
	            $data[$key]['cost_incl'] = $activities[$key]->cost_incl;
            }

	        return rspns_ok($data);
        } catch(ModelNotFoundException $e) {
            return rspns_not_found(null, $e->getMessage());
        }
    }

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
	        $tax = Tax::findOrFail(request('tax_id'));
	        $project = Project::findOrFail(request('project_id'));

            $activity = new Activity();
	        $activity->name = request('name');
	        $activity->description = request('description');
	        $activity->started_at = request('started_at');
	        $activity->finished_at = request('finished_at');

	        $activity->tax()->associate($tax);
	        $activity->project()->associate($project);

	        $activity->save();

            return rspns_created($activity);
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
            $project->delete();

            return rspns_ok($project);
        } catch(ModelNotFoundException $e) {
            return rspns_not_found(null, $e->getMessage());
        }
    }
}
