@extends('_template_adm.master')

@section('title', ucwords(lang('Add Menu', $translation)))
@php
    $link = route('admin.createmenu');
@endphp

@section('content')

    <form action="{{ $link }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputAddress">Menu title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputState">Parent menu</label>
                <select id="inputState" class="form-control" name="parent_id">
                    <option value=0 selected>None</option>
                    @foreach ($menulist as $menu)
                        <option value="{{ $menu->id }}">
                            {{ $menu->menu_title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputState">Select Controller</label>

                <select class="form-control" name="controller_id">
                    @foreach ($controllers as $cntrl)
                        <option value="{{ $cntrl->id }}">
                            {{ $cntrl->controller_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group col-md-6">
                <label for="route">Function name</label>
                <input type="text" class="form-control" id="function" name="function">
            </div>

            <div class="form-group col-md-6">
                <label for="inputState">Select Function Type</label>

                <select class="form-control" name="function_type">
                    <option value="get">
                        GET
                    </option>
                    <option value="post">
                        POST
                    </option>
                    <option value="put">
                        PUT
                    </option>
                    <option value="delete">
                        DELETE
                    </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Add menu</button>
            </div>
        </div>

    </form>



@endsection
