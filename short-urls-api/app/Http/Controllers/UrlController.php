<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Urls;

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

        $url = Urls::AddShortUrl($request->input('url'));

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
        $redirectTo = Urls::where('shortUrl', $url)->first();
        
        if($redirectTo === null){
            return view('404');
        } else {
            $redirectTo->hits = ($redirectTo->hits + 1);
            $redirectTo->save();
            return redirect()->away($redirectTo->longUrl);
        }

    }

}
