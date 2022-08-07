<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['features','image_desc','name_id'];

    public function names()
    {
        return $this->belongsTo(Name::class, 'name_id', 'id')->first();
    }
}
