@extends('layouts.main')
@section('title-page', 'Form Control')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card card-user text-enter">
                <div class="card-header">
                    @if (isset($id))
                    <h5 class="card-title text-center">Edit Book</h5>
                    @else
                    <h5 class="card-title text-center">Create Book</h5>
                    @endif
                    
                </div>
                <div class="card-body">
                    @if (isset($id))
                        <form method="POST" action="{{ route('books.update', $id->id) }}" enctype="multipart/form-data">
                    @else
                        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                    @endif

                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Book Title</label>
                                <input type="text" class="form-control @error('book_title') is-invalid @enderror" name="book_title"
                                    value="{{isset($id) ? $id->book_title : ''}}" required autocomplete="book_title" autofocus>
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Total Book</label>
                                <input id="total_books" type="text" class="form-control @error('total_books') is-invalid @enderror"
                                    name="total_books" value="{{isset($id) ? $id->total_books : ''}}" required autocomplete="totel_book">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Author</label>
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror"
                                    name="author" value="{{isset($id) ? $id->author : ''}}" required autocomplete="author">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Published</label>
                                <input id="published" type="date" class="form-control @error('published') is-invalid @enderror"
                                    name="published" value="{{isset($id) ? $id->published : ''}}" required autocomplete="published">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="desc" cols="30" rows="10">{{isset($id) ? $id->desc : ''}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <label>Cover Image</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="image">
                            <br>
                            @if (isset($id))
                            <img src="{{ asset('storage/images/'.$id->image) }}" alt="" title="" width="80">  
                            @endif
                        
                        </div>
                    </div>
                     
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            @if (isset($id))
                            <button type="submit" class="btn btn-primary btn-round">Edit Book</button>
                            @else
                            <button type="submit" class="btn btn-primary btn-round">Create Book</button>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
