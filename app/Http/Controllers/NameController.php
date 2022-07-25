<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Name;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Room;
use App\Traits\ApiResponser;


class NameController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name  = Name::all();
        return $this->success($name, "Name retrieved!", 200);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $isExist = Name::where([
            'hotel_name' => $request->hotel_name,
        ])->exists();

        $name = Name::create($request->all());
        if($name) {
            $hotel_id = $name->id;
            $request->name_id = $hotel_id;
            Location::create($request->all() + ['name_id' => $hotel_id]);
            Room::create($request->all() + ['name_id' => $hotel_id]);
            Amenity::create($request->all() + ['name_id' => $hotel_id]);
            return $this->success(null, "name created successfully!", 201);
        } else {
            return $this->error("There is an error!", 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Name $name
     * @return \Illuminate\Http\Response
     */
    public function show(Name $name)
    {
        return $this->success($name, "Name returned!", 200);

    }


    public function showDetails(Request $request)
    {
        $data = $request->input('query');
        //$search = $request->value;
        $name  = Name::join('amenities','amenities.name_id','=','names.id')
                        ->join('locations','locations.name_id','=','names.id')
                        ->join('rooms','rooms.name_id','=','names.id')
                        ->where('names.hotel_name','like','%'.$data.'%')
                        ->get();
        return $this->success($name, "Hotels retrieved!", 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Name $name)
    {
        if ($name->update($request->all())) {
            return $this->success($name, "Name updated successfully!", 200);
        } else {
            return $this->error("There is an error", 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Name $name)
    {
         if ($name->delete()) {
             return $this->success($name, "Name deleted successfully!", 200);
         } else {
              return $this->error("There is an error", 500);
         }

    }



    /**
     *
     * Add Business Logic function below here.
     *
     * Do not delete anything above.
     * Neither should you add anything above.
     * In other to keep every neat and functional.
     *
     * Happy coding...
     *
     */

}
