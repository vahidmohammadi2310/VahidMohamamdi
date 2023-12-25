@extends('layouts.master')

@section('title')
    Create New Post
@endsection

@section('content')
    <br><br><br>
    <h3>create New Article</h3>
    <form method="POST" action="{{route('user.article.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title">Title *</label>
                <input type="text" name="title" class="form-control" id="title"
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
                          id="body" rows="3" style="border-color: #e5310d;"></textarea>
                @if($errors->has('body'))
                    <span class="text-danger">{{$errors->first('body')}}</span>
                @endif
            </div>

        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
@endsection
