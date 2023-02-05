@extends('layouts.app')

@section('content')

    @if (Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>&nbsp;&nbsp;{{ Session::get('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                {{-- <th scope="col">#</th> --}}
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Addess</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allData as $key => $data)
                <tr>
                    {{-- <th scope="row">{{$key+1}}</th> --}}
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->address }}</td>
                    <td>
                        <a href="{{ url('edit_Data/' . $data->id) }}" class="btn btn-sm btn-dark">Edit</a>
                        <a href="{{ url('delete_Data/' . $data->id) }}" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $allData->links() }}
@endsection
