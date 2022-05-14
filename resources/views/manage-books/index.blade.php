@extends('layouts.main')
@section('title-page', 'Books')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (Auth::user()->role == 'admin')
                    <div class="card-header">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Create</a>
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Cover
                                </th>
                                <th>
                                    Book Title
                                </th>
                                <th>
                                    Published
                                </th>
                                <th>
                                    Available
                                </th>
                                <th>
                                    borrowed
                                </th>
                                <th>
                                    Total Books
                                </th>
                                <th>
                                    Author
                                </th>
                                <th colspan="3" class="text-center">
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            @if ($book->image == 'No Image')
                                                <span>No Image</span>
                                            @else
                                                <img src="{{ asset('storage/images/' . $book->image) }}" alt="" title=""
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $book->book_title }}
                                        </td>
                                        <td>
                                            {{ date('d-M-Y', strtotime($book->published)) }}
                                        </td>
                                        <td>
                                            {{ $book->available }} Book
                                        </td>
                                        <td>
                                            {{ $book->borrowed }} Book
                                        </td>
                                        <td>
                                            {{ $book->total_books }} Book
                                        </td>
                                        <td>
                                            {{ $book->author }}
                                        </td>
                                        @if (Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('books.create', $book->id) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <form action="{{ route('books.delete', $book->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <td>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Do you want to delete this book?')">Delete</button>
                                            </td>
                                        </form>  
                                        @else
                                        <td>
                                            <a href="{{ route('books.show', $book->id) }}">
                                                <button class="btn btn-primary">Borrow Now</button>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <script>
    function submitStatusEnable(e) {
        var answer = window.confirm("Do you want to activate this account?");
        if (answer) {
            id = e.getAttribute("value")
            var url = "{{ route('manage-users.status-enable', ':id') }}";
            url = url.replace(':id', id);
            window.location.href = url;
        } else {
            return false;
        }
    }

    function submitStatusDisable(e) {
        var answer = window.confirm("Do you want to inactive this account?");
        if (answer) {
            id = e.getAttribute("value")
            var url = "{{ route('manage-users.status-disable', ':id') }}";
            url = url.replace(':id', id);
            window.location.href = url;
        } else {
            return false;
        }
    }
</script> --}}
