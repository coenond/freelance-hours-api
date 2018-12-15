<?php

namespace App;

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

}
