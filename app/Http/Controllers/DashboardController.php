<?php

namespace App\Http\Controllers;

use App\Project;
use App\Activity;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		try {
			$projects = Project::all();
			$activities = Activity::all();

			$totalHours = 0;
			$totalRevenue = 0;

			foreach ($activities as $activity) {
				$totalHours += $activity->duration;
			}

			foreach ($projects as $project) {
				$totalRevenue += $project->revenue;
			}

			$data = array(
				"id" => 1,
				"total_revenue" => round($totalRevenue),
				"total_projects" => $project->count(),
				"total_hours" => round($totalHours / 60),
				"total_logs" => $activity->count()
			);

			return rspns_ok($data);
		} catch (ModelNotFoundException $e) {
			return rspns_not_found(null, $e->getMessage());
		}
	}
}