@extends('admin.layouts.app')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #fff">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small>Editar pregunta </small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <form action="{{ route('questions.index') }}" method="get" style="display:inline">
              {{ csrf_field() }}
              <input type="hidden" name="poll_id" value="{{$question->poll_id}}">
              <i class="fa fa-dashboard"><input type="submit" value="Atras" class="btn btn-success btn-xs" ></i>
          </form>
        </li>
      </ol>
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
            <form role="form" action="{{ route('questions.update', $question->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <input type="hidden" name="poll_id" value="{{$question->poll_id}}">
              <div class="box-body">
              <div class="col-lg-offset-3 col-lg-4">
                <div class="form-group">
                    <label for="name">Nombre de la pregunta</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="pregunta" value="{{$question->name}}">
                </div>

                <div class="form-group">
                  <label for="slug">Multiples respuestas?</label>
                  <br>
                  <input type="radio" name="multiple_answers" value="1" checked="checked" > Si<br>
                  <input type="radio" name="multiple_answers" value="0"> No<br>
                </div>
                  
                 

                  <div class="form-group" id="hour">
                  <label for="name">Horas</label>
                  <input type="text" class="form-control"  name="hour" placeholder="Hora">
                  </div>

                  <div class="form-group" id="minutes">
                  <label for="name">Minutos</label>
                  <input type="text" class="form-control"  name="minutes" placeholder="Minutos">
                  </div>

                  <div class="form-group" id="seconds">
                  <label for="name">Segundos</label>
                  <input type="text" class="form-control"  name="seconds" placeholder="Segundos">
                  </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                  <form action="{{ route('questions.index') }}" method="get" style="display:inline">
                      {{ csrf_field() }}
                      <input type="hidden" name="poll_id" value="{{$question->poll_id}}">
                      <i class="fa fa-dashboard"><input type="submit" value="Atras" class="btn btn-success" ></i>
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
         

    });
  </script>
@endsection