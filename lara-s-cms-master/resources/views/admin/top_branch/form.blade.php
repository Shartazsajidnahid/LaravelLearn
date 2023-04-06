@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Top 10 branch', $translation));
    $link_get_data = route('admin.department.get_branches');
    if (isset($data)) {
        $pagetitle .= ' (' . ucwords(lang('edit', $translation)) . ')';
        $link = route('admin.top_branch.do_edit', $data->id);
    } else {
        $pagetitle .= ' (' . ucwords(lang('new', $translation)) . ')';
        $link = route('admin.top_branch.store');
        $data = null;
    }
    // $link_get_data = route('admin.branch.get_data');
    $function_get_data = 'refresh_data();';
    $updated_branches = $branches;
    $x = 'haha';
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

                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Rank
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">

                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                        Branches
                                    </label>
                                </div>
                            </div>
                            <br>
                            {{-- @foreach (range(1, 10) as $id) --}}
                            <div class="form-group vinput_main_branch">

                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    1
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_1" id="branch_1">
                                        {{-- <option>Select Division</option> --}}
                                        @foreach ($updated_branches as $cntrl)
                                            <option value="{{ $cntrl['id'] }}">
                                                {{ $cntrl['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    2
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_2" id="branch_2">
                                        {{-- <option>Select Division</option> --}}
                                        @foreach ($updated_branches as $cntrl)
                                            <option value="{{ $cntrl['id'] }}">
                                                {{ $cntrl['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    3
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_3" id="branch_3">
                                        {{-- <option>Select Division</option> --}}
                                        @foreach ($updated_branches as $cntrl)
                                            <option value="{{ $cntrl['id'] }}">
                                                {{ $cntrl['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    4
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_4" id="branch_4">
                                        {{-- <option>Select Division</option> --}}
                                        @foreach ($updated_branches as $cntrl)
                                            <option value="{{ $cntrl['id'] }}">
                                                {{ $cntrl['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    5
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="branch_5" id="branch_5">
                                        {{-- <option>Select Division</option> --}}
                                        @foreach ($updated_branches as $cntrl)
                                            <option value="{{ $cntrl['id'] }}">
                                                {{ $cntrl['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            {{-- @endforeach --}}
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
                                    <a href="{{ route('admin.department.list') }}" class="btn btn-danger"><i
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

    {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}
    <script>
        // Initialize Select2
        $('.select2').select2();
    </script>
    <script>
        jQuery(document).ready(function() {
            $.fn.myFunction = function(id){
                alert('You have successfully defined the function!' . id);
            }
            jQuery('#branch_4').change(function() {
                let div_id = jQuery(this).val();
                // alert(div_id);
                $.fn.myFunction(div_id);

                // jQuery.ajax({
                //     url: '{{ $link_get_data }}',
                //     type: 'post',
                //     data: 'div_id=' + div_id + '&_token={{ csrf_token() }}',
                //     success: function(result) {
                //         jQuery('#branches').html(result)
                //     }
                // });
            });

        });
    </script>
    <script></script>
@endsection
