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

    public function showByPrices(Request $request)
    {
        $data = $request->input('query');
        $name  = Room::join('names','names.id','=','rooms.name_id')
                        ->where('rooms.price','like','%'.$data.'%')
                        ->get(['names.hotel_name','names.location','rooms.room_type','rooms.price','rooms.bed_size']);
        return $this->success($name, "Hotels retrieved!", 200);
    }

    public function showByBed(Request $request)
    {
        $data = $request->input('query');
        $name  = Room::join('names','names.id','=','rooms.name_id')
                        ->where('rooms.bed_size','like','%'.$data.'%')
                        ->get(['names.hotel_name','names.location','rooms.bed_size','rooms.price','rooms.room_type']);
        return $this->success($name, "Hotels retrieved!", 200);
    }
}
