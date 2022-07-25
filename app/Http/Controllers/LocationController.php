<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Amenity;
use App\Models\Name;
use App\Models\Location;
use App\Models\Room;
use App\Traits\ApiResponser;

class LocationController extends Controller
{
    //
    use ApiResponser;

    public function showDetails(Request $request)
    {
        $data = $request->input('query');
        //$search = $request->value;
        $name  = Name::join('amenities','amenities.name_id','=','names.id')
                        ->join('locations','locations.name_id','=','names.id')
                        ->join('rooms','rooms.name_id','=','names.id')
                        ->where('locations.country','like','%'.$data.'%')
                        ->orWhere('locations.state','like','%'.$data.'%')
                        ->orWhere('locations.city','like','%'.$data.'%')
                        ->orWhere('locations.street_name','like','%'.$data.'%')
                        ->orWhere('locations.postal_address','like','%'.$data.'%')
                        ->get();
        return $this->success($name, "Name retrieved!", 200);

    }
}
