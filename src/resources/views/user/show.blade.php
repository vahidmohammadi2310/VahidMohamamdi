@extends('layouts.master')

@section('title')
    Article Details
@endsection

@section('content')
    <div class="card card-nav-tabs">
        <div class="card-header card-header-warning">
            {{$article->title}} publish at {{$article->publication_date ? $article->publication_date : 'future'}}
        </div>
        <div class="card-body">
            <h4 class="card-title">{{$article->title}}</h4>
            <p class="card-text">{{$article->content}}.</p>
        </div>
    </div>

@endsection
