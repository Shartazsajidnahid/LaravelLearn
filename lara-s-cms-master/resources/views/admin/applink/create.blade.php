@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Applinks', $translation));
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

                        <form class="form-horizontal form-label-left"   action="{{ route('admin.applink.do_create') }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group vinput_main_branch">
                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control"
                                name="name" aria-label="First name">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Links
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="url" class="form-control"
                                name="link" >
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" class="form-control"
                                name="image" aria-label="First name">
                                </div>
                            </div>
                            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                            <button  type="submit" class="btn btn-danger">Submit</button>
                            </div>


                            {{-- <center>
                            <div>
                            Name :<input type="text" class="form-control" placeholder="First name"
                                name="name" aria-label="First name">
                                <div>
                                </center> --}}
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

@endsection
