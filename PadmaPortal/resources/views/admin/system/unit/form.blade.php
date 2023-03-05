@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('unit', $translation));
    if(isset($data)){
        $pagetitle .= ' ('.ucwords(lang('edit', $translation)).')';
        $link = route('admin.unit.do_edit', $data->id);
    }else {
        $pagetitle .= ' ('.ucwords(lang('new', $translation)).')';
        $link = route('admin.unit.do_create');
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
                        <br />
                        <form class="form-horizontal form-label-left" action="{{ $link }}" method="POST">
                            {{ csrf_field() }}

                            @php

                                $config = new \stdClass();
                                $config->placeholder = ucwords(lang('please choose one', $translation));
                                $config->defined_data = $dept;
                                $config->field_value = 'id';
                                $config->field_text = 'name';
                                echo set_input_form2('select2', 'department_id', ucwords(lang('department', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                echo set_input_form2('text', 'name', ucwords(lang('name', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                $config->placeholder = '6281234567890';
                                echo set_input_form2('number', 'phone', ucwords(lang('phone', $translation)), $data, $errors, false, $config);

                                echo set_input_form2('textarea', 'location', ucwords(lang('location', $translation)), $data, $errors, false);

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
                                    <a href="{{ route('admin.unit.list') }}" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;
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
@endsection
