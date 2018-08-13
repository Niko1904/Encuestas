@extends('admin.layouts.app')

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Crear usuario
      <small>Administradpor, Agente, Vendedor</small>
    </h1>
     @include('includes.messages')
    
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
      
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Datos</h3>
          </div>
          <!-- /.box-header -->
          
          <!-- form start -->
          <form role="form" action="{{ route('admins.update', $admin->id) }}" method="post" >
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="box-body">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="title">nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name"  value="{{ $admin->name }}" >
              </div>

              <div class="form-group">
                <label for="subtitle">email</label>
                <input type="email" disabled class="form-control" id="email" name="email" placeholder="email" required value="{{ $admin->email }}">
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
                    <option value="1"  @if($admin->level == 1) selected='selected' @endif >administrador</option>
                    <option value="3"  @if($admin->level == 3) selected='selected' @endif >asesor</option>
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