@extends('_template_adm.master')

@php
  // USE LIBRARIES
  use App\Libraries\Helper;
  $this_object = ucwords(lang('top 10 depositor', $translation));

  if(isset($data)){
    $pagetitle = $this_object;
  }else{
    $pagetitle = ucwords(lang('deleted #item', $translation, ['#item' => $this_object]));
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

      @if (isset($data))
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
            {{-- @if (Helper::authorizing('functional_designation', 'Restore')['status'] == 'true') --}}

            {{-- @endif --}}
            <a href="{{ route('admin.top_depositor.create') }}" class="btn btn-round btn-success" style="float: right;">
              <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('Set Top 10 Depositor', $translation)) }}
            </a>
          </div>
        </div>
      @else
        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
            <a href="{{ route('admin.top_depositor.list') }}" class="btn btn-round btn-primary" style="float: right;">
              <i class="fa fa-check-circle"></i>&nbsp; {{ ucwords(lang('active items', $translation)) }}
            </a>
          </div>
        </div>
      @endif
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{ ucwords(lang('data list', $translation)) }}</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>{{ ucwords(lang('Rank', $translation)) }}</th>
                    <th>{{ ucwords(lang('Employee', $translation)) }}</th>
                    <th>{{ ucwords(lang('User name', $translation)) }}</th>
                    @if (isset($deleted))
                      <th>{{ ucwords(lang('deleted at', $translation)) }}</th>
                    @else
                      <th>{{ ucwords(lang('created at', $translation)) }}</th>
                    @endif
                  </tr>
                </thead>
                @if (isset($data) && count($data) > 0)
                  <tbody class="sorted_table">
                    @foreach ($data as $item)
                      <tr role="row" id="row-{{ $item['id'] }}" title="{{ ucfirst(lang("Drag & drop to sorting", $translation)) }}" data-toggle="tooltip">
                        <td class="dragndrop">{{ $item['rank'] }}</td>
                        <td class="dragndrop">{{ $item['name'] }}</td>
                        <td class="dragndrop">{{ $item['user_name'] }}</td>
                        <td>{{ $item['created_at'] }}</td>

                      </tr>
                    @endforeach
                  </tbody>

                @else
                  <tbody>
                    <tr>
                      <td colspan="5"><h2 class="text-center">{{ strtoupper(lang('no data available', $translation)) }}</h2></td>
                    </tr>
                  </tbody>
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
