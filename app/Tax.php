<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Tax extends Model
{
	/**
	 * The table associated with the model.
	 */
	protected $table = 'taxes';

	/**
	 * The attributes that should be visible in arrays.
	 */
	protected $visible = [
		'id',
		'name',
		'rate',
	];

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'rate',
	];

	/**
	 * A Tax has many activities
	 */
	public function activities(): Relations\HasMany
	{
		return $this->hasMany(Activity::class);
	}
}
