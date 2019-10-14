<?php

namespace App\Http\Controllers;

use App\Location;
use App\LocationView;
use Illuminate\Http\Request;
use Auth;
use Validator;

class LocationController extends Controller
{

    private $_location;
    public function __construct(Location $location)
    {
        $this->_location = $location;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $locations = LocationView::orderBy('id','desc')->paginate(50);
        return view('administrative.super_admin.tasks.locations.index', compact('locations'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $locationList    = (new Location())->locationOptionsByID();
        return view('administrative.super_admin.tasks.locations.create' , compact('locationList'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! Your role not eligible for do any super admin task.'] ]);
        }

        $validator = Validator::make($request->all(), [
            'location_name'    => 'required|max:255|unique:locations',
            'postal_code' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'location_name'=> $request->location_name,
                'postal_code'=> $request->postal_code,
                'parent_id' => ($request->has('parent_location')) ? $request->parent_location : null,
            ];

            //dd($data);
            $this->_location->store($data);
            return response()->json(['success' => 'Save Successfully.']);
        }
    }

    /**
     * @param Location $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Location $location)
    {
        $locationList    = (new Location())->locationOptionsByID();
        return view('administrative.super_admin.tasks.locations.edit' , compact('locationList', 'location'));
    }

    /**
     * @param Request $request
     * @param Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request , Location $location)
    {

        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! Your role not eligible for do any super admin task.'] ]);
        }

        $validator = Validator::make($request->all(), [
            'location_name'    => 'required|max:255|unique:locations,location_name,'.$location->id.',id',
            'postal_code' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'location_name'=> $request->location_name,
                'postal_code'=> $request->postal_code,
                'parent_id' => ($request->has('parent_location')) ? $request->parent_location : null,
            ];

            $this->_location->store($data, $location->id);
            return response()->json(['success' => 'Save Successfully.']);
        }
    }

    /**
     * @param Location $location
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Location $location){
        $location->delete();
        return redirect()->back()->with('success', 'Delete Sccessfully');

    }



}//main
