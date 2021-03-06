<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Project extends Model
{
	/**
	 * The table associated with the model.
	 */
	protected $table = 'projects';

	/**
	 * The attributes that should be visible in arrays.
	 */
	protected $visible = [
		'id',
		'name',
		'hour_rate',
		'user_id',
	];

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'hour_rate',
		'user_id',
	];

	/**
	 * An Project belongs to a user
	 */
	public function user(): Relations\BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * A Project has many activities
	 */
	public function activities(): Relations\HasMany
	{
		return $this->hasMany(Activity::class);
	}

	public function getLogsAttribute()
	{
		return $this->activities()->count() ?: 0;
	}

	public function getRevenueAttribute()
	{
		$activities = $this->activities()->get();
		$revenue = 0;

		foreach ($activities as $activity) {
			$revenue = $revenue + $activity->cost_incl;
		}

		return $revenue;
	}

	public function getHoursAttribute()
	{
		$activities = $this->activities()->get();
		$minutes = 0;

		foreach ($activities as $activity) {
			$minutes = $minutes + $activity->duration;
		}

		return round($minutes/60);
	}

}
