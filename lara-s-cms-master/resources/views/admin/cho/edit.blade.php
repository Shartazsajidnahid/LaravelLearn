@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('CHO', $translation));
    $link_get_data = route('admin.employees.get_data');

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

                        <form class="form-horizontal form-label-left" action="{{ route('admin.cho.update', $cho->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Employee ID
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('user_name', $data['employeeList'], $value = $cho->user_id, [
                                        'id' => 'user_name',
                                        'class' => 'form-control select2',
                                        'placeholder' => 'Select a Employee',
                                    ]) !!}
                                    @if ($errors->has('user_name'))
                                        <span class="required">{{ $errors->first('user_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Position
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="position" id="position">
                                        <option value=1 {{$cho->position==1?"selected":""}}> MD </option>
                                        <option value=2 {{$cho->position==2?"selected":""}}> DMD </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="name" aria-label="First name" id="name" readonly value="{{$cho->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Designation
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="designation" aria-label="designation" id="designation" readonly value="{{$cho->designation}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Functional Designation
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" name="designation" aria-label="designation" id="functional_designation" value="{{$cho->functional_designation}}" readonly >
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" class="form-control" name="email" aria-label="email" id="email" readonly value="{{$cho->email}}">
                                </div>
                            </div>
                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Phone
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" class="form-control" name="mobile" aria-label="phone" id="phone" readonly value="{{$cho->phone}}">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Select branches
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <select multiple id="select1" name="selected[]" size="10" class="select2">
                                        @foreach ($branches as $cntrl)
                                            <option value="{{ $cntrl->id }}" {{in_array($cntrl->id, $jsonBranch)?"selected":""}}>
                                                {{ $cntrl->name }}
                                            </option>
                                            <hr>
                                            <br>
                                        @endforeach
                                    </select>
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
<script>
    jQuery(document).ready(function() {
        jQuery('#user_name').change(function() {
            let user_name = jQuery(this).val();
            jQuery.ajax({
                url: '{{ $link_get_data }}',
                type: 'post',
                data: 'user_name=' + user_name + '&_token={{ csrf_token() }}',


                success: function(response) {
                    if (typeof response.status != 'undefined') {
                        if (response.status == 'true') {
                            var html = '';
                            if (response.data == '') {
                                html +=
                                    '<p colspan="6"><h2 class="text-center">{{ strtoupper(lang('no data available', $translation)) }}</h2></p>';
                            } else {
                                $('#name').val(response.data.name) ;
                                $('#phone').val(response.data.phone) ;
                                $('#email').val(response.data.email) ;
                                $('#designation').val(response.data.designation) ;
                                $('#functional_designation').val(response.data.functional_designation) ;
                            }
                            $('#haha').html(html);

                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert('Server not respond, please refresh your page');
                    }
                }

            });
        });


    });
</script>
@endsection
