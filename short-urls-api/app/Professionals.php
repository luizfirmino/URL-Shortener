<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Professionals extends Model
{
    
    // View
    protected $table = 'hero_professionals';
    protected $primaryKey = 'resourceId';
    
}
