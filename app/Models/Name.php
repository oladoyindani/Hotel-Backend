<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_name','hotel_image','location','amenities'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function locations()
    {
        return $this->hasMany(Location::class, 'name_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'name_id', 'id');
    }

    public function amenities()
    {
        return $this->hasMany(Amenity::class, 'name_id', 'id');
    }
}
