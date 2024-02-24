@extends('layouts.app')

@section('content')
    <div class="card mt-5" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $sekolah->name }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{ $sekolah->address }}</li>
            <li class="list-group-item">{{ $sekolah->phone }}</li>
        </ul>
        <div class="card-body">
            <a href="/sekolah/edit/{{ $sekolah->id }}" class="card-link">Edit</a>
            <a href="#" class="card-link">Delete</a>
        </div>
    </div>
@endsection
