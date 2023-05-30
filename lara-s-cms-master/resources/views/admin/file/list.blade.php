@extends('_template_adm.master')

@php
    // USE LIBRARIES
    use App\Libraries\Helper;

    $this_object = ucwords(lang('file', $translation));

    $link_get_data = route('admin.file.get_files');
    $function_get_data = 'refresh_data();';
    if (isset($data)) {
        $pagetitle = $this_object;
    } else {
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
                        <a href="{{ route('admin.file.deleted') }}" class="btn btn-round btn-danger"
                            style="float: right; margin-bottom: 5px;" data-toggle="tooltip"
                            title="{{ ucwords(lang('view deleted items', $translation)) }}">
                            <i class="fa fa-trash"></i>
                        </a>
                        {{-- @endif --}}
                        <a href="{{ route('admin.file.create') }}" class="btn btn-round btn-success" style="float: right;">
                            <i class="fa fa-plus-circle"></i>&nbsp; {{ ucwords(lang('add new', $translation)) }}
                        </a>
                    </div>
                </div>
            @else
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right">
                        <a href="{{ route('admin.file.list') }}" class="btn btn-round btn-primary" style="float: right;">
                            <i class="fa fa-check-circle"></i>&nbsp; {{ ucwords(lang('active items', $translation)) }}
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="control-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <span class="add-on input-group-addon"><i class="fa fa-bank"></i></span>
                      <select style="width: 200px" id="filetypes" class="form-control select2">
                        @if (isset($filetypes))
                          @foreach ($filetypes as $item)
                            <option value="{{ $item->id }}">{{ $item->filetype }}</option>
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
                                        <th>{{ ucwords(lang('file name', $translation)) }}</th>
                                        <th>{{ ucwords(lang('file', $translation)) }}</th>
                                        <th>{{ ucwords(lang('type', $translation)) }}</th>

                                        @if (isset($deleted))
                                            <th>{{ ucwords(lang('deleted at', $translation)) }}</th>
                                        @else
                                            <th>{{ ucwords(lang('created', $translation)) }}</th>
                                            <th>{{ ucwords(lang('last updated', $translation)) }}</th>
                                        @endif
                                        <th>{{ ucwords(lang('action', $translation)) }}</th>
                                    </tr>
                                </thead>
                                <tbody class="sorted_table" id="sortable-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <!-- Select2 -->
    @include('_form_element.select2.css')
@endsection

@section('script')
    <!-- Select2 -->
    @include('_form_element.select2.script')

    <script>
        // Initialize Select2
        $('.select2').select2();
    </script>
    <script>
        $(document).ready(function() {
        {{ $function_get_data }}

        $('#filetypes').on('change', function() {
            {{ $function_get_data }}
            $(this).blur();
        })
        });

        function refresh_data() {
        // $('#datatables').show();

        var filetypeid = $('#filetypes').val();
        if (typeof filetypeid == 'undefined') {
            var filetypeid = 0;
        }
        if (filetypeid == 'all') {
            filetypeid = 0;
        }
        $.ajax({
            type: 'GET',
            url: '{{ $link_get_data }}',
            data: {
                filetypeid: filetypeid,
            },
            success: function(response){
            console.log(response.data);

            if (typeof response.status != 'undefined') {
                if (response.status == 'true') {
                var html = '';
                if (response.data == '') {
                    html += '<tr><td colspan="6"><h2 class="text-center">{{ strtoupper(lang("no data available", $translation)) }}</h2></td></tr>';
                } else {
                    $.each(response.data, function (index, value) {
                        html += '<tr role="row" id="row-'+value.id+'" title="{{ ucfirst(lang("Drag & drop to sorting", $translation)) }}" data-toggle="tooltip">';
                        html += '<td class="dragndrop">'+value.name+'</td>';
                        filepath = '<a href="'+value.filepath+'" target="_blank">View file</a>';

                        // filepath = '<a target="_blank"></a>';
                        html += '<td>'+filepath+'</td>';
                        html += '<td>'+value.filetypename+'</td>';
                        // html += '<td>';
                        // html+='<a href="'+value.filepath+'target="_blank"></a>';
                        // html+='</td>';



                        var status_item = '<span class="label label-danger"><i>{{ ucwords(lang("disabled", $translation)) }}</i></span>';
                        if (value.status == 1) {
                        status_item = '<span class="label label-success">{{ ucwords(lang("enabled", $translation)) }}</span>';
                        }
                        // html += '<td>'+status_item+'</td>';
                        html += '<td>'+value.created_at+'</td>';
                        html += '<td>'+value.updated_at+'</td>';

                        action_edit = '<a href="{{ url("/manager/system/file/edit") }}/'+value.id+'" class="btn btn-xs btn-primary" title="{{ ucwords(lang("edit", $translation)) }}"><i class="fa fa-pencil"></i>&nbsp; {{ ucwords(lang("edit", $translation)) }}</a>';
                        action_delete = '<form action="{{ route("admin.branch.delete") }}" method="POST" onsubmit="return confirm(\'{{ lang("Are you sure to delete this #item?", $translation, ["#item"=>$this_object]) }}\');" style="display: inline">{{ csrf_field() }}<input type="hidden" name="id" value="'+value.id+'"><button type="submit" class="btn btn-xs btn-danger" title="{{ ucwords(lang("delete", $translation)) }}"><i class="fa fa-trash"></i>&nbsp; {{ ucwords(lang("delete", $translation)) }}</button></form>';
                        html += '<td>'+action_edit+action_delete+'</td>';
                    html += '</tr>';
                    });
                }
                $('#sortable-data').html(html);
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
