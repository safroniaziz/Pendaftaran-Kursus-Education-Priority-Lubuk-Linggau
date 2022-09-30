@extends('layouts.app')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-home"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->sure_name }}
    @endif
@endsection
@section('halaman')
    User
@endsection
@section('content-title')
    Dashboard
    <small>Education Priority</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> Education Priority</a></li>
    <li class="active">Dashboard</li>
@endsection
@section('sidebar-menu')
    @include('user/sidebar')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Edit Data Abstrak</h3>
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-xs-12 col-md-6">
                        <p class="lead">Metode Pembayaran:</p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Silahkan lakukan pembayaran memalui <strong>{{ $setting->bank }}</strong> dengan nomor rekening <strong>{{ $setting->norek }}</strong>
                        </p>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <p class="lead">Total Pembayaran</p>
                        <div class="table-responsive">
                            <table class="table table-hover" style="margin-bottom:10px !important;">
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    @php
                                    @endphp
                                    <td>Rp. {{ number_format($setting->biaya_pendaftaran) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @php
                            $status = Auth::user()->proof_of_payment;
                        @endphp
                        <hr style="border:1px solid #f4f4f4;margin:5px !important;">
                        <div class="row">
                            <form action="{{ route('user.proof_update',[Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('PATCH') }}
                                @if (Auth::user()->proof_of_payment == null || Auth::user()->proof_of_payment == "")
                                    <div class="form-group col-md-6">
                                        <label for="">select the proof of payment file</label>
                                        <input type="file" name="proof_of_payment" class="form-control">
                                        <div>
                                            @if ($errors->has('proof_of_payment'))
                                                <small class="form-text text-danger">{{ $errors->first('proof_of_payment') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-credit-card"></i> Submit Proof Of Payment
                                        </button>
                                    </div>
                                @else
                                    <div class="form-group col-md-6">
                                        <label for="">select the proof of payment file</label>
                                        <input type="file" name="proof_of_payment" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" disabled><i class="fa fa-credit-card"></i> Submit Proof Of Payment
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
                responsive : true,
            });
        } );
    </script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script>

    am4core.ready(function() {
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();
    // Add data
    @yield('chart_data')
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;
    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;
    series.tooltip.pointerOrientation = "vertical";
    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;
    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;
    series.columns.template.adapter.add("fill", function(fill, target) {
    return chart.colors.getIndex(target.dataItem.index);
    });
    // Cursor
    chart.cursor = new am4charts.XYCursor();
    }); // end am4core.ready()
    </script>
@endpush
