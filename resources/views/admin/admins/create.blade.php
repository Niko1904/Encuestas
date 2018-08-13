@extends('admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear usuario
      <small>Administrador</small>
    </h1>
     @include('includes.messages')
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
      {{-- {{Auth::user()->id}} --}}
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Datos</h3>
          </div>
          <!-- /.box-header -->
          
          <!-- form start -->
          <form role="form" action="{{ route('admins.store') }}" method="post" >
            {{ csrf_field() }}
            <div class="box-body">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="title">nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name"  value="{{ old('name') }}" >
              </div>

              <div class="form-group">
                <label for="subtitle">email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="email" required value="{{ old('email') }}">
              </div>

              <div class="form-group">
                <label for="slug">password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
              </div>

              <div class="form-group">
                <label for="slug">confirmar password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="confirmar password" required>
              </div>
              
              <div class="form-group">
                <label for="slug">tipo de administrador</label>
                <select name="level" id="level" class="form-control" required>
                    <option disabled selected>Seleccione</option>
                    <option value="1" {{ old('level') == "1" ? 'selected' : '' }}>administrador</option>
                    <option value="3" {{ old('level') == "3" ? 'selected' : '' }}>asesor</option>
                </select>
              </div>
            	
            </div>
			
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Grabar</button>
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