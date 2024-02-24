@extends('layouts.app')

@section('content')
    <a href="/kehadiran/create" class="btn btn-success">Buat kehadiran</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal pertemuan</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiran as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->pertemuan->tanggal }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/kehadiran/edit/{{ $item->id }}" class="btn btn-warning">Edit</a>
                            <form action="/kehadiran/delete/{{ $item->id }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
