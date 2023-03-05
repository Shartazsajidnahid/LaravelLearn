@extends('_template_adm.master')

@section('title', ucwords(lang('Add Controller', $translation)))
@php
    $link = route('admin.createcontroller');
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="{{ $link }}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Controller name</label>
                        <input type="text" class="form-control" id="title" name="controller_name">
                    </div>

                </div>


                <div class="row">
                    <button type="submit" class="btn btn-primary">Add Controller</button>
                </div>

            </form>

        </div>
    </div>
@endsection
