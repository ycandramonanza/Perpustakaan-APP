@extends('layouts.main')
@section('title-page', 'Manage Admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('manage-admin.create') }}" class="btn btn-primary">Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    No
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Status Account
                                </th>
                                <th colspan="3" class="text-center">
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if ($user->account_status == 'active')
                                                <span class="badge badge-success">{{ $user->account_status }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $user->account_status }}</span>
                                            @endif

                                        </td>
                                        @if ($user->name == 'admin' && $user->email == 'admin@gmail.com' )
                                        <td colspan="3" class="text-center">
                                            <span class="badge badge-success text-center">Super Admin</span>
                                        </td>
                                        @else
                                        <td>
                                            @if ($user->account_status == 'active')
                                                <button class="btn btn-warning" value="{{ $user->id }}"
                                                    onclick="submitStatusDisable(this)">Disable
                                                </button>
                                            @else
                                                <button class="btn btn-info" value="{{ $user->id }}"
                                                    onclick="submitStatusEnable(this)">Enable
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manage-admin.create', $user->id) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <form action="{{ route('manage-admin.delete', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <td>
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete this user admin account?')">Delete</button>
                                            </td>
                                        </form>
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
<script>
    function submitStatusEnable(e) {
        var answer = window.confirm("Do you want to activate this account?");
        if (answer) {
            id = e.getAttribute("value")
            var url = "{{ route('manage-admin.status-enable', ':id') }}";
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
            var url = "{{ route('manage-admin.status-disable', ':id') }}";
            url = url.replace(':id', id);
            window.location.href = url;
        } else {
            return false;
        }
    }
</script>
