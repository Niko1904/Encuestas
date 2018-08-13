@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')

<div class="content-wrapper" style="background: #fff"> 
    <section class="content">
        <div class="row">
            <fieldset>
                <legend style="text-align: center;font-weight: 900;padding: 10px;">
                    <h2> ¿ Qué tipo de encuesta deseas crear ? </h2>
                    <small style="font-weight: normal;">
                        Esto nos da una idea de los tipos de encuesta que quieres crear para que puedas clasificarla fácilmente 
                    </small>
                </legend>
                <div class="box-header with-border">
                    <h3> Listado de Categorías </h3>
                    <p>{{-- categoria  {{ $encuesta->category }} --}}
                      @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                      @endif
                    </p>
                    <h1> <a href="{{ url('admin/categories/create') }}" class="btn btn-primary pull-right btn-sm" style="float: right;">Crear Categoria</a></h1>
                </div>
                
                <div class="col-md-12">
                    <table id="example1" class="table table-striped table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Nombre de la categoria</th>
                                <th>Tipo de tiempo</th>
                                <th>Es pausable</th>
                                <th>Preguntas obligatorias</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($categories))
                            @foreach ($categories as $item)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/categories/' . $item->id . '/edit') }}">
                                            {{ $item->name }}
                                        </a> {{ $item->nif_cif }}
                                    </td>
                                      
                                    <td> 
                                        @if ($item->timer_type == 1)
                                          Sin tiempo
                                        @elseif ($item->timer_type == 2)
                                          Tiempo por pregunta
                                        @elseif ($item->timer_type == 3)
                                           Tiempo por encuesta
                                        @endif
                                    </td>

                                    <td> 
                                        @if ($item->pausable == 1)
                                          Si
                                        @else
                                          No
                                        @endif
                                    </td>

                                    <td> 
                                        @if ($item->answer_required == 1)
                                          Si
                                        @else
                                          No
                                        @endif
                                    </td>
                                      

                                    <td>
                                        <a href="{{ url('admin/categories/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> 
                                        <form action="{{ route('categories.destroy',  $item->id) }}" method="post" style="display:inline">
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
                                    
          

