<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Geo;

class GeoController extends Controller
{
    public function index(Request $request)
    {
        $geo = Geo::get();

        return view('welcome', [
            'list' => $geo
        ]);
    }

    public function upload(Request $request)
    {
        if( Input::file('file') ) {
            $path = Input::file('file')->getRealPath();
        } else {
            return back()->withErrors('error');
        }

        $data = array_map('str_getcsv', file($path));
        unset($data[0]);

        foreach($data as $line) {
            $location  = explode(",", $line[1]);
            $arr[] = [
                'name' => $line[0],
                'longitude' => $location[0],
                'latitude' => $location[1],
            ];
        }
        Geo::insert($arr);

        return redirect()->back();
    }

    public function getLocations(Request $request)
    {
        $place = Geo::find($request->id);
        $query = Geo::geofence($place->latitude, $place->longitude, 0, $request->range);
        $all = $query->get();

        return view('welcome', [
            'response' => $all,
            'id' => $request->id,
            'list' => Geo::get(),
            'range' => $request->range
        ]);
    }
}
