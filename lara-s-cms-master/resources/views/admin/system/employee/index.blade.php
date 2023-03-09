
@extends('layout')
@section('content')
<div>
  <table class="table">
    <thead>
        <tr class="table table-bordered">
          <th>ID</th>
          <th>ProfileImage</th>
          <th>Name</th>
          <th>UserName</th>
          <th>Designation</th>
          <th>Functional_Designation</th>
          <th>Branch</th>
          <th>Department</th>
          <th>Phone</th>
          <th>OficePhone</th>
          <th>IP_Phone</th>
          <th>PabxPhone</th>
          <th>DOB</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Password</th>
          <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employee as $employees)
        <tr>
            <td>{{$employees->id}}</td>
            <td>
              <img src="{{ asset('uploads/employees/'.$employees->profile_image) }}" width="70px" height="70px" alt="Image">
          </td>
            <td>{{$employees->name}}</td>
            <td>{{$employees->user_name}}</td>
            <td>{{$employees->designation}}</td>
            <td>{{$employees->functional_designation}}</td>
            <td>{{$employees->brance}}</td>
            <td>{{$employees->department}}</td>
            <td>{{$employees->phone}}</td>
            <td>{{$employees->office_phone}}</td>
            <td>{{$employees->ip_phone}}</td>
            <td>{{$employees->pabx_phone}}</td>
            <td>{{$employees->dob}}</td>
            <td>{{$employees->gender}}</td>
            <td>{{$employees->email}}</td>
            <td>{{$employees->password}}</td>
            <td class="text-center">
                <a href="{{ route('employees.edit', $employees->id)}}"   class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('employees.destroy', $employees->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
