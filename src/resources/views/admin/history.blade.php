@extends('layouts.master')

@section('title')
    Deleted Articles
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Articles</h4>
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
                                <th>Deleted Date</th>
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
                                            <td>{{$article->deleted_at}}</td>
                                            <td>

                                            <div>
                                                <a href="{{ route('admin.article.restore',$article->id)}}">
                                                    <button type="button" class="btn btn-warning">Restore</button>
                                                </a>
                                            </div>
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
