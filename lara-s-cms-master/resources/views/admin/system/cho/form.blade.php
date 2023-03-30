@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('CHO', $translation));
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
                        <div class="row">
                            <div class="col-md-6">
                                <form method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row col-md-8">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                  Check me out
                                                </label>
                                              </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <form method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row col-md-8">
                                        <div class="form-group">
                                            <label for="inputState">Name</label>
                                            <input type="text" class="form-control" placeholder="First name"
                                                name="name" aria-label="First name">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
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

    <script></script>
@endsection
