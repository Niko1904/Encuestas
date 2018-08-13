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
            <div class="myform">
                {{-- <input type="hidden" name="respuesta_id[]" value="">     --}} 
                <input type="hidden" id="numero_preguntas" value="{{ $numero_preguntas }}">           
            </div>
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
                                              <div style="float: left;padding: 6px;margin-bottom: 8px;border: 1px solid #bad3e8;border-radius: 10px; width: 100%;     font-weight: bold !important;">
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
                                            <div style="float: left;padding: 6px; margin-bottom: 8px; border: 1px solid #bad3e8; border-radius: 10px;width: 100%;     font-weight: bold !important;">
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
                                  <div>
                                    <a class="" href="#carousel-example-generic"  role="button" data-slide="next" id="next">
                                      <button class="btn btn-primary" id="right.carousel-control">siguiente pregunta</button>
                                    </a>
                                  </div>
                                </div>
                              @endforeach                                
                            </div>                           
                        </div>
                    </div> 
                <br>    
                <br>
                <div class="col-md-4 col-xs-4"">
                  <button id="terminar_encuesta" class="btn btn-danger block">Terminar encuesta</button>
                  
                  @if($encuesta->category->pausable == 1)
                      <button id="pausar" class="btn btn-success block">pausar encuesta</button>
                  @endif

                  <input type="text" id="arreglo" class="form-control" name="arreglo[]">
                </div>                     
            </div>
        </div>
        </form>
    </div>
    @php
      if ($encuesta->category->hour > 0 || $encuesta->category->minutes > 0 || $encuesta->category->seconds > 0) 
      {
        $timer = 1;
      } else {
        $timer = 0;
      }      
    @endphp
</div>
<div>
  <input type="hidden" id="hour" name="hour" value="{{ $encuesta->category->hour }}">
  <input type="hidden" id="min" name="min" value="{{ $encuesta->category->minutes }}">
  <input type="hidden" id="seg" name="seg" value="{{ $encuesta->category->seconds }}">
</div><script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script>  
  var $pausable = "{{ $encuesta->category->pausable }}";
  var $horas_categoria = "{{ $encuesta->category->hour }}"
  var $mins_categoria = "{{ $encuesta->category->minutes }}"
  var $segs_categoria = "{{ $encuesta->category->seconds }}"
$(function () {
  var inicio = 0;

  if (inicio == 1) {
      //alert("Has finalizado la encuesta, has click en el boton finalizar");
  }

  function asd(){
    console.log("ultima funcion" );
      $('#next').hide();
      inicio = 1;
  }

  $('.carousel').carousel({
    interval: 100000, 
    pause: true, 
    wrap: false
  });

  function desabilitar(){
    console.log("ultimo elemento  y funcion desabilitar" );
      $('#next').hide();
      asd();
  };


  // execute function after sliding:
  $('.carousel').on('slid.bs.carousel', function (e) {
      var carouselData = $(this).data('bs.carousel');
      // get current index of active element
      var currentIndex = carouselData.getItemIndex(carouselData.$element.find('.item.active'));
      // hide carousel controls at begin and end of slides
      $(this).children('.carousel-control').show();
      
      if(currentIndex == 0){
          $(this).children('.left.carousel-control').fadeOut();
          e.preventDefault();
          console.log("primera slide");
          alert("has finalizado la encuesta, has clcick en finalizar para guardar los resultados");
          $('.carousel').carousel('pause');
          return false; // stay on this slide
          //alert('primero');
      }else if(currentIndex+1  == carouselData.$items.length){
          //alert('ultimo');
      }
      console.log('elemento actual: '+currentIndex);
      console.log('numero de preguntas'+$('#numero_preguntas').val());
      //currentIndex+=1;
      if (currentIndex == $('#numero_preguntas').val() -1 ) 
      {
          desabilitar();
      }
      if (currentIndex == 0 && inicio == 1 ) 
      {
        //alert("Has finalizado la encuesta, has click en el boton finalizar");
      }
  });

  console.log("regitrar encuestas con $ each 2"); 
  console.log("hay tiempo " + {{ $timer }} ); 
  $("input:submit").click(function() { return false; });
  
  var poll_id = {{ $encuesta->id }};
  //var respuestas = [];
  
  $('.question').click(function(){
    console.log("se clickeo un elemento de pregunta");
  });

  //Encuesta por tiempo
  if ( {{ $timer }} == 1) 
  {
    var n = 0;
    var nn = 0;

    if ( $horas_categoria == null) {$horas_categoria=0; }
    if ( $mins_categoria == null) {$mins_categoria=0; }
    if ( $segs_categoria == null) {$segs_categoria=0; }
    
    console.log("Encuesta por tiempo "); 
    console.log("minutos: " + min + " " + "segundos: " + seg);

    function reloj() {
      if ($segs_categoria > 0) {
           $segs_categoria = $segs_categoria - 1;
        }
      if (($mins_categoria > 0)  && ($segs_categoria == 0)){
            $mins_categoria = $mins_categoria - 1;
            $segs_categoria = 60;
        }
        if (($mins_categoria == 0) && ($segs_categoria == 0)){
          document.getElementById('displayReloj').innerHTML = $mins_categoria + " : " + $segs_categoria;
          alert("Fin : " + nn);
        exit();
        }
        document.getElementById('displayReloj').innerHTML = $mins_categoria + " : " + $segs_categoria;
        var t = setTimeout(function(){reloj()},1000);
    }
    reloj();
  }

  //Encuesta sin tiempo
  if ( {{ $timer }} == 0) 
  {
    console.log("Encuesta sin tiempo "); 
  }

  $("#terminar_encuesta").click(function(){
      var preguntas_input = $(":input");      
      //var preguntas_input = $("[name=respuestas]");
      var i = 0;
      preguntas_input.each(function(index , valor){
          //alert("id: " + $(this).attr('id') + " , esrtado: " + $(this).tagName + " valor: " + valor + ": " + $( this ).text() );
        if ( $(this).prop( "checked" ) ) {
         // alert("esta checked, " + $(this).attr('id') );
          //arreglo[index] = $(this).attr('id');
          //$('[name=arreglo]').val(this.value);
          id = $(this).attr('id');
          nombre = 'id_respuestas['+i+']';
          //alert("nombre: " + nombre);
          //alert("id: " + id);
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

//fin del evento de jquery
});
</script>
@endsection


