@extends('_template_adm.master')

@section('title', ucwords(lang('Add Menu', $translation)))
@php
    $link = route('admin.department.do_edit', $data['id']);
@endphp

@section('content')

    <form action="{{ $link }}" method="post">
        @csrf

        <div class="form-group ">
            <label for="inputState">Select Controller</label>

            <select class="form-control" name="branch_id">
                @foreach ($branches as $cntrl)
                    <option value="{{ $cntrl->id }}">
                        {{ $cntrl->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Name</label>
                <input type="text" class="form-control" id="title" name="name" value="{{ $data['name'] }}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['phone'] }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $data['location'] }}">
            </div>
        </div>


        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
            <label class="form-check-label" for="flexSwitchCheckChecked">Status</label>
          </div>
        <div class="form-group">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>



@endsection
