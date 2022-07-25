<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Name;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Room;
use App\Traits\ApiResponser;


class AmenityController extends Controller
{
    //
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showDetailss()
    {
        $results = [];
        $amenities  = Amenity::all()->where('features','swimming pool');
        $name_id = Amenity::where('features','swimming pool')->value('name_id');
        $locations = Location::all()->where('name_id', $name_id);
        $rooms = Room::all()->where('name_id', $name_id);
        $name = Name::all()->where('name_id', $name_id);
        $results[] = $amenities;
        $results[] = $locations;
        $results[] = $rooms;
        $results[] = $name;
        $amenn = Amenity::join('names','names.id');
        return $this->success($results, "Amenity retrieved!", 200);

    }

    public function showDetails(Request $request)
    {
        $data = $request->input('query');
        //$search = $request->value;
        $name  = Name::join('amenities','amenities.name_id','=','names.id')
                        ->join('locations','locations.name_id','=','names.id')
                        ->join('rooms','rooms.name_id','=','names.id')
                        ->where('amenities.features','like','%'.$data.'%')
                        ->get();
        return $this->success($name, "Hotels retrieved!", 200);

    }
}
