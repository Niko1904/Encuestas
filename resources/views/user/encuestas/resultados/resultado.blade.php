@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <!-- Service section -->
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="sec-title text-center"><br>
                    <h2 class="wow animated bounceInLeft" style="color: #999999;">{{ $encuesta->name }}</h2>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default" style="border: none;">
                        <div class="panel-body">
                            <div class="col-md-12">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h2 class="text-center" style="color: #999999;">Resultado de tu encuesta</h2>
                                <br>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <h3> <b> Puntaje </b> <br> {{ $total }} </h3>
                                <br>
                                <h3> <b> Calificación </b> <br>
                                    {{ $resume->text }} ad
                                </h3>
                            </div>
                            {{--  <div class="col-md-8">
                                <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                            </div>  --}}
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>    
  
@endsection


@push('js')


<script type="text/javascript">
    var $rangos = eval(<?php echo $rangos; ?>);
    $(function(){
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Puntaje por Rango'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} </b> of total<br/>'
            },

            series: [{
                name: 'Rango',
                colorByPoint: true,
                data: $rangos
            }]
        });

    });
</script>
@endpush