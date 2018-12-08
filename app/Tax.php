<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
		'amount',
	];

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'amount',
	];
}
