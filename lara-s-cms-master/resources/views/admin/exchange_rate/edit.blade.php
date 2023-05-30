@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('Exchange_rate', $translation));

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

                        <form class="form-horizontal form-label-left"
                            action="{{ route('admin.exchange_rates.update', $exchange_rate->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Currency
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="currency"
                                        value="{{ $exchange_rate->currency }}" aria-label="First name">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    TT(Buy)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" step="0.01" class="form-control" name="tt_buy"
                                        value="{{ $exchange_rate->tt_buy }}">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    TT(Sell)
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" step="0.01" class="form-control" name="tt_sell"
                                        aria-label="First name" value="{{ $exchange_rate->tt_sell }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                        {{ ucwords(lang('submit', $translation)) }}
                                    </button>
                                    <a href="{{ route('admin.exchange_rates.list') }}" class="btn btn-danger"><i
                                            class="fa fa-times"></i>&nbsp;
                                        {{ ucwords(lang('cancel', $translation)) }}
                                    </a>
                                </div>

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

    <script>
        // Initialize Select2
        $('.select2').select2();
    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> --}}


@endsection
