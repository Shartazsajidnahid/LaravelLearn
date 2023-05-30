@extends('_template_adm.master')

@php

    // USE LIBRARIES
    use App\Libraries\Helper;
    $pagetitle = ucwords(lang('Employees', $translation));
    $link_get_data = route('admin.department.get_branches');
@endphp


@section('title', $pagetitle)

@section('content')
    <div class="">
        <!-- message info -->
        @include('_template_adm.message')

        <div class="page-title">
            <div class="title_left">
                <h3>{{ $pagetitle }}</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                    @if (Helper::authorizing('Branch', 'Restore')['status'] == 'true')
                        <a href="{{ route('admin.branch.deleted') }}" class="btn btn-round btn-danger"
                           style="float: right; margin-bottom: 5px;" data-toggle="tooltip"
                           title="{{ ucwords(lang('view deleted items', $translation)) }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    @endif
                    <a href="{{ route('admin.employees.create') }}" class="btn btn-round btn-success" style="float: right;">
                        <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('add new', $translation)) }}
                    </a>
                    <a href="{{ route('admin.update_data') }}" class="btn btn-round btn-info" style="float: right;">
                        <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('Update Employee Data', $translation)) }}
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="form-group">

            {{Form::open(['url'=>route('admin.employees.list'),'method'=>'get'])}}
            <div class="col-md-5 col-sm-12 col-xs-12 form-group">
                <label for="FromDate" class="control-label">Employee ID:</label>
                {!! Form::select('user_name', $data['employeeList'], $value = null, array('id'=>'user_name', 'class' => 'form-control select2', 'placeholder'=>'Select a Employee')) !!}
                @if($errors->has('user_name'))
                    <span
                        class="required">{{ $errors->first('user_name') }}</span>
                @endif
            </div>

            <div class="col-md-5 col-sm-12 col-xs-12 form-group">
                <label for="FromDate" class="control-label">Branch/Division</label>
                {!! Form::select('branch_id', $data['branchDivisionList'], $value = null, array('id'=>'branch_id', 'class' => 'form-control select2', 'placeholder'=>'Select a Branch/Division')) !!}
                @if($errors->has('branch_id'))
                    <span
                        class="required">{{ $errors->first('branch_id') }}</span>
                @endif
            </div>

            <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                <label for="ID" class="control-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary form-control">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                <label for="ID" class="control-label">&nbsp;</label>
                <a href="{{ route('download-employees') }}" class="btn btn-primary  form-control"><i class="fa fa-download"></i></a>
            </div>

            {{Form::close()}}
        </div>
        {{-- <a href="{{ route('download-employees') }}" class="btn btn-primary">Download Employees</a> --}}





        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ ucwords(lang('data list', $translation)) }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <!-- <th>ProfileImage</th>-->
                                <th>Name</th>
                                <th>Employee Id</th>
                                <th>Branch/Division</th>
                                <th>Department</th>
                                <th>Unit</th>
                                <th>Designation</th>
                                <th>Functional Designation</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($data['employee']) && $data['employee']->count())
                                @foreach($data['employee'] as $employees)
                                    <tr>
                                        <!--                                        <td>
                                            <img
                                                src="{{ asset('uploads/employees/'.$employees['user_name'].'/'.$employees['profile_image']) }}"
                                                width="70px" height="70px" alt="Image">
                                        </td>-->
                                        <td>{{$employees['name']}}</td>
                                        <td>{{$employees['user_name']}}</td>
                                        <td>{{$employees->branch->name ?? ''}}</td>
                                        <td>{{$employees->department->name ?? ''}}</td>
                                        <td>{{$employees->unit->name ?? ''}}</td>
                                        <td>{{$employees->designation->designation ?? ''}}</td>
                                        <td>{{$employees->funcDesignation->designation ?? ''}}</td>
                                        <td>{{$employees['mobile']}}</td>
                                        <td>{{$employees['email']}}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.employees.edit', $employees['id'])}}"
                                               class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('admin.employees.destroy', $employees['id'])}}"
                                                  method="post"
                                                  style="display: inline-block">
                                                @csrf
                                                {{--@method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">Delete
                                                </button>--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif


                            </tbody>
                        </table>
                        {!! $data['employee']->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <!-- Switchery -->
    @include('_form_element.switchery.css')
    <!-- Select2 -->
    @include('_form_element.select2.css')
@endsection

@section('script')
    <!-- Switchery -->
    @include('_form_element.switchery.script')
    <!-- Select2 -->
    @include('_form_element.select2.script')

@endsection
