@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Employee', $translation));
    $link_get_data = route('admin.department.get_branches');
    $link_get_data_dept = route('admin.unit.get_depts');
    $link_get_data_unit = route('admin.unit.get_units');
    if (isset($data)) {
        $pagetitle .= ' (' . ucwords(lang('edit', $translation)) . ')';
        $link = route('admin.department.do_edit', $data->id);
    } else {
        $pagetitle .= ' (' . ucwords(lang('new', $translation)) . ')';
        $link = route('admin.department.do_create');
        $data = null;
    }

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
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ ucwords(lang('form details', $translation)) }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="card push-top">

                            <div class="card-body">

                                <form method="post" action="{{ route('admin.employees.update',$employee->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Name</label>
                                            <input type="text" class="form-control" value="{{ $employee->name }}"
                                                name="name" aria-label="First name">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputState">userName</label>
                                            <input type="text" class="form-control" value="{{ $employee->user_name }}"
                                                name="user_name" aria-label="Last name">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Office</label>
                                            <select class="form-control select2" name="division_id" id="divisions"  >

                                                @foreach ($divisions as $cntrl)

                                                    <option value="{{ $cntrl->id }}" {{$employee->division_id==$cntrl->id?"selected":""}}>
                                                        {{ $cntrl->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Branch</label>
                                            <select class="form-control select2" name="branch_id" id="branches" value="{{ $employee->branch_id }}">
                                                @foreach ($branches as $cntrl)

                                                <option value="{{ $cntrl->id }}" {{$employee->branch_id==$cntrl->id?"selected":""}}>
                                                    {{ $cntrl->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Department</label>
                                            <select class="form-control select2" name="department_id" id="depts" value="{{ $employee->department_id }}">

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Unit</label>
                                            <select class="form-control select2" name="unit_id" id="units" value="{{ $employee->unit_id }}">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Designation</label>
                                            <select class="form-control select2" name="designation_id" >
                                                <option ></option>
                                                @foreach ($designations as $cntrl)

                                                    <option value="{{ $cntrl->id }}" {{$employee->designation_id==$cntrl->id?"selected":""}}>
                                                        {{ $cntrl->designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Functional Designation</label>
                                            <select class="form-control select2" name="func_designation_id">
                                                <option ></option>
                                                @foreach ($func_designations as $cntrl)

                                                    <option value="{{ $cntrl->id }}" {{$employee->func_designation_id==$cntrl->id?"selected":""}}>
                                                        {{ $cntrl->designation }}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="1" {{$employee->gender=="Male"?"selected":""}}>Male</option>
                                                <option value="2" {{$employee->gender=="Female"?"selected":""}}>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">DOB</label>
                                            <input type="date" class="form-control" placeholder="DOB" name="dob" value="{{ $employee->dob }}"
                                                aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Mobile</label>
                                            <input type="tel" class="form-control" value="{{ $employee->mobile }}"
                                                name="mobile"aria-label="First name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Office phone</label>
                                            <input type="tel" class="form-control" name="office_phone" value="{{ $employee->office_phone }}"
                                                aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">IP Phone</label>
                                            <input type="tel" class="form-control" name="ip_phone" value="{{ $employee->ip_phone }}"
                                                aria-label="First name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">PABX Phone</label>
                                            <input type="tel" class="form-control"  value="{{ $employee->pabx_phone }}"
                                                name="pabx_phone"aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $employee->email }}"
                                                aria-label="First name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                aria-label="Last name">
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="inputState">Profile Image</label>
                                            <input type="file" name="profile_image" class="form-control" value="{{ $employee->profile_image }}" >
                                            {{-- <img src="{{ asset('uploads/employees/'.$employee->profile_image) }}"  width="70px" height="70px" alt="Image"> --}}

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Joining Date</label>
                                            <input type="date" name="joinning_date" class="form-control" value="{{ $employee->joinning_date }}">

                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-row">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                                {{ ucwords(lang('update', $translation)) }}
                                            </button>
                                            <a href="{{ route('admin.employees.list') }}" class="btn btn-danger"><i
                                                    class="fa fa-times"></i>&nbsp;
                                                {{ ucwords(lang('cancel', $translation)) }}
                                            </a>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>

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

    <script>
        // Initialize Select2
        $('.select2').select2();
    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}

    <script>
        jQuery(document).ready(function() {
            jQuery('#divisions').change(function() {
                let div_id = jQuery(this).val();
                // alert(div_id);

                jQuery.ajax({
                    url: '{{ $link_get_data }}',
                    type: 'post',
                    data: 'div_id=' + div_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#branches').html(result)
                    }
                });
            });

            jQuery('#branches').change(function() {
                let sid = jQuery(this).val();
                jQuery.ajax({
                    url: '{{ $link_get_data_dept }}',
                    type: 'post',
                    data: 'sid=' + sid + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#depts').html(result)
                    }
                });
            });

            jQuery('#depts').change(function() {
                let sid = jQuery(this).val();
                jQuery.ajax({
                    url: '{{ $link_get_data_unit }}',
                    type: 'post',
                    data: 'sid=' + sid + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#units').html(result)
                    }
                });
            });

        });
    </script>
@endsection
