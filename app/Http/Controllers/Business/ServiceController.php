<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{
    // GET services of loggedin user
    public function index() {
        // businessId of the loggedIn business
        $business = Business::where('user_id', Auth::id())->first();
        // return response()->json($business);
        // get Services of the Business
        $services = Service::where('business_id', $business->id)->paginate(10);
        return response()->json($services);
    }

    // POST service
    public function store(Request$request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'price' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $business = Business::where('user_id', Auth::id())->first();
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->business_id = $business->id;
        $service->save();
        return response()->json('service is added');
    }

    // DELETE service
    public function destroy($id) {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json('Service deleted');
    }

    // PUT service
    public function update($id, Request $request) {
        $service = Service::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'price' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        return response()->json('service is Updated');
    }


}
