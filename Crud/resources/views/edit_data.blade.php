@extends('layout')

@section('content')
    {{-- <a href="{{ url('/') }}" class="btn btn-primary my-3">Go Home</a> --}}
    <br>

    @if (Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>&nbsp;&nbsp;{{ Session::get('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @php
            Session::forget('status');
        @endphp
    @endif

    <form action="{{ url('update_Data/' . $user->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        @error('name')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <div class="form-group">
            <label>Phone</label>
            <input type="number" class="form-control" name="phone" value="{{ $user->phone }}">
        </div>

        @error('phone')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
        </div>

        @error('address')
            <span class="text-danger"> {{ $message }} </span>
        @enderror

        <br>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
