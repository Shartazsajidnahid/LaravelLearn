@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Top 10 branch', $translation));
    $link_get_data = route('admin.top_branch.get_branches');
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

                            <br>
                            @foreach (range(1, 10) as $id)

                            <div class="form-group vinput_main_branch">

                                <label for="branch_{{$id}}" class="control-label col-md-3 col-sm-3 col-xs-12 tex-center">
                                    {{$id}}
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control select2" name="branch_{{$id}}" id="branch_{{$id}}">
                                        <option value=0> Choose one </option>
                                        @foreach ($branches as $item)
                                            <option value={{$item['id']}}>{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach
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



@endsection
