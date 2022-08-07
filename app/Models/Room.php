<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_type','price','name_id','bed_size'];

    protected $casts = [
        'id' => 'integer',
    ];

    public function names()
    {
        return $this->belongsTo(Name::class, 'name_id', 'id')->first();
    }
}
