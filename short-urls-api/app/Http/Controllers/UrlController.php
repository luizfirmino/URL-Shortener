<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\URL;

class UrlController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url'=>'required|url|max:400'
        ]);

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
        
        return view('index', compact('url'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $redirectTo = URL::where('shortUrl', $url)->first();
        
        if($redirectTo === null){
            return view('404');
        } else {
            $redirectTo->hits = ($redirectTo->hits + 1);
            $redirectTo->save();
            return redirect()->away($redirectTo->longUrl);
        }

    }

}
