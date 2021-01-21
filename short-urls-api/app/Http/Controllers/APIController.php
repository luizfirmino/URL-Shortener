<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Professionals;

class APIController extends Controller
{
    
    public function GetProfessional($id){
        
        $pro = Professionals::find($id);
        if (!empty($job)){
            return response()->json($job);
        } else {
            return response()->json(["message" => "JOB NOT FOUND"], 200);
        }
        
    }
    
}