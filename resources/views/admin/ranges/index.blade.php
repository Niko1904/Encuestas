@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<div class="content-wrapper" style="background: #fff">
    <section class="content">
        <div class="row">
            <fieldset>
                <legend style="text-align: center;font-weight: 900;padding: 10px;">LISTADO DE ENCUESTAS POR RANGOS <small></small></legend>
                <div class="box-header with-border">
                    <p>{{-- categoria  {{ $encuesta->category }} --}}
                      @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                      @endif
                    </p>
                </div>
                <div class="col-md-12">@include('includes.messages')</div>
                <div class="col-md-12">
                    <table id="example1" class="table table-striped table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Nombre de la encuesta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($polls))
                                @foreach ($polls as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ url('admin/ranges', $item->id ) }}">{{ $item->name }}</a>{{ $item->nif_cif }}
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/ranges', $item->id )}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a> 
                                            <form action="{{ route('ranges.destroy',  $item->id) }}" method="post" style="display:inline">
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
                                    
          

