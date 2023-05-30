@php
    // USE LIBRARIES
    use App\Libraries\Helper;

    $link_get_data = route('general.divisions.get_data');
    $link_download_data = route('general.divisions.download_data');
    $function_get_data = 'refresh_data();';

@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AllInfo</title>
    <meta name="description" content="Bootstrap.">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</head>

<body>

    <nav class="navbar navbar-dark " style=" background-color:  #500485;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ URL::route('general.home') }}" class="u-image u-logo u-image-1" title="Home">
                    <img src="{{ asset('images/logowhite.png') }}" class="u-logo-image u-logo-image-1" width="120"
                        height="75">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="">
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base"
                            href="{{ URL::route('general.home') }}" style="padding: 27px ;font-weight: 1000">Home</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base"
                            href="{{ URL::route('general.allbrance') }}" style="padding: 27px ;font-weight: 1000">All
                            Branches</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base"
                            href="{{ URL::route('general.alldivision') }}" style="padding: 27px ;font-weight: 1000">All
                            Divisions</a>
                    </li>
                    <li class="u-nav-item">
                        <a href="{{ URL::route('general.allemployees') }}" style="padding: 27px ;font-weight: 1000">All
                            Employees</a>
                    </li>
                    <li class="u-nav-item">
                        <a href="{{ URL::route('general.allfiles') }}" style="padding: 27px ;font-weight: 1000">All
                            Files</a>
                    </li>
                    <li class="u-nav-item">
                        <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-body-alt-color u-text-hover-palette-2-base danger"
                            href="{{ URL::route('general.logout') }}"
                            style="padding: 27px ;font-weight: 1000">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        {{ Form::open(['url' => route('general.divisions.download_data'), 'method' => 'get']) }}
        <div class="row">
            {{-- filter by: division --}}
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon"><i class="fa fa-bank"></i></span>
                            <select style="width: 200px" id="office" class="form-control select2" name="office">

                                <option value="1">All Branch</option>
                                <option value="2">All Department</option>
                                <option value="3">All Unit</option>
                                <option value="4">All Subbranch</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-7 col-sm-12 col-xs-12">
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12">
                <div class="control-group">

                    <div class="controls">
                        <div class="input-prepend input-group">
                            <button type="submit" id="download" class="btn btn-lg btn-dark form-control"><i
                                    class="fa fa-download">&nbsp; Download </i></button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}

            <br><br>
            <div class="row header" style="text-align:center;color:rgb(71, 14, 54)">
                <h3></h3>
            </div>
            <table id="myTable" class="table table-striped table-bordered table-responsive table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">Name</th>
                        <th style="text-align: center">Location</th>
                        <th style="text-align: center">Phone</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($branches as $item)
                        <tr>
                            <td style="text-align: center">{{ $item->name ?? '-' }}</td>
                            <td style="text-align: center">{{ $item->location ?? '-' }}</td>
                            <td style="text-align: center">{{ $item->phone ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



</body>

<script>
    $(document).ready(function() {
        $('#myTable').dataTable();
    });
</script>

<script>
    jQuery(document).ready(function() {
        jQuery('#office').change(function() {
            let div_type = jQuery(this).val();
            // alert(div_type);
            jQuery.ajax({
                url: '{{ $link_get_data }}',
                type: 'get',
                data: {
                    div_type: div_type,
                },

                success: function(response) {
                    if (typeof response.status != 'undefined') {
                        if (response.status == 'true') {
                            var html = '';
                            if (response.data == '') {
                                html +=
                                    '<tr><td colspan="6"><h2 class="text-center">{{ strtoupper(lang('no data available', $translation)) }}</h2></td></tr>';
                            } else {
                                $.each(response.data, function(index, value) {
                                    html += '<tr>';
                                    if (value.name == null) {
                                        html +=
                                            '<td style="text-align: center">-</td>';
                                    } else {
                                        html += '<td style="text-align: center">' +
                                            value.name + '</td>';
                                    }
                                    if (value.location == null) {
                                        html +=
                                            '<td style="text-align: center">-</td>';
                                    } else {
                                        html += '<td style="text-align: center">' +
                                            value.location + '</td>';
                                    }
                                    if (value.phone == null) {
                                        html +=
                                            '<td style="text-align: center">-</td>';
                                    } else {
                                        html += '<td style="text-align: center">' +
                                            value.phone + '</td>';
                                    }
                                    html += '</tr>';
                                });
                            }
                            $('#tableBody').html(html);
                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert('Server not respond, please refresh your page');
                    }
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(errorThrown);
                }

            });
        });


    });
</script>

</html>
