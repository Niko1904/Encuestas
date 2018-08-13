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
    float: left;
    font-weight: bold !important;
    margin-bottom: 8px;
    padding: 6px;
    transition: 0.5ms;
    width: 100%;
  }

   .respuesta:hover{
      background-color:#337ab7;
      color:#FFF;
   }

   .input_respuesta{
      width: 20px;
      height: 20px;
      margin: 4px 0px 0 0 !important;
   }

   .labelRespuesta{
      font-weight: bold;
      margin-left: 10px;
   }

   .deshabilitada{
      opacity: 0.6 !important;
   }
</style>
<div class="container">
  <br><br><br><br>
    <div class="row">
    <p>{{-- categoria  {{ $encuesta->category }} --}}
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
                  <h2 class="wow animated text-center" style="color: #999999;"> {{ $encuesta->name }}</h2>
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
                                            <div class="respuesta">
                                              <input type="radio" 
                                              name="" e="respuestas{{$pregunta->id}}"
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
                                              />
                                                <label for="r_{{ $answer->id }}" class="labelRespuesta">
                                                  {{ $answer->name }}
                                                </label> 
                                            </div>
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
var hour, min, seg;
var $horas     = "1";
var $minutos   = "{{ $encuesta->category->minutes }}";
var $segundos  = "{{ $encuesta->category->seconds }}";
var poll_id    = "{{ $encuesta->id }}";
var $timer     = "{{ $timer }}";
var finEncuesta = false;
var avanzarFilaReloj = false;
var $filaActiva = 1;
var cantidadPreguntas = 0;
var temporizador;
var $reiniciaReloj = false;

$(function () { 
  console.log("**tiempo por pregunta");

  $("#mensaje").fadeOut(15000);
    console.log("mensaje");
    //alert("Bienvenido");      
  
   
   cantidadPreguntas = $(".panelPregunta", ".contenedorRows").length;

   $("input:submit").click(function() { return false; });

   $("input", ".radio").click(function(){
      $divRadio = $(this).parents('.radio');

      var fila = $(this).parents(".panelPregunta");
      var filaId = $(this).parents(".panelPregunta").attr("panelpregunta");
      var nroFila = $(this).parents(".panelPregunta").attr("id_fila");//Determina el numero de fila donde estoy ubicado

      $vacios = 0; 
      $(".panelPregunta", ".contenedorRows").each(function(){
         $filaAnterior = $(this).attr("id_fila");

         if($filaAnterior < fila.attr("id_fila") ){
            if($("input:disabled", ".panelPregunta[id_fila='" + $filaAnterior +"']").length == 0)
               if($("input[name='id_respuestas[]']", ".panelPregunta[id_fila='" + $filaAnterior +"']").length == 0)  
                  $vacios++;
         }
      });

      if ($vacios > 0) {
         alert("Tiene " + $vacios + " preguntas anteriores sin responder");
         return false;
      }

      if($divRadio.hasClass('deshabilitada'))
         return false;

      $idRespuesta = $(this).attr('id');

      $("input.oculto[r='" + $idRespuesta + "']", $divRadio).detach();

      if($(this).attr('type') == 'radio')
         $("input.oculto", $divRadio).detach();

      if($(this).prop('checked')){
         $('<input>').attr({
         type  : 'hidden',
         name  : 'id_respuestas[]',
         value : $idRespuesta,
         'r'   : $idRespuesta,
         class : 'oculto'
         }).appendTo($divRadio);
      }

      $(this).parents(".respuesta").addClass('respuesta_seleccionada');
      deshabilitarFilaActiva();
   });

   //Encuesta por tiempo
   if ($timer == 1){
      var n = 0;
      var nn = 0;
      hour = $horas;
      min = $minutos;
      seg = $segundos;

      if ( hour == null || hour == '') {hour=0; }
      if ( min == null || min == '') {min=0; }
      if ( seg == null || seg == '') {seg=0; }

      reloj_pregunta();
   }
});

function enviarDatos(){
   document.getElementById('evaluar').click();
}

function reloj_pregunta() {
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
   console.log("deshabilitarFilaActiva");
   $(".panelPregunta[id_fila='" + $filaActiva +"']").removeClass('panel-primary');
   $(".panelPregunta[id_fila='" + $filaActiva +"']").addClass('panel-warning deshabilitada');

   $(".input_respuesta", ".panelPregunta[id_fila='" + $filaActiva +"']").prop("disabled", "disabled");

   if ($filaActiva >= cantidadPreguntas)
       finEncuesta = true;

   if(finEncuesta)
       enviarDatos();

   $filaActiva++;

   hour  = $horas;
   min   = $minutos;
   seg   = $segundos;
   $reiniciaReloj = true;
}
</script>
@endsection


