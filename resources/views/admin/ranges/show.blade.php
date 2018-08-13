@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
    {{--<link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">  --}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
@endsection

@section('main-content')
    <div class="content-wrapper" style="background: #fff">
      <section class="content" style=" background: #fff">
          <div class="row">
            <fieldset>
              <legend style="text-align: center;font-weight: 900;padding: 10px;">AGREGAR RANGOS A ENCUESTA   <small></small></legend>
              @include('includes.messages')  
                {{ csrf_field() }}                  
                  <div class="col-md-12">
                    <div id="myDiv">
                      @if (!empty($poll->ranges))
                            <div class="box-body">
                              <div>
                                <label style="text-transform: uppercase;">Encuesta:</label>
                                <label style="text-transform: uppercase;">{{ $poll->name }}</label>
                              </div> 
                              <div class="panel panel-primary filterable" style="    border-color: #e5e5e5;">
                                <div class="panel-heading" style="background-color: rgba(96, 92, 168, 0.58);     border-color: rgba(96, 92, 168, 0.58);">
                                    <div class="panel-title">Rangos
                                      <button id="addRange" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRangeModal" style="float: right;">
                                          <i class="fa fa-plus" aria-hidden="true" class="pull-right" ></i>
                                          Agregar rango
                                        </button>
                                    </div>
                                    <div class="pull-right" style="width: 30%">
                                        
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                  <thead>
                                   <tr >                 
                                     <th class="question" >Desde</th>
                                     <th>Hasta </th>
                                     <th>Observacion</th>    
                                   </tr>                
                                  </thead>
                                  @foreach($poll->ranges as $item)
                                  <tbody>
                                    <input type="hidden" id="range_id" value="{{ $item->id }}">

                                    <td class="range" name="@php
                                      echo "from".$item->id ;
                                    @endphp"  id="{{ $item->id }}" data-toggle="modal" data-target="#addRangeModal" value="{{ $item->from }}">{{ $item->from }} </td>
                                    <td class="range" name="@php
                                      echo "to".$item->id ;
                                    @endphp  id="{{ $item->id }}" data-toggle="modal" data-target="#addRangeModal">{{ $item->to }} </td>
                                    <td class="range" name="@php
                                      echo "text".$item->id ;
                                    @endphp  id="{{ $item->id }}" data-toggle="modal" data-target="#addRangeModal">{{ $item->text }} </td>
                                  </tbody>                    
                                  @endforeach
                                </table>
                              </div>
                              
                            </div>
                      @endif
                    </div>
                  </div>
            </fieldset>
          </div>
          <br><br><br>
      </section>
    </div>
    <div class="modal fade" id="addRangeModal" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
        <div class="modal-dialog" style="">
            <div class="panel panel-primary" style="border-color: #605ca8 !important">
                <div class="panel-heading" style="background: #605ca8; border: 1px solid #605ca8">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> Añadir Rango.</h4>
                </div>
                <form action="#" method="post" accept-charset="utf-8">
                <div class="modal-body" style="padding: 5px;">
                      <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input type="number" min="1" id="from" name="from" placeholder="Desde" class="form-control">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input type="number" min="1" id="to" name="to" placeholder="Hasta" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                              <textarea id="text" name="text" class="form-control" rows="5" placeholder="Observacion"></textarea>
                              <input type="hidden" id="id">
                            </div>
                        </div>
                        
                    </div>  
                    <div class="panel-footer" style="margin-bottom:-14px;">
                        {{-- <button type="button" class="btn btn-default" style="background: #605ca8 !important;" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span></button> --}}
                         <button type="button" id="delete" style="display: none" class="btn btn-default" data-dismiss="modal"><span class="">Eliminar</span></button>
                         <button type="button" id="saveChanges" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="">Guardar</span></button>
                         <button type="button" id="add" style="display: none" class="btn btn-primary" data-dismiss="modal"><span class="">Guardar</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>  

$(function () {
  /*$("#example1").DataTable();*/
  $("#example1").DataTable( {
    "pageLength": 100
  });
  console.log("pagina para editar los rangos");
  
  var url = '{{ route('ranges.store') }}';
  var url_delete = '{{ route('ranges.destroy', $poll->id) }}';
  var url_update = '{{ route('ranges.update', $poll->id) }}';
  var poll_id = {{ $poll->id }}
  
 /* $('.range').click(function(){
    console.log("se clickeo un rango");
  });*/


  //Modal Añadir pregunta
  $(document).on('click', '#addRange', function(event) {
    console.log('modal añadir');
    $('#from').val('');
    $('#to').val('');
    $('#text').val('');
    $('#add').show('400'); 
    $('#title').text('Añadir Rango');
    $('#delete').hide('400');
    $('#saveChanges').hide('400');
  
  });

  //Crear
  $('#add').click(function(event){
    var from = $('#from').val();
    var to = $('#to').val();
    var text = $('#text').val();

    console.log("desde: " + from);
    console.log("hasta: " + to);
    console.log("text: " + text);

    console.log("id  de la poll: " + poll_id);
    $.post(url, 
      {
        'from' : from, 
        'to' : to, 
        'text' : text, 
        'poll_id' : poll_id,         
        '_token' : $('input[name=_token]').val() }, function(data) {      
        $('#from').val('');
        $('#to').val('');
        $('#text').val('');        
        $('#myDiv').load(location.href + ' #myDiv' );
    });
  }); 

  //Editar rango
  $(document).on('click', '.range', function(event) {
    //Modal editar una pregunta
      console.log('editar rango');
      var id = $(this).find('#range_id').val();
      var range_id = $(this).attr('id');
      var from = $("input[name='from"+range_id+"']").val(); 
     
      console.log( "datos: " + from + to +text);
      
      $('#title').text('Editar Rango');
      $('#delete').show('400');
      $('#saveChanges').show('400');
      $('#add').hide('400'); 
      $('#id').val(); 
      console.log("id de rango: "  + range_id + id);
  }); 
    

});
</script>
<script src="{{ asset('admin/custom/question/answer.js') }}"></script>

@endsection
