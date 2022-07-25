<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Amenity;
use App\Models\Name;
use App\Models\Location;
use App\Models\Room;
use App\Traits\ApiResponser;
class RoomController extends Controller
{
    //

    use ApiResponser;

    public function showDetails(Request $request)
    {
        $data = $request->input('query');
        $data = intval($data);
        //$search = $request->value;
        $name  = Name::join('amenities','amenities.name_id','=','names.id')
                        ->join('locations','locations.name_id','=','names.id')
                        ->join('rooms','rooms.name_id','=','names.id')
                        ->where('rooms.price','=',$data)
                        ->get();
        return $this->success($name, "Name retrieved!", 200);

    }
}
