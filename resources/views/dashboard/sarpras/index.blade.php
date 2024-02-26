@extends('layouts.app')

@section('content')
    <a href="{{ route('user.create') }}" class="btn btn-success">Add User</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sarpras as $s)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->quantity }}</td>
                    <td>{{ $s->ruangan }}</td>
                    <td>
                        <a href="/sarpras/edit/{{ $s->id }}" class="btn btn-warning">Edit</a>
                        <form action="/sarpras/delete/{{ $s->id }}" method="POST">
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
