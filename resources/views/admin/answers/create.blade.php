@extends('admin.layouts.app')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small> Crear repuesta para la pregunta: </small><h2>{{$question->name}}</h2>
      </h1>
      {{-- <ol class="breadcrumb">
        <li>
          <form action="{{ route('questions.index') }}" method="get" style="display:inline">
              {{ csrf_field() }}
              <input type="hidden" name="poll_id" value="{{$poll->id}}">
              <i class="fa fa-dashboard"><input type="submit" value="Atras" class="btn btn-success btn-xs" ></i>
          </form>
        </li>
      </ol> --}}
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
            </div>
        @include('includes.messages')  
            <form role="form" action="{{ route('answers.store') }}" method="post">
            {{ csrf_field() }}
              <input type="hidden" name="poll_id" value="{{$poll->id}}">
              <input type="hidden" name="question_id" value="{{$question->id}}">
              <div class="box-body">
              <div class="col-lg-offset-3 col-lg-4">
                <div class="form-group">
                    <label for="name">Respuesta</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Respuesta">
                </div>

                <div class="form-group">
                    <label for="name">Valoracion</label>
                  <input type="number" class="form-control" id="value" name="value" placeholder="Valoracion" min="0" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <form action="{{ route('questions.index') }}" method="get" style="display:inline">
                      {{ csrf_field() }}
                      <input type="hidden" name="poll_id" value="{{$poll->id}}">
                      {{-- <i class="fa fa-dashboard"><input type="submit" value="Atras" class="btn btn-success" ></i> --}}
                      <a href="{{ url()->previous() }}" class="btn btn-danger">Regresar</a>
                  </form>
                </div>

              </div>
        </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('footerSection')
  
  
  <script>
      $(function() {
        $('#hour').hide();
        $('#minutes').hide();
        $('#seconds').hide();

      console.log( "crear respuestas 1.0" );   
      $('#type').on('change',function () {
          var var_type = $('#type').val();
          console.log(var_type);  
          if (var_type == 2 || var_type == 3) {
            $('#hour').show();
            $('#minutes').show();
            $('#seconds').show();
          }

          if (var_type == 1) {
             $('#hour').hide();
             $('#minutes').hide();
             $('#seconds').hide();
          }       
        
      });  

    });
  </script>
@endsection