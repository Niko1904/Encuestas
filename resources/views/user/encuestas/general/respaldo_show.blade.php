@extends('user.layouts.app2')
@section('content')
<style type="text/css">
  .panelPregunta.sintiempo .respuesta{
    border: none !important;
    transition: 0.5ms;
  }

  .panelPregunta.sintiempo .input_respuesta{
    display: none;
    transition: 0.5ms;
  }

  .respuesta{
    border: 1px solid #bad3e8;
    border-radius: 10px;
    float: left;
    font-weight: bold !important;
    margin-bottom: 8px;
    padding: 6px;
    transition: 0.5ms;
    width: 100%;
  }
</style>
<div class="container">
  <br><br><br><br>
    <div class="row">
    <p>{{-- categoria  {{ $encuesta->category }} --}}
      <div id="mensaje">
           <h1 style="text-align: center;font-weight:bolder;color:blue;"> 
              <h1 style="text-align: center;font-weight:bolder;color:blue;"> 
                  {{ $generaldefinitions->description }}
              </h1>
           </h1>
      </div>
      
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
      @endif
    </p>
        <input  type="hidden" id="seconds" value="{{ $encuesta->category->seconds }}" >
        <form action="{{ route('encuestas.store') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}}
            </div>
          <div class="col-md-12">
            <div class=""><br>               
                <div class="sec-title text-center">
                  <h2 class="wow animated text-center" style="color: #999999;">*{{ $encuesta->category }} - {{ $encuesta->name }}</h2>
                </div>
                @if ($encuesta->category->timer_type >1)                
                  <div style="text-align:center;">
                    <p>Tiempo para responder: {{ $encuesta->category->hour }}:{{ $encuesta->category->minutes }}:{{ $encuesta->category->seconds }}</p>
                    <div id="cabecera"></div>
                    <p>Tiempo restante:</p>
                    <div style="color:#337ab7; font-family: verdana, arial; font-size:30px; padding:15px;" id ="displayReloj" > &nbsp;
                    </div>
                    <h2 id='CuentaAtras'></h2>
                  </div>
                @endif
                <div class="contenedorRows">
                  @if (!$preguntas == null)
                    <?php $contador = 0; ?>
                    @foreach ($preguntas as $pregunta)
                      <?php $contador++; ?>
                      <div class="row">
                          <div class="col-md-12 col-xs-12">
                              <div class="panel panel-primary panelPregunta" panelPregunta='{{ $pregunta->id }}' id_fila="{{$contador}}">
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
                                          @if ($pregunta->multiple_answers == 1)
                                              <div class="respuesta">
                                                <input type="checkbox" 
                                                name="respuestas" 
                                                value="{{ $answer->id }}" 
                                                class="chk input_respuesta" 
                                                id="{{ $answer->id }}"
                                                @if (!$contestadas == null)
                                                  @foreach ($contestadas as $item)
                                                    @if ($item->answer_id == $answer->id)
                                                      checked
                                                    @endif
                                                  @endforeach
                                                @endif
                                                > 
                                                {{ $answer->name }}
                                              </div>
                                          @else
                                            <div style="float: left;padding: 6px; margin-bottom: 8px;width: 100%;     font-weight: bold !important;">
                                              <input type="radio" 
                                              name="respuestas{{$pregunta->id}}" 
                                              value="{{ $answer->id }}" 
                                              class="rad input_respuesta" 
                                              id="{{ $answer->id }}" 
                                              @if (!$contestadas == null)
                                                @foreach ($contestadas as $item)
                                                  @if ($item->answer_id == $answer->id)
                                                    checked
                                                  @endif
                                                @endforeach
                                              @endif
                                              style="margin-left: 0px !important; "
                                              >
                                                <label style="font-weight: bold;">
                                                  {{ $answer->name }}
                                                </label> 
                                            </div>
                                          @endif  
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                <!-- <input type="submit"   value="Registrar encuesta" > --> 
                <button id="evaluar" class="btn btn-danger pull-right">Finalizar</button>
                @if($encuesta->category->pausable == 0)
                    <input type="hidden" name="pausable" value="0">                    
                @else
                    <button id="pausar" class="btn btn-success pull-right">Pausar</button>
                    <input type="hidden" name="pausable" value="1">                    
                @endif
                <input type="text" id="arreglo" class="form-control" placeholder="" name="arreglo[]">
            </div>
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
  console.log("prueba");
  console.log("/general/show");

  var hour, min, seg;

  var $horas    = "{{ $encuesta->category->hour }}";
  var $horas_categoria = "{{ $encuesta->category->hour }}";
  var $mins_categoria = "{{ $encuesta->category->minutes }}";
  var $segs_categoria = "{{ $encuesta->category->seconds }}";
  var $minutos  = "{{ $encuesta->category->minutes }}";
  var $segundos = "{{ $encuesta->category->seconds }}";
  var poll_id = "{{ $encuesta->id }}";
  var $timer = "{{ $timer }}";
  var finEncuesta = false;
  var avanzarFilaReloj = false;
  var $filaActiva = 1;
  var cantidadPreguntas = 0;
  var temporizador;

  $(function () {  
    console.log("/general/show");

    cantidadPreguntas = $(".panelPregunta", ".contenedorRows").length;

    $("input:submit").click(function() { return false; });
    
    

      /*if($(".panelPregunta").length == nroFila){
        alert("esta es la ultima pregunta");
      }*/
      if ( {{ $timer }} == 1){
        var n = 0;
        var nn = 0;

        if ( $horas_categoria == null) {$horas_categoria=0; }
        if ( $mins_categoria == null) {$mins_categoria=0; }
        if ( $segs_categoria == null) {$segs_categoria=0; }
        
        reloj();
      }

  });

   
    
    // Coloca texto de Bienvenida a la encuesta
    console.log("inicio");
    
    /*$("#mensaje").fadeOut(15000);
      console.log("mensaje");
      alert("Bienvenido"); */     
    

  function enviarDatos(){
    document.getElementById('evaluar').click();
  }

  function reloj() {
    console.log("funcion reloj");
    console.log("h: " + hour +" ,m: " +min);
    if (seg > 0)
    seg = seg - 1;

    if ((min > 0)  && (seg == 0)){
      min = min - 1;
      seg = 60;
    }

    if ((hour > 0) && (min == 0)){
      hour = hour - 1;
      min = 60;
    }

    document.getElementById('displayReloj').innerHTML = hour + " : " + min + " : " + seg;

    if ((hour == 0) && (min == 0) && (seg == 0))
      enviarDatos();

    var t = setTimeout(function(){ reloj() }, 1000 );
  }

  function reloj_pregunta() {
       console.log("filaactiva" +  $filaActiva);

       if (min > 0  && seg <= 1){
            min = min - 1;
            seg = 59;
       }

       document.getElementById('displayReloj').innerHTML = min + " : " + seg;

       if (min == 0 && seg == 0)
            deshabilitarFilaActiva();

       var temporizador = setTimeout(function(){
            reloj_pregunta();
            seg--;
       }, 1000);
  }

  function deshabilitarFilaActiva(){
       $(".panelPregunta[id_fila='" + $filaActiva +"']").removeClass('panel-primary');
       $(".panelPregunta[id_fila='" + $filaActiva +"']").addClass('panel-warning');

       $(".input_respuesta", ".panelPregunta[id_fila='" + $filaActiva +"']").prop("disabled", "disabled");

       if ($filaActiva >= cantidadPreguntas) 
            finEncuesta = true;

       if(finEncuesta)
            enviarDatos();

       hour = $horas;
       min = $minutos;
       seg = $segundos;

       $filaActiva++;
  }
</script>

@endsection


