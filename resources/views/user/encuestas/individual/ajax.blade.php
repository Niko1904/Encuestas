@extends('user.layouts.app2')
@section('content')
<div class="container">
  <style>
    .carousel {padding-bottom: 25px}
    .carousel img{padding-top: 20px;}
    .carousel h2 {color: #0072b5;}
    .carousel h2 small{color: #289bde}
    .carousel col-lg-4 p {text-align: center;}
  </style>
  <br><br><br><br>
    <div class="row">
        <input  type="hidden" id="seconds" value="{{ $encuesta->category->seconds }}" >
        <form action="{{ route('encuestas.individual') }}" method="post" id="formid"> 
            {{ csrf_field()  }} 
            <input type="hidden" name="poll_id" value="{{ $encuesta->id }}">

            <div class="col-md-12 col-xs-12">
                <div >
                    <h1 class="text-center" style="color: #999999;">{{ $encuesta->name }}</h1><br>
                    
                      <div class='container carousel' id="mycarrousel" data-interval="false">
                        <div id="carousel-example-generic" class="carousel slide" {{-- data-ride="carousel" --}}>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner text-center" role="listbox">
                              @foreach ($preguntas as $pregunta)

                                @if($loop->index == 0)
                                  <div class="item active">
                                @else  
                                  <div class="item">
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
                                          @if ($pregunta->multiple_answers == 1)
                                              <div style="float: left;padding: 6px;margin-bottom: 8px; width: 100%;     font-weight: bold !important;">
                                                <input type="checkbox" 
                                                name="respuestas" 
                                                value="{{ $answer->id }}" 
                                                class="chk" 
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
                                              class="rad" 
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
                              @endforeach 

                              <div id="controles_carousel">
                                @if($encuesta->category->pausable == 1)
                                    <a class="" href="#carousel-example-generic" role="button" data-slide="prev" id="anterior" style="display: none;">
                                    <button class="btn btn-warning" id="right.carousel-control"> Anterior </button>
                                  </a>
                                @endif

                                <a id="next" href="#carousel-example-generic"  role="button" data-slide="next" >
                                  <button class="btn btn-primary" id="right.carousel-control"> Siguiente </button>
                                </a>
                              </div>

                            </div>                           
                        </div>
                    </div> 
                <br>    
                <br>
                <div class="col-md-4 col-xs-4"">
                  <button id="terminar_encuesta" class="btn btn-danger block pull-right">Finalizar</button>
                  
                  @if($encuesta->category->pausable == 1)
                      <button id="pausar" class="btn btn-success block pull-right">Pausar</button>
                  @endif

                  <input type="text" id="arreglo" class="form-control" name="arreglo[]">
                </div>                     
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
  var $pausable = "{{ $encuesta->category->pausable }}";
  var $horas_categoria = "{{ $encuesta->category->hour }}";
  var $mins_categoria = "{{ $encuesta->category->minutes }}";
  var $segs_categoria = "{{ $encuesta->category->seconds }}";
  var poll_id = {{ $encuesta->id }};
  var $numero_preguntas = {{ $numero_preguntas }};
  var inicio = 0;
  var $preguntaActual = 1;
$(function () {
  $('.carousel').carousel({
    wrap: false,
    autoPlay : false
  });

  $('.carousel').on('slid.bs.carousel', function (e) {
      var carouselData = $(this).data('bs.carousel');
      var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
      $(this).children('.carousel-control').show();
  });

  $("#next").click(function(){
    $preguntaActual++;
    
    $("#anterior").fadeIn();

    if($preguntaActual == $numero_preguntas){
      $(this).fadeOut();
    }
  });

  $("#anterior").click(function(){
    $preguntaActual--;

    $("#next").fadeIn();

    if($preguntaActual <= 1){
      $(this).fadeOut();
    }
  });

  $("input:submit").click(function() { return false; });
  
  if ( {{ $timer }} == 1){
    var n = 0;
    var nn = 0;

    if ( $horas_categoria == null) {$horas_categoria=0; }
    if ( $mins_categoria == null) {$mins_categoria=0; }
    if ( $segs_categoria == null) {$segs_categoria=0; }
    
    reloj();
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
    document.getElementById('displayReloj').innerHTML = $mins_categoria + " : " + $segs_categoria;

  document.getElementById('displayReloj').innerHTML = $mins_categoria + " : " + $segs_categoria;
  var t = setTimeout(function(){reloj()},1000);
}
</script>
@endsection


