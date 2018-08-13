@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modulo de Usuarios
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <div class="caption">
          <i class="icon-social-dribbble font-yellow"></i>
          <span class="caption-subject font-green bold uppercase">Usuarios registrados</span>
          <a class='btn btn-success' href="{{ route('admins.users') }}">Usuarios</a>
          
          @if(session()->has('message'))
              <div class="alert alert-info">
                  {{ session()->get('message') }}
              </div>
          @endif
        </div>
          <a class='col-lg-offset-5 btn btn-success' href="{{ route('admins.create') }}">Crear nuevo Administrador</a>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
          
        </div>
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Usuarios administradores</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-striped table-hover table-bordered dataTable">
              <thead>
              <tr>
                <th>S.No</th>
                <th>Nombre</th>
                <th>email</th>
                <th>Cargo</th>
                <th>Creado</th>
                <th>Editar</th>
                <th>Borrar</th>
              </tr>
              </thead>
              <tbody>
              @if (!empty($admins))
              @foreach ($admins as $admin)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>
                    @if ($admin->level == 1)
                      Administrador
                    @endif
                  
                    @if ($admin->level == 3)
                      Asesor
                    @endif
                  </td>
                  <td>{{ $admin->created_at }}</td>
                  <td><a href="{{ route('admins.edit',$admin->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                  <td>
                    <form id="delete-form-{{ $admin->id }}" method="post" action="{{ route('admins.destroy',$admin->id) }}" style="display: none">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                    </form>
                    <a href="" onclick="
                    if(confirm('seguro?'))
                        {
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $admin->id }}').submit();
                        }
                        else{
                          event.preventDefault();
                        }" ><span class="glyphicon glyphicon-trash"></span></a>
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
              <tfoot>
              {{-- <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Sub Title</th>
                <th>Slug</th>
                <th>Creatd At</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr> --}}
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        {{-- Footer --}}
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection