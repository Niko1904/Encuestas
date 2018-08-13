@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper" style="background: #fff;">
	  <!-- Content Header (Page header) -->
	  

	
	<section class="content" style="float: left; margin-top: 47px; background: #fff">
	    <div class="row">
	    	<fieldset>
	    		<legend style="text-align: center;font-weight: 900;padding: 10px;">Editar Definiciones <small></small></legend>
	    		<div class="box-header with-border">
					<p>
						@if(session()->has('message'))
							<div class="alert alert-danger">
									{{ session()->get('message') }}
							</div>
						@endif
					</p>
	          	</div>
	    		@include('includes.messages')  
		        <form role="form" action="{{ route('general_definitions.update', $generaldefinitions->id) }}" method="post">
		          	{{ csrf_field() }}
		           	{{ method_field('PUT') }}
					<input type="hidden" name="id" value="{{ $generaldefinitions->id }}">	
	            	<div class="col-md-12">
	            		<div class="form-group">
	                    	<label for="name">Nombre del Mensaje</label>
		                	<input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Mensaje" value="{{$generaldefinitions->name}}" required>
		              	</div>
	            	</div>
	              	<div class="col-md-12">
	              		<div class="form-group">
	              			<label for="Descripción">Descripción:</label>
		                   	<input type="text" class="form-control" id="name" name="description" placeholder="Descripción del Mensaje" value="{{$generaldefinitions->description}}" required>
			          	</div>
	              	</div>
	              	  	
		            <div class="col-md-12">
		            	<div style="margin-left: auto; margin-right: auto;text-align: center;">
				            <button type="submit" class="btn btn-primary">Guardar</button>
				            <a href='{{ route('general_definitions.index') }}' class="btn btn-warning">Regresar</a>
				        </div>
		            </div>	
		        </form>
	    	</fieldset>
	    </div>
	    <br><br><br>
	</section>
	  
	</div>
	
@endsection
@section('footerSection')
	<style type="text/css">
		.panel-primary>.panel-heading {
		    color: #fff;
		    background-color: rgba(96, 92, 168, 0.62) !important;
		    border-color: #ecf0f5 !important;
		}
		.panel{
			border: 1px solid #ecf0f5 !important;
		}
	</style>
@endsection