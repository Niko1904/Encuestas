@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: #fff">
  <input type="hidden" name="myurl" id="myurl" value="{{ route('admin.estadisticas') }}">
  @if (!$estadisticas == null)
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <br>
    <div id="container-2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  @endif
</div>

@endsection

@section('footerSection')

  <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>

  
  <script src="{{ asset('admin/custom/home/graficos.js') }}"></script>
  
  <script>
   
    $(function () {
      /*$("#example1").DataTable();*/
      $("#example1").DataTable( {
        "pageLength": 100
      });
    });

  </script>
@endsection
                                    
          

