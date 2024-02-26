@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit data user</h3>
        <form action="/user/edit/{{ $user->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}">
            </div>
            <select class="form-control mb-4" name="role_id" id="">
                <option value="">Pilih role</option>
                @foreach ($role as $item)
                    @if ($item->id == $user->role_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            <select class="form-control mb-4" name="kelas_id" id="">
                <option value="">Pilih kelas</option>
                @foreach ($kelas as $item)
                    @if ($item->id == $user->kelas_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
