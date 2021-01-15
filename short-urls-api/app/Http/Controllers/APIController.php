<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Urls;

class APIController extends Controller
{
    
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'url' => ['required','url','max:400'], 
        ]);
         
        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $url = Urls::AddShortUrl($request->input('url'));

        return response()->json($url, 200);
    }

    public function show($url){

        $validator = Validator::make(['url' => $url], [
            'url' => ['required','max:6','min:6'], 
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->messages()], 400);
        }

        $redirectTo = Urls::where('shortUrl', $url)->first();
        
        if($redirectTo === null){
            return response()->json(['errors' => ["url" => "URL NOT FOUND"]], 400);
        } else {
            $redirectTo->hits = ($redirectTo->hits + 1);
            $redirectTo->save();
            return response()->json($redirectTo, 200);
        }
            
    }

}