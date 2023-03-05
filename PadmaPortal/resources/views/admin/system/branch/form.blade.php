@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('branch', $translation));
    if (isset($data)) {
        $pagetitle .= ' (' . ucwords(lang('edit', $translation)) . ')';
        $link = route('admin.branch.do_edit', $data->id);
    } else {
        $pagetitle .= ' (' . ucwords(lang('new', $translation)) . ')';
        $link = route('admin.branch.do_create');
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
                                // set_input_form2($type, $input_name, $label_name, $data, $errors, $required = false, $config = null)
                                $config = new \stdClass();
                                $config->placeholder = ucwords(lang('please choose one', $translation));
                                $config->defined_data = $divisions;
                                $config->field_value = 'id';
                                $config->field_text = 'name';
                                echo set_input_form2('select2', 'division_id', ucwords(lang('branch type', $translation)), $data, $errors, true, $config);
                            @endphp

                            <div class="col-lg-6" style="float:none;margin:auto;">
                                {{-- <div class="form-group  vinput_parent_branch_id"> --}}
                                Sub-branch?&nbsp;&nbsp;&nbsp;Yes <input type="radio" onclick="javascript:yesnoCheck();"
                                    name="yesno" id="yesCheck" value="subBranchyes"> No <input type="radio"
                                    onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" value="subBranchno"><br>

                            </div>

                            <br>

                            <div class="form-group vinput_main_branch" id="ifYes" style="visibility:hidden">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Main Branch
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="parent_branch_id">
                                        @foreach ($branches as $cntrl)
                                            <option value="{{ $cntrl->id }}">
                                                {{ $cntrl->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            @php
                                // $config = new \stdClass();
                                // $config->placeholder = ucwords(lang('please choose one', $translation));
                                // $config->defined_data = $branches;
                                // $config->field_value = 'id';
                                // $config->field_text = 'name';
                                // echo set_input_form2('select2', 'parent_branch_id', ucwords(lang('main branch', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                echo set_input_form2('text', 'name', ucwords(lang('name', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                $config->placeholder = '6281234567890';
                                echo set_input_form2('number', 'phone', ucwords(lang('phone', $translation)), $data, $errors, false, $config);

                                echo set_input_form2('textarea', 'location', ucwords(lang('location', $translation)), $data, $errors, false);

                                echo set_input_form2('textarea', 'cbs_branch_code', ucwords(lang('cbs_branch_code', $translation)), $data, $errors, false);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                $config->placeholder = 'https://goo.gl/maps/xxx';
                                echo set_input_form2('text', 'gmaps', 'Gmaps <i class="fa fa-info-circle" data-toggle="tooltip" title="' . lang('How-To: Open Google Maps > Search location > Share > Copy link > Paste here', $translation) . '"></i>', $data, $errors, false, $config);

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
                                    <a href="{{ route('admin.branch.list') }}" class="btn btn-danger"><i
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

    <script>
        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                document.getElementById('ifYes').style.visibility = 'visible';
            } else document.getElementById('ifYes').style.visibility = 'hidden';

        }
    </script>
@endsection

