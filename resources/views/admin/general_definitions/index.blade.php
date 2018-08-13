@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')

<div class="content-wrapper" style="background: #fff"> 
    <section class="content">
        <div class="row">
            <fieldset>
                <legend style="text-align: center;font-weight: 900;padding: 10px;">Definiciones Generales <small></small></legend>
                <div class="box-header with-border">
                    <p>{{-- categoria  {{ $encuesta->category }} --}}
                      @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                      @endif
                    </p>
                    
                    {{-- <h1> <a href="{{ url('admin/general_definitions/create') }}" class="btn btn-primary pull-right btn-sm" style="float: right;">Crear Mensaje de Bienvenida a Encuestas</a></h1> --}}
                    
                   {{--  @unless ({{ $generaldefinitions->id }} <= 0)  --}}
                    @if($puede_crear==null)
                        <h1> <a href="{{ url('admin/general_definitions/create') }}" class="btn btn-primary pull-right btn-sm" style="float: right;">Crear Mensaje de Bienvenida a Encuestas</a></h1>
                    @endif
                    {{-- @endunless --}}

                </div>
                
                <div class="col-md-12">
                    <table id="example1" class="table table-striped table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Mensaje</th>
                                <th>Descripción del Mensaje</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($generaldefinitions))

                            @foreach ($generaldefinitions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>  

                                    <td>
                                        <a href="{{ url('admin/general_definitions/' . $item->id . '/edit') }}" 
                                            class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> 
                                        <form action="{{ route('general_definitions.destroy',  $item->id) }}"  method="post" style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            
                                             <button type="submit" alt="Eliminar"  class="btn btn-danger btn-xs" onclick="return confirm('Esta seguro de eliminar?');">
                                              <i class="fa fa-minus"></i>
                                            </button>
                                        </form>
                                                      
                                    </td>
                                </tr>
                            @endforeach
                        @endif
              </tbody>
             
            </table>
                </div>
            </fieldset>
        </div>
    </section>
  
</div>
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
                                    
          
