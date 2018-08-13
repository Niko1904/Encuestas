@extends('user.layouts.app2')
@section('content')
<div class="container">
  <style>
    .carousel {padding-bottom: 25px}
    .carousel img{padding-top: 20px;}
    .carousel h2 {color: #0072b5;}
    .carousel h2 small{color: #289bde}
    .carousel col-lg-4 p {text-align: center;}
    .owl-prev{display: none;}
    #deshabilitadas{display: none;}
  </style>
  <br><br><br><br>
    <div class="row">

       <div id="mensaje">
           <h1 style="text-align: center;font-weight:bolder;color:blue;"> 
              {{ $generaldefinitions->description }}
           </h1>
      </div>
      
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
      @endif
        
        <form action="{{ route('encuestas.individual') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 

            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">

            <div class="col-md-12 col-xs-12">
                <div >
                    <h1 class="text-center" style="color: #999999;">{{ $encuesta->name }}</h1><br>
                    <div style="text-align:center;">
                      <p>Tiempo para responder: {{ $encuesta->category->hour }}:{{ $encuesta->category->minutes }}:{{ $encuesta->category->seconds }}</p>
                      <div id="cabecera"></div>
                      <p>Tiempo restante:</p>
                      <div style="color:#337ab7; font-family: verdana, arial; font-size:30px; padding:15px;" id ="displayReloj" > &nbsp;
                      </div>
                      <h2 id='CuentaAtras'></h2>
                    </div>
                      <div id="owl-demo" class="owl-carousel owl-theme">
                        @foreach ($preguntas as $pregunta)
                            @if($loop->index == 0)
                              <div class="item active" nro_pregunta="{{ $loop->index }}">
                            @else  
                              <div class="item" nro_pregunta="{{ $loop->index }}">
                            @endif
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="glyphicon "></span>{{  $pregunta->name }}? <a href="http://www.jquery2dotnet.com" target="_blank"><span
                                        class="glyphicon "></span></a>
                                </h3>
                              </div>
                              <div class="panel-body">
                                <div class="radio">
                                  @if (!empty($pregunta->answers))
                                    @foreach($pregunta->answers as $answer)
                                      <div style="float: left;padding: 6px; margin-bottom: 8px; width: 100%;     font-weight: bold !important;">
                                          <input type="radio" name="respuestas{{$pregunta->id}}" value="{{ $answer->id }}" class="rad" id="{{ $answer->id }}" style="margin-left: 0px !important; "/>                                              
                                          <label style="font-weight: bold;"> {{ $answer->name }} </label> 
                                        </div>
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                      </div>
                <br>    
                <br>
                <div class="col-md-2 col-xs-4 pull-right">
                  <button id="terminar_encuesta" class="btn btn-danger block pull-right">Finalizar</button>
                  
                  @if($encuesta->category->pausable == 1)
                      <button id="pausar" class="btn btn-success block pull-right">Pausar</button>
                  @endif
                </div>                     
            </div>

            <div id="deshabilitadas"></div>
        </div>
        </form>
    </div>
    @php
      $timer = 0;
      if ($encuesta->category->hour > 0 || $encuesta->category->minutes > 0 || $encuesta->category->seconds > 0) 
        $timer = 1;
    @endphp
</div>

<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<script>  
  var $pausable = "{{ $encuesta->category->pausable }}";
  var $horas_categoria = $horasDefecto = "{{ $encuesta->category->hour }}";
  var $mins_categoria = $minsDefecto = "{{ $encuesta->category->minutes }}";
  var $segs_categoria = $segsDefecto = "{{ $encuesta->category->seconds }}";
  var poll_id = {{ $encuesta->id }};
  var $numero_preguntas = {{ $numero_preguntas }};
  var inicio = 0;
  var $preguntaActual = 1;
  var owl;

  $(function () {
  
    $("#mensaje").fadeOut(15000);
      console.log("tiempo pregunta individual");

      $("#owl-demo").owlCarousel({
        navigation  : false, // Show next and prev buttons
        slideSpeed  : 300,
        paginationSpeed : 400,
        singleItem  :true,
        autoPlay    : false,
        navigationText : ["anterior",'<a class="btn btn-primary" id="right.carousel-control"> Siguiente </a>']
      });

    owl = $(".owl-carousel").data('owlCarousel');

  /*
    Pendiente:
      - Hacer que se deshabilite el div.item de la pregunta que se ha respondido, venció el tiempo o le dió a "siguiente".
      - Cuando se haga click en pausar, se debe eliminar todo lo que tiene el detalle de la encuesta y volver a guardar.
  */
/*
  $(".owl-next").click(function(){
    if($preguntaActual == $numero_preguntas){
      $(this).fadeOut();
    }
  });
*/
    $("input.rad").click(function(){
        deshabilitarActiva();
    });

    $("input:submit").click(function() { return false; });
  
    if ( {{ $timer }} == 1){
        var n = 0;
        var nn = 0;
        if ( $horas_categoria == null) {$horas_categoria=0; }
        if ( $mins_categoria == null) {$mins_categoria=0; }
        if ( $segs_categoria == null) {$segs_categoria=0; }
        setTimeout(function(){reloj()},1000);
    }

    $("#terminar_encuesta").click(function(){
        var preguntas_input = $(":input");      

        var i = 0;
        preguntas_input.each(function(index , valor){
          if ($(this).prop( "checked")) {
              id = $(this).attr('id');
              nombre = 'id_respuestas['+i+']';

              $('<input>').attr({
                type: 'hidden',
                id: 'foo',
                name: nombre,
                value: id
              }).appendTo('form');
              i += 1;
          }
        });
    });
  });

  function reloj() {
    if ($segs_categoria > 0)
      $segs_categoria = $segs_categoria - 1;

    if (($mins_categoria > 0)  && ($segs_categoria == 0)){
      $mins_categoria = $mins_categoria - 1;
      $segs_categoria = 60;
    }
      
    if (($mins_categoria == 0) && ($segs_categoria == 0))
      deshabilitarActiva();

    document.getElementById('displayReloj').innerHTML = $mins_categoria + " : " + $segs_categoria;
    var t = setTimeout(function(){reloj()},1000);
  }

  function deshabilitarActiva(){
    if($preguntaActual == $numero_preguntas){
      $("#terminar_encuesta").trigger("click");
      return false;
    }

    $horas_categoria = $horasDefecto;
    $mins_categoria = $minsDefecto;
    $segs_categoria = $segsDefecto;

    owl.next(); //$(".owl-next").trigger("click");
    //  $(".item[nro_pregunta='" + ($preguntaActual - 1) + "']").appendTo("#deshabilitadas");
    $preguntaActual++;
  }
});
</script>
@endsection


