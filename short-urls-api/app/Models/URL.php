<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class URL extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'urls';
    
    protected $fillable = [
        'longUrl','shortUrl','hits','created_at','updated_at'
    ];

}