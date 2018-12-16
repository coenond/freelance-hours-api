<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Activity extends Model
{
	/**
	 * The table associated with the model.
	 */
	protected $table = 'activities';

	/**
	 * The attributes that should be visible in arrays.
	 */
	protected $visible = [
		'id',
		'name',
		'description',
		'started_at',
		'finished_at',
		'tax_id',
	];

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'description',
		'started_at',
		'finished_at',
		'tax_id',
	];

	/**
	 * An Activity belongs to a project
	 */
	public function project(): Relations\BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

	/**
	 * An Activity has one tax rate.
	 */
	public function tax(): Relations\BelongsTo
	{
		return $this->belongsTo(Tax::class);
	}

	/**
	 * Calculate the duration of the activity in minutes
	 */
	public function durationInMinutes(): int
	{
		$start = new Carbon($this->started_at);
		$end = new Carbon($this->finished_at);

		if ($start < $end)
			return $start->diffInMinutes($end);
		else
			return 0;
	}
}
