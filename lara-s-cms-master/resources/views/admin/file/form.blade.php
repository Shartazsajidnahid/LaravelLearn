@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('file', $translation));

    $link_get_data = route('admin.department.get_branches');
    $link_get_data_dept = route('admin.unit.get_depts');
    $link_get_data_unit = route('admin.unit.get_units');
    if (isset($data)) {
        $pagetitle .= ' (' . ucwords(lang('edit', $translation)) . ')';
        $link = route('admin.file.do_edit', $data->id);
    } else {
        $pagetitle .= ' (' . ucwords(lang('new', $translation)) . ')';
        $link = route('admin.file.do_create');
        $data = null;
    }
    // $link_get_data = route('admin.branch.get_data');
    $function_get_data = 'refresh_data();';

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
                        <form class="form-horizontal form-label-left" action="{{ $link }}"
                            method="POST"enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @php
                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                echo set_input_form2('text', 'name', ucwords(lang('filename', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->placeholder = ucwords(lang('please choose one', $translation));
                                $config->defined_data = $filetypes;
                                $config->field_value = 'id';
                                $config->field_text = 'filetype';
                                echo set_input_form2('select2', 'file_type', ucwords(lang('file type', $translation)), $data, $errors, true, $config);

                            @endphp

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"" for="file">File:</label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            @if (!isset($data))


                                @if ($adminid == 1)
                                    <div class="form-group vinput_main_branch">
                                        <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                            Office
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control select2" name="division_id" id="divisions">
                                                <option>Select Office</option>
                                                @foreach ($divisions as $cntrl)
                                                    <option value="{{ $cntrl->id }}"
                                                        onclick="javascript:choosebranch();">
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
                                @endif
                            @endif

                            @php
                                $config = new \stdClass();
                                $config->default = 'checked';
                                echo set_input_form2('switch', 'status', ucwords(lang('status', $translation)), $data, $errors, false, $config);
                            @endphp

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
                                    <a href="{{ route('admin.file.list') }}" class="btn btn-danger"><i
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
    <script>
        // Initialize Select2
        $('.select2').select2();
    </script>
@endsection
