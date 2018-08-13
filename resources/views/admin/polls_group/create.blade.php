@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="background: #fff">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Crear Encuesta
	    </h1>
	    
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
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('polls.store') }}" method="post">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-4">

	              <div class="form-group">
	                <label for="categoria">Categoria</label><br>
	                <select name="category_id" id="" class="form-control">
	                  @foreach ($categories as $item)
	                    <option value="{{$item->id}}">{{$item->name}}</option>
	                  @endforeach
	                </select>	                
	              </div>
	              
	              <div class="form-group">
	                <label for="name">Título de la encuesta</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la encuesta">
	              </div>
	              
	              {{-- <div class="form-group">
	                <label for="slug">Mostrar todas las preguntas?</label>
	                <br>
	                <input type="radio" name="show_all_questions" value="1" checked="checked" > Si<br>
	                <input type="radio" name="show_all_questions" value="0"> No<br>
	              </div> --}}


	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Guardar</button>
	              <a href='{{ route('polls.index') }}' class="btn btn-warning">Regresar</a>
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

@push('js')
<script type="text/javascript">
	$(function(){

	});
</script>
@endpush