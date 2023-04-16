@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang(' cho', $translation));

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

                        <form class="form-horizontal form-label-left" action="{{ route('admin.cho.update', $cho->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="name" aria-label="First name"
                                        value="{{ $cho->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Designation
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{-- <select class="form-control select2" name="designation">
                                        @if ($cho->designation == 1)
                                            <option value="1" selected>
                                                MD
                                            </option>
                                            <option value="2">
                                                DMD
                                            </option>
                                        @else
                                            <option value="1">
                                                MD
                                            </option>
                                            <option value="2" selected>
                                                DMD
                                            </option>
                                        @endif
                                    </select> --}}

                                    <select class="form-control select2" name="designation">

                                        <option value="1" {{($cho->designation==1)?"selected":""}}>
                                            MD
                                        </option>
                                        <option value="2"  {{($cho->designation==2)?"selected":""}}>
                                            DMD
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" class="form-control" name="email" aria-label="email" value="{{ $cho->email }}">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Phone
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" class="form-control" name="mobile" aria-label="phone" value="{{ $cho->mobile }}">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" class="form-control" name="profile_image" aria-label="image" >
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Select branches
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{-- <div style="float:left;text-align: center; margin:10px "> --}}

                                    <select multiple name="selected[]" size="10" class="select2">
                                        @foreach ($branches as $cntrl)
                                            <option value="{{ $cntrl->id }}" {{in_array($cntrl->id, $jsonBranch)?"selected":""}}>
                                                {{ $cntrl->name }}
                                            </option>
                                            <hr>
                                            <br>
                                        @endforeach
                                    </select>
                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                        {{ ucwords(lang('submit', $translation)) }}
                                    </button>
                                    <a href="{{ route('admin.cho.list') }}" class="btn btn-danger"><i
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


@endsection
