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
     Encuestas
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h1>Encuestas <a href="{{ url('admin/store/create') }}" class="btn btn-primary pull-right btn-sm">Crear Tienda</a></h1>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th><th>Name</th><th>Nif Cif</th><th>Categoria</th><th>Acciones</th>
              </tr>
              </thead>
              <tbody>
              @if (!empty($store))
                @foreach ($store as $item)
                  <tr>
                      <td>{{ $item->id }}</td>
                      <td>
                        <a href="{{ url('admin/store', $item->id . '/edit' ) }}">{{ $item->name }}</a></td><td>{{ $item->nif_cif }}</td>
                      <td> 
                        @if ($item->clasification)
                          @foreach ($item->clasification as $element)
                            {{$element->name}}
                          @endforeach
                        @endif
                      </td>
                      

                      <td>
                          <a href="{{ url('admin/store/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Actualzar</a> 
                          {!! Form::open([
                              'method'=>'DELETE',
                              'url' => ['admin/store', $item->id],
                              'style' => 'display:inline'
                          ]) !!}
                              {!! Form::submit('Elimninar', ['class' => 'btn btn-danger btn-xs']) !!}
                          {!! Form::close() !!}
                      </td>
                    </tr>
                @endforeach
              @endif
              </tbody>
             
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
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
    /*$("#example1").DataTable();*/
    $("#example1").DataTable( {
      "pageLength": 100
    });
  });
</script>
@endsection
                                    
          

