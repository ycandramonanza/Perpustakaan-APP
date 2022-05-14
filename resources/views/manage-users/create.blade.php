@extends('layouts.main')
@section('title-page', 'Form Control')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card card-user text-enter">
                <div class="card-header">
                    @if (isset($id))
                    <h5 class="card-title text-center">Edit User</h5>
                    @else
                    <h5 class="card-title text-center">Create User</h5>
                    @endif
                    
                </div>
                <div class="card-body">
                    @if (isset($id))
                        <form method="POST" action="{{ route('manage-users.update', $id->id) }}">
                    @else
                        <form method="POST" action="{{ route('manage-users.store') }}">
                    @endif

                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-md-8 offset-2 pr-1">
                            <input type="text" name="role" value="non-admin" hidden readonly>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{isset($id) ? $id->name : ''}}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{isset($id) ? $id->email : ''}}" required autocomplete="email">
                            </div>
                        </div>
                        @if (!isset($id))
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" value="{{isset($id) ? $id->password : ''}}">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2 pr-1">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    value="{{isset($id) ? $id->password : ''}}">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            @if (isset($id))
                            <button type="submit" class="btn btn-primary btn-round">Edit Users</button>
                            @else
                            <button type="submit" class="btn btn-primary btn-round">Create Users</button>
                            @endif
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
