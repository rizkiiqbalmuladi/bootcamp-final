@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Pertemuan</h3>
        <form action="/pertemuan/edit/{{ $pertemuan->id }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="tanggal" class="form-label">tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $pertemuan->tanggal }}">
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <select class="form-control mb-4" name="kelas_id" id="">
                <option value="">Pilih kelas</option>
                @foreach ($kelas as $item)
                    @if ($pertemuan->kelas_id === $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @endif
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
