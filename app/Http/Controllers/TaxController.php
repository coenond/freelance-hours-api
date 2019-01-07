<?php

namespace App\Http\Controllers;

use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function all()
	{
		try {
			$taxes = Tax::all();

			return rspns_ok($taxes);
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
			$tax = Tax::findOrFail($id);

			return rspns_ok($tax);
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
			$tax = new Tax();
			$tax->name = request('name');
			$tax->rate = request('rate');

			$tax->save();

			return rspns_created($tax);
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
			$tax = Tax::findOrFail($id);

			$tax->name = request('name') ?: $tax->name;
			$tax->rate = request('rate') ?: $tax->rate;
			$tax->save();

			return rspns_ok($tax);
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
			$tax = Tax::findOrFail($id);
			$deleted = $tax->delete();

			return rspns_ok($deleted);
		} catch(ModelNotFoundException $e) {
			return rspns_not_found(null, $e->getMessage());
		}
	}
}
