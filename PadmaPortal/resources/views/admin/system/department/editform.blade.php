@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('department', $translation));

    $pagetitle .= ' ('.ucwords(lang('edit', $translation)).')';
    $link = route('admin.department.do_edit', $data['id']);

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

                        {{-- branches --}}
                        <div class="form-group vinput_main_branch" >
                            <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                Main Branch
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" name="branch_id">
                                    @foreach ($branches as $cntrl)
                                        <option value="{{ $cntrl->id }}">
                                            {{ $cntrl->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group vinput_main_branch" >
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control" id="title" name="name" value="{{ $data['name'] }}">
                            </div>
                        </div>

                        <div class="form-group vinput_main_branch" >
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                Phone
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['phone'] }}">
                            </div>
                        </div>

                        <div class="form-group vinput_main_branch" >
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                Location
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control" id="location" name="location" value="{{ $data['location'] }}">
                            </div>
                        </div>

                        <div class="form-group vinput_main_branch" >
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">
                                Status
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            </div>

                        </div>

                        <div class="form-group vinput_main_branch" >
                            <label  class="control-label col-md-3 col-sm-3 col-xs-12">

                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection

@section('script')
    <!-- Switchery -->
    @include('_form_element.switchery.script')
@endsection



