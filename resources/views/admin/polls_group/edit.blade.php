@extends('admin.layouts.app')

@section('main-content')
   <div class="content-wrapper" style="background: #fff">
	  <section class="content" style="background: #fff;">
		 <div class="row">
	        <fieldset>
	           <legend style="text-align: center;font-weight: 900;padding: 10px;">-ENCUESTAS </legend>
	           <div class="col-md-12">@include('includes.messages')</div>
	           <div class="col-md-12">
	              <form role="form" action="{{ route('polls.update', $poll->id) }}" method="post">
	                 {{ csrf_field() }}
	                 {{ method_field('PUT') }}
	              </form>
	            </div>
	        </fieldset>
	     </div>
	        
		<div class="row">
		   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		      <div class="box box-primary" style="border-top-color: #605ca8;">
	     		 <fieldset>
		    		<legend style="text-align: center;font-weight: 900;padding: 10px;"> PREGUNTAS DE LA ENCUESTA</legend>
		    	  	  <div class="clearfix"></div>
				      <div id="col-lg-12 col-md-12 col-sm-12 col-xs-12 contenedorPreguntas">
					     @if (!empty($questions))
							<form action ="{{route('polls-group.store')}}" method="POST" id="forma_grupo" >
							
								<input type="hidden" name="poll_id" value="{{ $poll->id }}">

								<table id = "tabla" style = "border-color: rgb(8, 1, 125);" class="table table-bordered">
									<thead style="background-color: rgba(96, 92, 168, 0.58);
									              border-color: rgb(8, 1, 125);">
									   <tr>
										  <td ><strong>#</strong></td>
										  <td ><strong>DESCRIPCION</strong></td>
										  <td>
											 <button class = "btn btn-sucess" id = "boton_grupo">
											  	Salvar	
											 </button>

											 <button id="agregar_grupo" class="btn  btn-primary"  style="float:right;"  poll_id = "{{$poll->id}}">
													<i class="fa fa-plus" aria-hidden="true" class="pull-right" type="button"></i> Agregar Grupo :
											 </button>
										  </td>
										</tr>
									<thead>

    							    <tbody>

		                                @php $letras = ['a','b','c','d'];
		                                   $fila = 0;
		                                   if ($hay_registros = 0){
			                                  for ($i = 1;$i <= 4;$i++){
			                                     echo "<tr>";
			                                     echo "<td>" . $i . $letras[$i-1] . "</td>";
			                                     echo '<td>
	                                                   <input style = "width: 800px" type = "text" maxlength="100" name= "grupo[' . $fila .'][]"></td>';
			                                     echo "</tr>";
					                          }
				                           }
		                                @endphp

	                                	<?php $aa=0 ?>

										@foreach($questions as $item)

		                                    @if($aa == 0) 
		                                    	@php
		                                    	   $aa = $item->group_number
	                                    		@endphp
		                                    @endif

										    @if ($item->group_number != $aa )
										        <tr><hr style="margin:0;padding:0;border-color:blue;"></tr>
										       <?php $aa = $item->group_number ?>
										    @endif

											<?php 
											    $hay_registros = 1;
											    $fila++;
											    $numero_grupo = $item->group_number;
											?>
											<div class="box-body" style="margin:0;padding:0;">
											   <tr id ="fila{{$fila}}">
												  <td style="width: 40px">
											   	     {{ $item->group_number }}
											   	     {{ $item->group_name }}
		                                          </td>
		                                       	  <td style="width: 10px"> <input type="text" 
		                                       			name="grupo[{{$item->group_number}}][]"  
		                                       			maxlength="84" size="84" 
		                                       			value = "{{ $item->name }}">
		                                       	  </td>
		                                       	 {{--  <td> {{ $item->group_number }}</td> --}}
		                                       	 {{--  //************************************ --}}
                                                  <td style="width: 65px">
													@if ( $poll->category->answers_yes_or_not != 1)
														<span name="addRespuesta" class="btn btn-success btn-xs addRespuesta" title="Agregar Respuesta"  data-toggle="modal" data-target="#modalRespuestas" poll_id="{{$poll->id}}" question_id="{{ $item->id }}"> <i class="fa fa-plus"></i> </span>
														
													@endif
												  </td>
		                                       	 {{--  //************************************ --}}
		                                       	 {{--  <td> {{ $fila }}</td> --}}
											   </tr>
											</div>

										@endforeach	{{-- FIN PREGUNTAS --}}
									</tbody>
							    </table>
							</form>
						  @endif
						</fieldset>
			    	</div>
		    	</div>
		  </div>
	  </section>
   </div>

   {{-- //*****Modal de Respuestas****  --}}
   <div class="modal fade" id="modalRespuestas" tabindex="-1" role="dialog" aria-labelledby="modalRespuestasLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="panel panel-primary" style="border-color: #605ca8 !important">
	                <div class="panel-heading" style="background: #605ca8; border: 1px solid #605ca8">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> RESPUESTA.</h4>
	                </div>
				

					<div class="modal-body">
						<form id="fRespuesta" role="form">
				            {{ csrf_field() }}
				            {{ method_field('PUT') }}
				            {{-- <input type="hidden" name="poll_id" value="{{$poll->id}}">
	              			<input type="hidden" name="question_id" value="0">
	              			<input type="hidden" name="answer_id" value="0"> --}}
	              			 <input type="text" name="poll_id" value="{{$poll->id}}">
	              			<input type="text" name="question_id" value="0">
	              			<input type="text" name="answer_id" value="0">
	              					               
		              		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				                    <label for="name">Respuesta</label>
				                  <input type="text" class="form-control" id="name" name="name" placeholder="Respuesta">
				                </div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
									<label for="name">Valoracion</label>
								  <input type="number" class="form-control" id="value" name="value" placeholder="Valoracion" min="0" required>
								</div>
							</div>

		           		</form>

		           		<div class="clearfix"></div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button id="guardarRespuesta" type="button" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- //*****Fin Modal de Respuestas****  --}}
@endsection

@push('css')
	<style type="text/css">
		h2.titulo{
			border-bottom: 1px solid #EAEAEA;
			padding-left: 10px;
		}
		.box.box-primary{padding: 10px;}
	</style>
@endpush

@push('js')
   
	<script type="text/javascript">
		
        $("#boton_grupo").click(function(e) {
    		e.preventDefault();//para que no haga el submit
    		var forma_grupo = $('#forma_grupo').serialize();
    		
    		$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Contet-type': "x-www-form-urlencoded"
                }
            });

    		$.ajax({
      			type: "POST",
      			url: "{{ route('polls-group.store') }} ",
      			data:  forma_grupo,
      			dataType: 'json',
	      		success: function(data){
	      			console.log("err" + JSON.stringify(data));
	      			alertify.success("Se ha generado con exito...");
					//limpiarTabla();
	      		},
	      		error: function (data){
	      			console.log("err" + JSON.stringify(data));
					alertify.error("Se ha generado con error...");
				}
			});
    	});
  		
  		function limpiarTabla(){

  			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Contet-type': "x-www-form-urlencoded"
                }
            });
  			var tableHeaderRowCount = 1;
			var table = document.getElementById('tabla');
			var rowCount = table.rows.length;
			for (var i = tableHeaderRowCount; i < rowCount; i++) {
			    table.deleteRow(tableHeaderRowCount);
			}
			//location.reload(true);
  
  		}

  		// Si pulso el boton agregar y hay registros
		var hay_registros = <?php echo isset($hay_registros) ? $hay_registros : '';?>;
		var group_number  = <?php echo isset($item->group_number) ? $item->group_number : 0;?>;
        $("#agregar_grupo").click(function(e){
          	e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Contet-type': "x-www-form-urlencoded"
                }
            });	
           	
           	if (group_number > 0) {
                group_number++;
                console.log("A " + "\n");
                Colocar_Registros(group_number);
           	}else{
           		group_number = 1;
           		console.log("B " + "\n")
                Colocar_Registros(group_number);
           	}
        });
            
        function Colocar_Registros(Pnum){
            var letras = new Array('a','b','c','d');
           	console.log("Para :" + Pnum + " " + letras[0]);
           	var fila = <?php echo isset($fila) ? $fila : 0;?>;
           	// console.log("Fila :" + fila);
           	var i =0;
           	var ii =0;
           	var hasta = fila * 2 <= 0 ? 4 : fila * 2;
           	var j = 0;

           	if (fila == 0) {
                for(i= fila+1; i <= hasta;i++){
                	ii++;
                    $('#tabla').
            	    	append("<tr><td style='width: 40px;'>" + Pnum + letras[j] + "</td><td style='width: 100%;'><input style='width:100%;' type='text' name ='grupo["+ Pnum+ "][]'></td><td>"+Pnum +"</td><td>"+ii+"</td></tr>");
            	        j++;
            	}
            	return;
            }

            for(i= fila+1; i <= hasta;i++){
                $('#tabla > tbody > tr:last').
      				after("<tr><td style='width: 40px;'>" + Pnum + letras[j] + "</td><td style='width: 10px;'><input style='width:100%;' type='text' name ='grupo["+ Pnum+ "][]'></td><td></td><td></td></tr>");
            	    //console.log("Hola :"+ Pnum + " " + letras[i-1]);
            	    j++;
            }
			//*****************************************
			var categoria = "{{$poll->category_id}}";
			$("select[name='category_id']").val(categoria);
			$("#addPregunta").click(function(){
				limpiarModal("modalPreguntas");
				$("input[name='poll_id']", "#fPregunta").val($(this).attr('poll_id'));
				console.log();
			});

			$("span[name='addRespuesta']").click(function(){
				limpiarModal("modalRespuestas");

				$("#modalRespuestasLabel").html($(".linkPregunta", $(this).parents(".tblPregunta")).html());
				$("input[name='poll_id']", "#fRespuesta").val($(this).attr('poll_id'));
				$("input[name='question_id']", "#fRespuesta").val($(this).attr('question_id'));
			});

			$(".linkPregunta").click(function(){
				buscarInfoPregunta($(this).attr("id_pregunta"));
				$("#modalPreguntas").modal("show");
			});

			$("#guardarPregunta").click(function(){
				$url = '{{ url('admin/questions/guardar/1') }}';

				if($("input[name='pregunta_id']", "#fPregunta").val() > 0)
					$url = '{{ url('admin/questions/actualizar') }}/' + $("input[name='pregunta_id']", "#fPregunta").val();

				$.ajax({
					url : $url,
					data: $("#fPregunta").serialize(),
					dataType:'json',
					type:'PUT',
					method:'PUT',
					success:function(r){
						if(r.s == 's'){
							$("#modalPreguntas").modal("hide");
							console.log("Pregunta Guardada Satisfactoriamente");
							//alert("Pregunta Guardada Satisfactoriamente");
							location.reload();
						}
					}
				});
			});
		}

		$("#guardarRespuesta_Grupo").click(function(){
			$url = '{{ url('admin/answers/guardar/1') }}';

			if($("input[name='answer_id']", "#fRespuesta").val() > 0)
			  $url = '{{ url('admin/answers/actualizar') }}/' + $("input[name='answer_id']", "#fRespuesta").val();

			$.ajax({
				url : $url,
				data: $("#fRespuesta").serialize(),
				dataType:'json',
				type:'PUT',
				method:'PUT',
				success:function(r){
					if(r.s == 's'){
						agregarRespuestaTabla(r.respuesta.question_id, r.respuesta);
						$("#modalRespuestas").modal("hide");
					}else{
						alert(r.msj);
					    $("#modalRespuestas").modal("show");
					}
				}
			});
		});

		$(".btnEliminarRespuesta").click(function(){
			if(!confirm("¿Realmente desea eliminar esta respuesta?"))
				return false;
			$btn = $(this);
			$.ajax({
				url 	 : '{{ url('admin/answers/eliminar') }}/' + $(this).attr('answer_id'),
				dataType :'json',
				type 	 :'GET',
				success  :function(r){
					alert(r.msj);
					if(r.s == 's'){
						$btn.parents("tr").detach();
					}
				}
			});
		});

		$(".eliminarPregunta").click(function(){
			if(!confirm("¿Realmente desea eliminar esta pregunta?"))
				return false;
			$btn = $(this);
			$idquestion = $(this).attr('question_id');
			var $url = '{{ url('admin/polls/eliminar') }}/' + $(this).attr('question_id');
			
			$.ajax({
				url 	 : $url,
				//data: $("#fRespuesta").serialize(),
				data: {
					'_token': '{{ csrf_token() }}',
					'question_id': $(this).attr('question_id'),
					'poll_id' : $(this).attr('poll_id')
				},
				dataType :'json',
				type 	 :'PUT',
				success  :function(r){
					alert(r.msj);
					if(r.s == 's'){
						$("table[question_id='" + $idquestion + "']").detach();
						$btn.parents("tr").detach();
					}
				}
			});
		});

		function buscarInfoPregunta(id){
			limpiarModal("modalPreguntas");

			$("input[name='pregunta_id']", "#fPregunta").val(id);

			$.ajax({
				url 	 : '{{ url('admin/questions/buscar') }}/' + id,
				dataType :'json',
				type 	 :'GET',
				success  :function(r){
					if(r.s == 's'){
						$("input[name='poll_id']", "#fPregunta").val(r.questions.poll_id);
						$("input[name='name']", "#fPregunta").val(r.questions.name);
						$("input[name='multiple_answers'][value='"+ r.questions.multiple_answers +"']", "#fPregunta").prop('checked', 'checked');
					}
				}
			});
		}

		function limpiarModal(id_modal){
			$("input[type='text'], input[type='hidden'][name!='_token'][name!='_method'], select", "#" +  id_modal).val('');
			$("input[type='radio']", "#" + id_modal).prop('checked', false);
		}

		function agregarRespuestaTabla($question_id, $info){
			$(".tblPregunta[question_id='"+ $question_id +"']").append("<tr class='answer'><td>-</td><td answer_id='"+ $info.id +"'> "+ $info.name +" </td> <td class='text-center'> <span class='btn btn-danger btn-xs btnEliminarRespuesta'> <i class='fa fa-remove'></i> </span> </td>	 <td><span class='badge bg-light-blue'> " + $info.value + " </span></td></tr>");

			$(".btnEliminarRespuesta").click(function(){
				if(!confirm("¿Realmente desea eliminar esta respuesta?"))
					return false;
				$btn = $(this);
				$.ajax({
					url 	 : '{{ url('admin/answers/eliminar') }}/' + $(this).attr('answer_id'),
					dataType :'json',
					type 	 :'GET',
					success  :function(r){
						//alert(r.msj);
						if(r.s == 's'){
							$btn.parents("tr").detach();
						}
					}
				});
			});
		}

	</script>
@endpush