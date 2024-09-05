<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    // GET all businesses
    public function index() {
        $businesses = Business::all();
        // return response()->json($businesses);
        return view('businesses', compact('businesses'));
    }

    public function create() {
        return view('create_business');
    }

    // POST Business
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'opening_hours' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        Business::create(array_merge($validator->validated()) );
        // return response()->json('Business has been added');
        return redirect()->back();
    }

    public function edit($id) {
        $business = Business::find($id);
        return view('edit_business', compact('business'));
    }

    /// UPDATE Business
    public function update(Request $request, $id) {
        $business = Business::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'opening_hours' => 'required',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $business->update(array_merge($validator->validated()));
        // return response()->json('Business has been Updated');
        return redirect()->back();

    }

    // DELETE Business
    public function destroy($id) {
        $business = Business::findOrFail($id);
        $business->delete();
        return response()->json('Business is deleted');
    }
}
