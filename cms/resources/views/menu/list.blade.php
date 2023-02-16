@extends('_template_adm.master')

@section('title', ucwords(lang('Add Menu', $translation)))
@php
    $link = route('admin.createmenu');
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
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
                        <label for="controller">Controller name</label>
                        <input type="text" class="form-control" id="controller" name="controller">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="route">Function name</label>
                        <input type="text" class="form-control" id="function" name="function">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="route">Route slug</label>
                        <input type="text" class="form-control" id="function" name="slug">
                    </div>
                </div>
                {{-- <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="inputState">Parent menu</label>
                    <select id="inputState" class="form-control">
                        <option selected>First menu</option>
                        <option>Second menu</option>
                    </select>
                </div>
            </div> --}}

                <div class="form-row my-5">
                    <div class="form-group col-md-4">
                        <label for="inputState">Parent menu</label>

                        <select name="parent_id">
                            <option value=0 selected>None</option>
                            @foreach ($menulist as $menu)
                                <option value="{{ $menu->id }}">
                                    {{ $menu->menu_title }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Add menu</button>
                </div>

            </form>

        </div>
    </div>
@endsection
