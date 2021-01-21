<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\URL;

class APIController extends Controller
{
    
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'url' => ['required','url','max:400'], 
        ]);
         
        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $url = URL::where('longUrl', $request->input('url'))->first();
        if (empty($url)){
            $url = new URL();
            $url->longUrl = $request->input('url');
            $url->shortUrl = Str::random(6);
            $url->hits = 0;
            $url->created_at = date("Y-m-d");
            $url->updated_at = date("Y-m-d");
            $url->save();
        }

        return response()->json($url, 200);
    }

    public function show($url){

        $validator = Validator::make(['url' => $url], [
            'url' => ['required','max:6','min:6'], 
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $redirectTo = URL::where('shortUrl', $url)->first();
        
        if($redirectTo === null){
            return response()->json(['errors' => ["url" => "URL NOT FOUND"]], 400);
        } else {
            $redirectTo->hits = ($redirectTo->hits + 1);
            $redirectTo->save();
            return response()->json($redirectTo, 200);
        }
            
    }

}