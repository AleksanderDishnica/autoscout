<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tag;

class Car extends Model
{
    use HasFactory;    

    /**
     * Get the tags for the car.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
