@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
{{--  <link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">  --}}
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: #fff">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Encuesta : {{ $poll->name }}
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            {{-- <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalQuestion">
                Añadir Preguntas
            </button> --}}
            <div class="form-group row add">
                <div class="col-md-8">                	
                  {{-- <h1>Preguntas</h1> --}}
                  <form action="{{ route('questions.create') }}" method="get" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="poll_id" value="{{$poll->id}}">
                    <input type="submit" value="agregar pregunta" class="btn btn-success btn-xs" ><i class="fa fa-plus" aria-hidden="true" class="pull-right"></i>
                  </form>
                </div>                
            </div>
          </div>          

          <div id="myDiv">
      		@if (!empty($questions))
     		  @foreach($questions as $item)
           <div class="box-body">
            <table class="table table-striped table-hover table-bordered dataTable">
             <tr >
               <th style="width: 10px">{{ $loop->iteration }}</th>
               <th class="question" id="{{ $item->id }}" data-toggle="modal" data-target="#questionModal"><a href="{{ route('questions.edit', $item->id) }}">{{ $item->name }}</a>
               <form action="{{ route('questions.destroy',  $item->id) }}" method="post" style="display:inline">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  
                  <input type="submit" value="Eliminar" class="btn btn-danger btn-xs" onclick="return confirm('Esta seguro de eliminar?');">
                </form>
                <input type="hidden" id="question_id" value="{{ $item->id }}">
               </th>
                   
               <th style="width: 20px">
                  <form action="{{ route('answers.create') }}" method="get" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="poll_id" value="{{$poll->id}}">
                    <input type="hidden" name="question_id" value="{{$item->id}}">
                    <input type="submit" value="agregar respuesta" class="btn btn-success btn-xs" ><i class="fa fa-plus" aria-hidden="true" class="pull-right"></i>
                  </form>
               </th>
               <th style="width: 20px">Valoracion</th>
               {{--  <th style="width: 10px">Acciones</th>  --}}
             </tr>
             @if (!empty($item->answers))
     			    @foreach($item->answers as $answer)
		             <tr>
		               <td>-</td>
		               <td class="answer" id="{{ $answer->id }}" data-toggle="modal" data-target="#answerModal">{{ $answer->name }}</td>                   
		               <td></td>		               
                   <td><span class="badge bg-light-blue">{{ $answer->value }}</span></td>		              
		             </tr>
		          @endforeach
		        @endif      
            </table>
            </div>
           <!-- /.box-body -->           

     		@endforeach
	      @endif
        </div>

        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box --> 
  </section>
  <!-- /.content -->
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
  console.log("pagina para editar las preguntas y respuestas");
  

});
</script>
<script src="{{ asset('admin/custom/question/answer.js') }}"></script>

@endsection
