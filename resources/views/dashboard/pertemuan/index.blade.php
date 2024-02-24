@extends('layouts.app')

@section('content')
    <a href="/pertemuan/create" class="btn btn-success">Buat pertemuan</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kelas</th>
                <th scope="col">Pembimbing</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pertemuan as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->kelas->name }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="/pertemuan/edit/{{ $item->id }}" class="btn btn-warning">Edit</a>
                            <form action="/pertemuan/delete/{{ $item->id }}" method="POST">
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
