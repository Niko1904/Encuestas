@extends('admin.layouts.app')

@section('main-content')
	<div class="content-wrapper" style="background: #fff;">
	  	
		<section class="content" style="float: left; margin-top: 47px; background: #fff">
		    <div class="row">
		    	<fieldset>
		    		<legend style="text-align: center;font-weight: 900;padding: 10px;">CATEGORIAS DE ENCUESTAS <small></small></legend>
		    		@include('includes.messages')  
			        <form role="form" action="{{ route('categories.store') }}" method="post">
			          	{{ csrf_field() }}
			           		
			            	<div class="col-md-6">
			            		<div class="form-group">
			                    	<label for="name">Nombre de la categoria</label>
				                	<input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la categoria">
				              	</div>
			            	</div>
			              	<div class="col-md-6">
			              		<div class="form-group">
			              			<label for="name">Tipo:</label>
				                   	<select name="timer_type" id="type" class="form-control" required>
					                 	<option value="1">Sin tiempo</option>
					                 	<option value="2">Tiempo por pregunta</option>
					                 	<option value="3">Tiempo por encuesta</option>
					              	</select>
					          	</div>
			              	</div>
			              	<div class="col-md-12 tiempo" style="display: none;">
							    <div class="panel panel-primary">
					                <div class="panel-heading">
					                    <h3 class="panel-title">
					                        <i class="icon-time"></i>  Configuración de tiempo</h3>
					                </div>
					                <div class="panel-body">
					                    <div class="row">
					                        <div class="col-md-4">
							              		<div class="form-group" id="hour">
									                <label for="name">Horas</label>
									                <input type="text" class="form-control" class="hour" name="hour" placeholder="Hora">
								                </div>	
							              	</div>
							              	<div class="col-md-4">
							              		<div class="form-group" id="minutes">
									                <label for="name">Minutos</label>
									                <input type="text" class="form-control" class="minutes" name="minutes" placeholder="Minutos">
								                </div>
							              	</div>	
						                  	<div class="col-md-4">
						                  		<div class="form-group" id="seconds">
									                <label for="name">Segundos</label>
									                <input type="text" class="form-control" class="seconds"  name="seconds" placeholder="Segundos">
								                </div>
							              	</div>
					                    </div>
					                    
					                </div>
					            </div>
							        
							</div>	
			              	<div class="col-md-4">
			               		<div class="form-group">
					                <label for="slug">Son obligatorias las respuestas?</label>
					                <br>
					                <input type="radio" name="answer_required" value="1" checked="checked" > Si 
					                <input type="radio" name="answer_required" value="0"> No<br>
					            </div>
			              	</div>	
			               	<div class="col-md-4">
			               		<div class="form-group" id="show_all_questions">
					                <label for="slug">Mostrar todas las preguntas?</label>
					                <br>
					                <input type="radio" name="show_all_questions" value="1" checked="checked" > Si 
					                <input type="radio" name="show_all_questions" value="0"> No<br>
					            </div>
			              	</div>
			              	<div class="col-md-4">
			               		<div class="form-group" id="pausable">
					                <label for="slug">Es pausable la encuesta?</label>
					                <br>
					                <input type="radio" name="pausable" class="pausable" value="1" checked="checked" > Si
					                <input type="radio" name="pausable" class="pausable" value="0"> No<br>
					            </div>
			              	</div>	
							   
							  <div class="col-md-4">
			               		<div class="form-group">
					                <label for="slug">Mostrar por porcentaje?</label>
					                <br>
					                <input type="radio" name="percentage_values" value="1"  > Si 
					                <input type="radio" name="percentage_values" value="0" checked="checked"> No<br>
					            </div>
			              	</div>
			              	<div class="col-md-4">
			               		<div class="form-group" id="answers_yes_or_not">
					                <label for="slug">Agregar solo 'si' y 'no' como respuestas?</label>
					                <br>
					                <input type="radio" name="answers_yes_or_not" class="pausable" value="1"  > Si
					                <input type="radio" name="answers_yes_or_not" class="pausable" value="0" checked="checked"> No<br>
					            </div>
			              	</div>	
			              	
							  <div class="col-md-4">
			               		<div class="form-group" id="group_type">
					                <label for="slug">Grupos de preguntas?</label>
					                <br>
					                <input type="radio" name="group_type" class="" value="1"  > Si
					                <input type="radio" name="group_type" class="" value="0" checked="checked"> No<br>
					            </div>
			              	</div>	

			               	<div class="col-md-12">
			               		<div style="margin-left: auto; margin-right: auto;     text-align: center;">
					                <button type="submit" class="btn btn-primary">Guardar</button>
					                <a href='{{ route('categories.index') }}' class="btn btn-warning">Regresar</a>
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
			
			$('#group_type').on('change',function () {
		        var group_type = $('input:radio[name=group_type]:checked').val();
		        console.log(group_type);  
		        if (group_type == 1 ) {
		        	console.log("desabilitar solo 1 preg" + group_type);  

					$('input:radio[name=show_all_questions]')[0].checked = true;
				}
		        if (group_type == 0) {
		        	console.log("no hacer nada" + group_type);  

					//$('input:radio[name=show_all_questions]:checked').prop('checked',false);
				}       
	        });  
			
			$('#show_all_questions').on('change',function () {
		        var show_all_questions = $('input:radio[name=show_all_questions]:checked').val();
		        if (show_all_questions == 1 ) {
					//$('input:radio[name=show_all_questions]')[0].checked = true;
				}
		        if (show_all_questions == 0) {
					$('input:radio[name=group_type]')[1].checked = true;
				}       
	          
	        });  

		});
	</script>
@endsection