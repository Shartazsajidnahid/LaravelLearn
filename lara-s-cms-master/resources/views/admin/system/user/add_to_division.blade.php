@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Division admins', $translation));
    $link_get_data = route('admin.department.get_branches');
    $link_get_data_dept = route('admin.unit.get_depts');
    $link_get_data_unit = route('admin.unit.get_units');

    $pagetitle .= ' (' . ucwords(lang('assign to division', $translation)) . ')';
    $link = route('admin.user.do_add_to_division', $data->id);

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
                        <br />
                        <form class="form-horizontal form-label-left" action="{{ $link }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Admin username
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="title" name="name"
                                        value="{{ $data->username }}" readonly>
                                </div>
                            </div>

                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Office
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="division_id" id="divisions">
                                        <option>Select Office</option>
                                        @foreach ($divisions as $cntrl)
                                            <option value="{{ $cntrl->id }}" onclick="javascript:choosebranch();">
                                                {{ $cntrl->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Branch
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_id" id="branches">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group vinput_main_branch">
                                <label for="parent dept" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Department
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="department_id" id="depts">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Unit
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="unit_id" id="units">

                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Assign to
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="form-check form-check-inline">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            {{-- <input class="form-check-input" type="radio" id="assign_to"
                                                value="1" name="assign_to">
                                            <label class="form-check-label" for="assign_to">Division</label> --}}
                                            &nbsp;
                                            <input class="form-check-input " type="radio" id="assign_to"
                                                value="2" name="assign_to">
                                            <label class="form-check-label" for="assign_to">Branch</label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" id="assign_to"
                                                value="3" name="assign_to">
                                            <label class="form-check-label" for="assign_to">Department</label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" id="assign_to"
                                                value="4" name="assign_to">
                                            <label class="form-check-label" for="assign_to">Unit</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                        @if (isset($data))
                                            {{ ucwords(lang('save', $translation)) }}
                                        @else
                                            {{ ucwords(lang('submit', $translation)) }}
                                        @endif
                                    </button>
                                    <a href="{{ route('admin.unit.list') }}" class="btn btn-danger"><i
                                            class="fa fa-times"></i>&nbsp;
                                        @if (isset($data))
                                            {{ ucwords(lang('close', $translation)) }}
                                        @else
                                            {{ ucwords(lang('cancel', $translation)) }}
                                        @endif
                                    </a>
                                </div>
                            </div>

                        </form>
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
