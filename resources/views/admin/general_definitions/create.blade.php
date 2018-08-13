@extends('admin.layouts.app')

@section('main-content')
	<div class="content-wrapper" style="background: #fff;">
	  	
		<section class="content" style="float: left; margin-top: 47px; background: #fff">
		    <div class="row">
		    	<fieldset>
		    		<legend style="text-align: center;font-weight: 900;padding: 10px;">Definiciones Generales <small></small></legend>
		    		@include('includes.messages')  
			       
			        <form role="form" action="{{ route('general_definitions.store') }}" method="post">
			          	{{ csrf_field() }}
			           		
			            	<div class="col-md-12">
			            		<div class="form-group">
			                    	<label for="name">Nombre del Mensaje</label>
				                	<input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Mensaje">
				              	</div>
			            	</div>
			              	
			              	<div class="col-md-12">
			              		<div class="form-group">
			              			<label for="name">Descripción:</label>
				                   	<input type="text" class="form-control" id="description" name="description" placeholder="Descripcion del Mensaje">
					          	</div>
			              	</div>

			              	<div class="col-md-12">
			               		<div style="margin-left: auto; margin-right: auto;     text-align: center;">
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

	
	
	<script>
	    $(function() {
	    	$('#hour').hide();
	    	$('#minutes').hide();
	    	$('#seconds').hide();

			console.log( "testing categories 1.0" );   
			$('#type').on('change',function () {
		        var var_type = $('#type').val();
		        console.log(var_type);  
		        if (var_type == 2 || var_type == 3) {
		        	$('.tiempo').css('display', "block");
		            $('#hour').show();
		            $('#minutes').show();
		            $('#seconds').show();
			    	$('#pausable').hide();
			    	$('.pausable').val(0);
				}

		        if (var_type == 1) {
		        	$('.tiempo').css('display', "none");
		            $('#hour').hide();
					$('#minutes').hide();
					$('#seconds').hide();
		    		$('#pausable').show();
		    		$('.hour').val(0);
		    		$('.minutes').val(0);
		    		$('.seconds').val(0);
				}       
	          
	        });  

		});
	</script>
@endsection