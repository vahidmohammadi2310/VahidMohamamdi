@extends('layouts.master')

@section('title')
    Articles
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Articles</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>#</th>
                                <th>Title</th>
                                <th>Author Name</th>
                                <th>Publication Status</th>
                                <th>Publication Date</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @if(count($articles))
                                    @foreach($articles as $key => $article)
                                        <tr>
                                            <td >{{$key+1}}</td>
                                            <td>{{$article->title}}</td>
                                            <td>{{$article->author->name}}</td>
                                            <td>{{$article->publication_status}}</td>
                                            <td>{{$article->publication_date}}</td>
                                            <td>
                                                @if(isAdmin())
                                                    <div style="display: flex; gap: 5px;">
                                                        @if($article->publication_status == 'draft')
                                                            <a href="{{ route('admin.article.approve',$article->id)}}">
                                                                <button type="button" class="btn btn-success">Approve</button>
                                                            </a>
                                                        @endif
                                                            <form method="POST" action="{{route('admin.article.delete',$article->id)}}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                    </div>
                                                @else
                                                    <a href="{{ route('user.article.show',$article->id)}}">
                                                        <button type="button" class="btn btn-info">Details</button>
                                                    </a>
                                                    <a href="{{ route('user.article.edit',$article->id)}}">
                                                        <button type="button" class="btn btn-primary">Edit</button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
