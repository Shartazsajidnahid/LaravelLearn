@extends('_template_adm.master')

@php
    $pagetitle = ucwords(lang('department', $translation));
    $link_get_data = route('admin.department.get_data');
    if (isset($data)) {
        $pagetitle .= ' (' . ucwords(lang('edit', $translation)) . ')';
        $link = route('admin.department.do_edit', $data->id);
    } else {
        $pagetitle .= ' (' . ucwords(lang('new', $translation)) . ')';
        $link = route('admin.department.do_create');
        $data = null;
    }
    $link_get_data = route('admin.branch.get_data');
    $chosenbranches = $branches;
    $x = 'haha';
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
                            {{-- <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Division
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="parent_branch_id" id="divisions">
                                        @foreach ($divisions as $cntrl)
                                            <option value="{{ $cntrl->id }}" onclick="javascript:choosebranch();">
                                                {{ $cntrl->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="input-prepend input-group">

                                      <select style="width: 200px" id="filterlist-division" class="form-control select2">
                                        @if (isset($divisions))
                                          @foreach ($divisions as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                          @endforeach
                                          <option value="all">- {{ ucwords(lang('choose all', $translation)) }} -</option>
                                        @else
                                          <option value="no_data" disabled>*NO DATA</option>
                                        @endif
                                      </select>
                                    </div>
                                  </div>
                                </div>
                            </div>


                            <div class="form-group vinput_main_branch">
                                <label for="parent branch" class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Branch
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="parent_branch_id" id="branches">
                                        {{-- @foreach ($chosenbranches as $cntrl)
                                            <option value="{{ $cntrl->id }}" >
                                                {{ $cntrl->name }}
                                            </option>
                                        @endforeach --}}
                                        <option>Select branch</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group vinput_main_branch">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    check
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="check" name="name">
                                </div>
                            </div>

                            @php
                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                echo set_input_form2('text', 'name', ucwords(lang('name', $translation)), $data, $errors, true, $config);

                                $config = new \stdClass();
                                $config->attributes = 'autocomplete="off"';
                                $config->placeholder = '6281234567890';
                                echo set_input_form2('number', 'phone', ucwords(lang('phone', $translation)), $data, $errors, false, $config);

                                echo set_input_form2('textarea', 'location', ucwords(lang('location', $translation)), $data, $errors, false);

                                $config = new \stdClass();
                                $config->default = 'checked';
                                echo set_input_form2('switch', 'status', ucwords(lang('status', $translation)), $data, $errors, false, $config);
                            @endphp

                            <div class="ln_solid"></div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                        @if (isset($data))
                                            {{ ucwords(lang('save', $translation)) }}
                                        @else
                                            {{ ucwords(lang('submit', $translation)) }}
                                        @endif
                                    </button>
                                    <a href="{{ route('admin.department.list') }}" class="btn btn-danger"><i
                                            class="fa fa-times"></i>&nbsp;
                                        @if (isset($data))
                                            {{ ucwords(lang('close', $translation)) }}
                                        @else
                                            {{ ucwords(lang('cancel', $translation)) }}
                                        @endif
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
        var AjaxSortingURL = '{{ route("admin.branch.sorting") }}';

        $(document).ready(function() {
          {{ $function_get_data }}

          $('#filterlist-division').on('change', function() {
            {{ $function_get_data }}
            $(this).blur();
          })
        });

        function refresh_data() {
          $('#datatables').show();

          var division = $('#filterlist-division').val();
          if (typeof division == 'undefined') {
            var division = 'all';
          }

          $.ajax({
            type: 'GET',
            url: '{{ $link_get_data }}',
            data: {
              division: division,
            },
            success: function(response){
              // console.log(response);
              if (typeof response.status != 'undefined') {
                if (response.status == 'true') {
                  var html = '';
                  if (response.status == 'true') {
                  var html = '';
                  if (response.data == '') {
                    html += '<option value="">Select Branches</option>';
                  } else {
                    $.each(response.data, function (index, value) {
                      html += '<option>';
                        // html += '<td>'+value.division_name+'</td>';
                        html += value.name;
                      html += '</option>';
                    });
                  }
                  $('#branches').html(html);
                }  else {
                  alert(response.message);
                }
              } else {
                alert ('Server not respond, please refresh your page');
              }
            },
            error: function (data, textStatus, errorThrown) {
              console.log(data);
              console.log(textStatus);
              console.log(errorThrown);
            }
          });
        }

        function refresh_data_deleted() {
          $('#datatables-deleted').show();

          var division = $('#filterlist-division').val();
          if (typeof division == 'undefined') {
            var division = 'all';
          }

          $.ajax({
            type: 'GET',
            url: '{{ $link_get_data }}',
            data: {
              division: division,
            },
            success: function(response){
              // console.log(response);
              if (typeof response.status != 'undefined') {
                if (response.status == 'true') {
                  var html = '';
                  if (response.data == '') {
                    html += '<tr><td colspan="6"><h2 class="text-center">{{ strtoupper(lang("no data available", $translation)) }}</h2></td></tr>';
                  } else {
                    $.each(response.data, function (index, value) {
                      html += '<tr>';
                        html += '<td>'+value.division_name+'</td>';
                        html += '<td>'+value.name+'</td>';

                        var status_item = '<span class="label label-danger"><i>{{ ucwords(lang("disabled", $translation)) }}</i></span>';
                        if (value.status == 1) {
                          status_item = '<span class="label label-success">{{ ucwords(lang("enabled", $translation)) }}</span>';
                        }
                        html += '<td>'+status_item+'</td>';
                        html += '<td>'+value.created_at_edited+'</td>';
                        html += '<td>'+value.deleted_at_edited+'</td>';

                        action_restore = '<form action="{{ route("admin.branch.restore") }}" method="POST" onsubmit="return confirm(\'{{ lang("Are you sure to restore this #item?", $translation, ["#item"=>$this_object]) }}\');" style="display: inline">{{ csrf_field() }}<input type="hidden" name="id" value="'+value.id+'"><button type="submit" class="btn btn-xs btn-primary" title="{{ ucwords(lang("restore", $translation)) }}"><i class="fa fa-check"></i>&nbsp; {{ ucwords(lang("restore", $translation)) }}</button></form>';
                        html += '<td>'+action_restore+'</td>';
                      html += '</tr>';
                    });
                  }
                  $('#sortable-data-deleted').html(html);
                } else {
                  alert(response.message);
                }
              } else {
                alert ('Server not respond, please refresh your page');
              }
            },
            error: function (data, textStatus, errorThrown) {
              console.log(data);
              console.log(textStatus);
              console.log(errorThrown);
            }
          });
        }
      </script>
@endsection
