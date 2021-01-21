@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    </div><br />
@endif

<form method="post" action="{{ route('add') }}">
    @csrf
    <div class="form-group">
        <textarea class="form-control" placeholder="Paste your long URL here" id="url" name="url" rows="3">{{ old('url') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create a short link</button>
</form><br /><br />

@if(!empty($url))
    
    <div class="card">
        <div class="list-group">
            <a href="/{{$url->shortUrl}}" class="list-group-item list-group-item-action list-group-item-success" aria-current="true">
                <i class="bi bi-globe"></i> {{url()->full()}}/{{$url->shortUrl}} 
            </a>
            <div class="card-footer">
                {{$url->longUrl}}<br />
                <small class="text-muted">
                    Created at: {{$url->created_at}}<br />
                    Updated at: {{$url->updated_at}}<br />
                    Hits: {{$url->hits}}
                </small>
            </div>
        </div>
    </div>
    
@endif
</div>
@endsection