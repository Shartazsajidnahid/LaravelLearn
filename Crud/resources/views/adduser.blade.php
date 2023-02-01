@extends('layout')

@section('content')
    {{-- <a href="{{ url('/') }}" class="btn btn-primary my-3">Go Home</a> --}}
    <br>
    <form action="{{ url('/store_Data') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        @error('name')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <div class="form-group">
            <label>Phone</label>
            <input type="number" class="form-control" name="phone">
        </div>

        @error('phone')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address">
        </div>

        @error('address')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <br>

        <button type="submit" class="btn btn-primary">Add user</button>
    </form>
@endsection
