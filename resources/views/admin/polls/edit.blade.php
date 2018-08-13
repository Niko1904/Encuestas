@extends('admin.layouts.app')

@section('main-content')
	<div class="content-wrapper" style="background: #fff">
	  	<section class="content" style="background: #fff;">
		    <div class="row">
	            <fieldset>
	                <legend style="text-align: center;font-weight: 900;padding: 10px;">ENCUESTAS </legend>
	                <div class="col-md-12">@include('includes.messages')</div>
	                <div class="col-md-12">
	                    <form role="form" action="{{ route('polls.update', $poll->id) }}" method="post">
	                        {{ csrf_field() }}
	                        {{ method_field('PUT') }}
	                        <div class="box-body">
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                                    <label for="categoria">Categoria</label><br>

	                                    <select name="category_id" id="" class="form-control">
	                                        @foreach ($categories as $item)
	                                            <option value="{{$item->id}}">{{$item->name}}</option>
	                                        @endforeach
	                                    </select>                   
	                                </div>

	                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
	                                    <label for="name">Nombre de la encuesta</label>
	                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la encuesta" value="{{ $poll->name }}">
	                                </div>

	                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-top: 25px;">
	                                    <button type="submit" class="btn btn-primary">Guardar</button>
	                                    <a href='{{ route('polls.index') }}' class="btn btn-warning">Regresar</a>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </fieldset>
	        </div>
			<div class="row">
		    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		    		<div class="box box-primary" style="border-top-color: #605ca8;">
		    			<fieldset>
		    				<legend style="text-align: center;font-weight: 900;padding: 10px;">PREGUNTAS DE LA ENCUESTA</legend>
		    				<div class="clearfix"></div>
				    		<div id="col-lg-12 col-md-12 col-sm-12 col-xs-12 contenedorPreguntas">
							@if (!empty($questions))
								<table class="table table-bordered">
									<tbody style="background-color: rgba(96, 92, 168, 0.58);border-color: rgb(8, 1, 125);">
										<tr >
											<td ><strong>DESCRIPCION</strong></td>
											<td>
												<button id="addPregunta" class="btn btn-primary" data-toggle="modal" data-target="#modalPreguntas" style="float: right;"  poll_id="{{$poll->id}}">
		    										<i class="fa fa-plus" aria-hidden="true" class="pull-right" ></i> Agregar Pregunta
		    									</button>
		    								</td>
										</tr>
									</tbody>
								</table>
								@foreach($questions as $item)
									<div class="box-body">
										<table class="table table-bordered tblPregunta" question_id="{{ $item->id }}">
											<tr>												
												<th style="width: 10px">{{ $loop->iteration }}
													@if ( !$item->group_name == null)
														 {{  $item->group_name }}
													@endif</th> 
												<th class="question" id="{{ $item->id }}" if >
													<input type="hidden" id="question_id" value="{{ $item->id }}">

													<a class="linkPregunta" href="#" id_pregunta="{{ $item->id }}">
														{{ $item->name }}
													</a>
												</th>

												<th style="width: 65px">
													@if ( $poll->category->answers_yes_or_not != 1)
														<span name="addRespuesta" class="btn btn-success btn-xs addRespuesta" title="Agregar Respuesta"  data-toggle="modal" data-target="#modalRespuestas" poll_id="{{$poll->id}}" question_id="{{ $item->id }}"> <i class="fa fa-plus"></i> </span>
														<span class="btn btn-danger btn-xs eliminarPregunta" title="Eliminar Pregunta" poll_id="{{$poll->id}}"question_id="{{ $item->id }}"> <i class="fa fa-minus"></i> </span>
													@endif
												</th>
												<th style="width: 20px">Valoracion</th>
											</tr>

											@if (!empty($item->answers))
												@foreach($item->answers as $answer)
												<tr>
													<td>-</td>
													@if ( $poll->category->answers_yes_or_not === 1)
														<td class="answer" answer_id="{{ $answer->id }}" >
															{{ $answer->name }}
														</td>
														<td>
															<span class="badge bg-light-blue">{{ $answer->value }}</span>
														</td>
													@else
														<td class="answer" answer_id="{{ $answer->id }}" data-toggle="modal" data-target="#answerModal">
															{{ $answer->name }}
														</td>
														<td class="text-center"> <span class="btn btn-danger btn-xs btnEliminarRespuesta" answer_id="{{ $answer->id }}"> <i class="fa fa-remove"></i> </span> </td>		               
														<td>
															<span class="badge bg-light-blue">{{ $answer->value }}</span>
														</td>
													@endif
												</tr>
												@endforeach
											@endif      
										</table>
									</div>
								@endforeach	{{-- FIN PREGUNTAS --}}
							@endif
						</fieldset>
			    	</div>
		    	</div>
		    </div>
		</section>
	</div>
	

	<div class="modal fade" id="modalPreguntas" tabindex="-1" role="dialog" aria-labelledby="modalPreguntasLabel">
		<div class="modal-dialog" role="document">
			<div class="panel panel-primary" style="border-color: #605ca8 !important">
                <div class="panel-heading" style="background: #605ca8; border: 1px solid #605ca8">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel"><span class="glyphicon glyphicon-info-sign"></span> CREAR PREGUNTA.</h4>
                </div>

				<div class="modal-body">
					<form id="fPregunta" role="form">
			            {{ csrf_field() }}
			            {{ method_field('PUT') }}
			            <input type="hidden" name="poll_id" value="0">
			            <input type="hidden" name="pregunta_id" value="0">
	              
	              		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								  <label for="name">Nombre de la pregunta</label>
			                  	<input type="text" class="form-control" id="name" name="name" placeholder="pregunta" value="">
			                </div>
							
			            </div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
							@if ( $poll->category->answers_yes_or_not === 1 || $poll->category->group_type == 1)
								<label for="slug">¿Múltiples respuestas?</label>
								<br>
								<input type="radio" name="multiple_answers" value="1"  disabled> Si<br>
								<input type="radio" name="multiple_answers" value="0" checked > No<br>
								<br>
			                  	<input type="text" class="form-control" id="group_name" name="group_name" placeholder="grupo" value="">

							@else
								<label for="slug">¿Múltiples respuestas?</label>
								<br>
								<input type="radio" name="multiple_answers" value="1" checked="checked" > Si<br>
								<input type="radio" name="multiple_answers" value="0"> No<br>
							@endif
							</div>
						</div>

	           		</form>

	           		<div class="clearfix"></div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="guardarPregunta" type="button" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>

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
				            <input type="hidden" name="poll_id" value="{{$poll->id}}">
	              			<input type="hidden" name="question_id" value="0">
	              			<input type="hidden" name="answer_id" value="0">
	              					              
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
		$(function(){
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
                console.log($url);
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

			$("#guardarRespuesta").click(function(){
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
						alert(r.msj);
						if(r.s == 's'){
							$btn.parents("tr").detach();
						}
					}
				});
			});
		}
	</script>
@endpush