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
              @if(Session::has('flash_message'))
                <p class="alert alert-info">{{Session::get('flash_message')}}</p>
              @endif
	          </div>
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('polls_users.save') }}" method="post">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-4">

	              {{-- <div class="form-group">
	                <label for="user_id">Nombre del usuario</label><br>
	                <select name="user_id" id="user_id" class="form-control">
                      <option value="">.</option>
	                  @foreach ($users as $item)
	                    <option value="{{$item->id}}" name="user_id">{{$item->name}}</option>
	                  @endforeach
	                </select>
	              </div> --}}

                <div class="form-group">
	                <label for="user_id">Email del usuario</label><br>
	                <select name="user_id" id="user_id" class="form-control" required>
                      <option value="">Seleccionar email</option>
	                  @foreach ($users as $item)
	                    <option value="{{$item->id}}" name="user_id">{{$item->email}}</option>
	                  @endforeach
	                </select>
	              </div>

	              <div class="form-group">
	                <label for="name">Listado de encuestas</label>
                  @foreach ($polls as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                      <input type="checkbox"
                      name="polls_chk[]"
                      value="{{ $item->id }}"
                      class="chk"
                      id="chk{{ $item->id }}"
                     >
                     {{ $item->name }}
                  @endforeach
	              </div>

  	            <div class="form-group">
  	              <button type="submit" class="btn btn-primary">Guardar asignacion</button>
                  <input type="hidden" name="url_search" id="url_search" value="{{url('/admin/pollsusers/search')}}">
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
      var url_search = document.getElementById('url_search').value;

      $('#user_id').on('change',function () {
          var id = $('#user_id option:selected').val();
          console.log("el id es : " + id);
          $(':checkbox').prop('checked',false);
          $.ajax({
            url: url_search + '/' + id
          })
          .done(function( data ) {
              asig = JSON.stringify(data);
              console.log("respusta ajx : " + JSON.stringify(data) );
              if (data.length > 0) {
                  console.log("si hay datos");

                  for (var i = 0; i < data.length; i++) {
                    console.log("poll_id: "+data[i].poll_id + " , el user id: " + data[i].user_id);
                    //$('#'+data[i].poll_id).attr('checked', true);
                    console.log("si hay datos -----> " + 'chk'+data[i].poll_id);
                    $('#chk'+data[i].poll_id).prop('checked',true);
                  }

              }
              if (data.length < 1) {
                  console.log("no hay datos");
                  $(':checkbox').prop('checked',false);
              }
          });

      });

	});
</script>
@endpush
