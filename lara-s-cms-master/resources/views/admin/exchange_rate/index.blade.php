
@extends('_template_adm.master')

@php

    // USE LIBRARIES
    use App\Libraries\Helper;


    $pagetitle = ucwords(lang('Exchange_Rates', $translation));


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
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                  {{-- @if (Helper::authorizing('Branch', 'Restore')['status'] == 'true')
                    <a href="{{ route('admin.branch.deleted') }}" class="btn btn-round btn-danger" style="float: right; margin-bottom: 5px;" data-toggle="tooltip" title="{{ ucwords(lang('view deleted items', $translation)) }}">
                      <i class="fa fa-trash"></i>
                    </a>
                  @endif --}}
                  <a href="{{ route('admin.exchange_rates.create') }}"class="btn btn-round btn-success" style="float: right;">
                    <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('add new', $translation)) }}
                  </a>
                </div>
              </div>
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

                        <table  class="table table-bordered">
                            <thead>
                                <tr class="table table-bordered">
                                  <th>Currency</th>
                                  <th>TT(Buy)</th>
                                  <th>TT(Sell)</th>

                                  {{-- <th>Designation</th>
                                  <th>Functional_Designation</th>
                                  <th>Branch</th>
                                  <th>Department</th>
                                  <th>Unit</th> --}}

                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="sorted_table">
                                @foreach($links as $exchange_rates)
                                <tr>
                                    <td>{{$exchange_rates->currency}}</td>
                                    <td>{{$exchange_rates->tt_buy}}</td>
                                    <td>{{$exchange_rates->tt_sell}}</td>

                                    <td>
                                        <a href="{{ route('admin.exchange_rates.edit', $exchange_rates->id) }}" class="btn btn-xs btn-primary" title="{{ ucwords(lang('edit', $translation)) }}">
                                          <i class="fa fa-pencil"></i>&nbsp; {{ ucwords(lang('edit', $translation)) }}
                                        </a>
                                        <form action="{{ route('admin.exchange_rates.destroy', $exchange_rates->id) }}" method="POST" onsubmit="return confirm('{{ lang('Are you sure to delete this #item?', $translation, ['#item'=>'rate item']) }}');" style="display: inline">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="id" value="{{ $exchange_rates->id }}">
                                          <button type="submit" class="btn btn-xs btn-danger" title="{{ ucwords(lang('delete', $translation)) }}">
                                            <i class="fa fa-trash"></i>&nbsp; {{ ucwords(lang('delete', $translation)) }}
                                          </button>
                                        </form>
                                      </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                          {!! $links->links() !!}
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
