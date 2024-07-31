<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug',
        'city',
        'state',
    ];

    protected static function boot()
    {
        parent::boot();

        ##########################
        ###### SETTER MODEL ######
        ##########################

        static::creating(function($place){
            $place->slug = Str::slug($place->name,'-').'-'.Carbon::now()->getTimestamp();
        });
    }


}
