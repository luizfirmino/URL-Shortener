<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Urls extends Model
{

    public static function AddShortUrl($originalUrl){
        return DB::select('CALL sp_addShortUrl(?);', [$originalUrl]);
    }
}
