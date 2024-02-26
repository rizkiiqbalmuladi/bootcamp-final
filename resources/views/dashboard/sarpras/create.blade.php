@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Create Sarpras</h3>
        <form action="/sarpras/create" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="ruangan" class="form-label">ruangan</label>
                <input type="text" class="form-control" id="ruangan" name="ruangan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
