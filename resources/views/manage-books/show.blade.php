@extends('layouts.main')
@section('title-page', 'Detail Book')
@section('content')
    <div class="card card-user">
        <div class="image">
            {{-- <img src="../assets/img/damir-bosnjak.jpg" alt="..."> --}}
        </div>
        <div class="card-body">
            <div class="author">
                    <img  class="avatar border-gray" src="{{ asset('storage/images/' . $id->image) }}" alt="" title=""
                    width="80">
                    <h5 class="title">{{$id->book_title }}</h5>
                <p class="description">
                   Author @ <b>{{ $id->author }}</b> 
                </p>
            </div>
            <p class="description text-center">
                "I like the way you work it <br>
                No diggity <br>
                I wanna bag it up"
            </p>
            <form action="{{ route('books.borrow', $id->id) }}">
                <p class="text-center">
                    <button class="btn btn-primary" onclick="return confirm('Are you sure you want to borrow this book?')">Borrow</button>
                </p>
            </form>
        </div>
        <div class="card-footer">
            <hr>
            <div class="button-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                        <span>Total</span>
                        <h5>{{ $id->total_books }} <small>Book</small></h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                        <span>Available</span>
                        <h5>{{ $id->available }} <small>Book</small></h5>
                    </div>
                    <div class="col-lg-3 mr-auto">
                        <span>Borrowed</span>
                        <h5>{{ $id->borrowed }} <small>Book</small></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
