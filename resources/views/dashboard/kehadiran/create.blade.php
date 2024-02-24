@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Create Kehadiran</h3>
        <form action="/kehadiran/create" method="post">
            @csrf
            <select class="form-control mb-4" name="pertemuan_id" id="">
                <option value="">Pilih pertemuan</option>
                @foreach ($pertemuan as $item)
                    <option value="{{ $item->id }}">{{ $item->tanggal }}</option>
                @endforeach
            </select>
            <select class="form-control mb-4" name="user_id" id="">
                <option value="">Pilih Siswa</option>
                @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
