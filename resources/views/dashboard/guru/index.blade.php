@extends('layouts.app')

@section('content')
    <a href="{{ route('user.create') }}" class="btn btn-success">Add User</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Alamat</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $person)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->alamat }}</td>
                    <td>{{ strToUpper($person->role->name) }}</td>
                    <td>
                        <a href="/user/edit/{{ $person->id }}" class="btn btn-warning">Edit</a>
                        <form action="/user/delete/{{ $person->id }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
