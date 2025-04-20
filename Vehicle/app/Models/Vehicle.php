<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    
    protected $fillable = [
        'name',
        'model',
        'price',
        'image_url',
        'type',
        'owner_id',
        'description'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
