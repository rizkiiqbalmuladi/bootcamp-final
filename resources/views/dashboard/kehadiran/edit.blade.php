@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Kehadiran</h3>
        <form action="/kehadiran/edit/{{ $kehadiran->id }}" method="post">
            @method('PUT')
            @csrf
            <select class="form-control mb-4" name="pertemuan_id" id="">
                <option value="">Pilih pertemuan</option>
                @foreach ($pertemuan as $item)
                    @if ($kehadiran->pertemuan_id === $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->tanggal }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->tanggal }}</option>
                    @endif
                @endforeach
            </select>
            <select class="form-control mb-4" name="user_id" id="">
                <option value="">Pilih Siswa</option>
                @foreach ($users as $item)
                    @if ($kehadiran->user_id === $item->id)
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
