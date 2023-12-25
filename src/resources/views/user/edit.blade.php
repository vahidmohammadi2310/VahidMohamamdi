@extends('layouts.master')

@section('title')
    Update Article
@endsection

@section('content')
    <br><br><br>
    <h3>update {{$article->title}}</h3>
    <form method="POST" action="{{route('user.article.update',$article->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title">Title *</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$article->title}}"
                       placeholder="title" style="border-color: #e5310d;">
                @if($errors->has('title'))
                    <span class="text-danger">{{$errors->first('title')}}</span>
                @endif
            </div>

        </div>
        <div class="form-group">
            <div class="form-group col-md-6">
                <label for="body">Content</label>
                <textarea class="form-control" name="body"
                          id="body" rows="3" style="border-color: #e5310d;">{{$article->content}}</textarea>
                @if($errors->has('body'))
                    <span class="text-danger">{{$errors->first('body')}}</span>
                @endif
            </div>

        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
@endsection
