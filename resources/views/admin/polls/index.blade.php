@extends('admin.layouts.app')

@section('headSection')
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<div class="content-wrapper" style="background: #fff">
    <section class="content">
        <div class="row">
            <fieldset>
                <legend style="text-align: center;font-weight: 900;padding: 10px;">LISTADO DE ENCUESTAS <small></small></legend>
                <div class="box-header with-border">
                    <p>{{-- categoria  {{ $encuesta->category }} --}}
                      @if(session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                      @endif
                    </p>
                    <h1> <a href="{{ url('admin/polls/create') }}" class="btn btn-primary pull-right btn-sm" style="float: right;">Crear Encuesta</a></h1>
                </div>
                <div class="col-md-12">@include('includes.messages')</div>
                <div class="col-md-12">
                    <table id="example1" class="table table-striped table-hover table-bordered dataTable">
                        <thead>
                            <tr>
                                <th>Nombre de la encuesta</th>
                                <th>Mostrar todas las preguntas?</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($polls))
                                @foreach ($polls as $item)
                                    <tr>
                                        <td>
                                            @if ($item->category->group_type == 1)
                                                <a href="{{ route('polls-group.edit',  ['poll_id'=> $item->id,'hay_registros' => 0]) }}">{{ $item->name }} </a>
                                            @else
                                                <a href="{{ url('admin/polls/' . $item->id . '/edit') }}">{{ $item->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->show_all_questions == 1)
                                                Si
                                            @elseif ($item->show_all_questions == 0)
                                                No
                                            @endif
                                        </td>

                                        <td>{{ $item->category->name }}</td>

                                        <td>
                                            @if ($item->category->group_type == 1)
                                                <a href="{{ route('polls-group.edit',  ['poll_id'=> $item->id,'hay_registros' => 0]) }}" class="btn btn-primary btn-xs">
                                            @else
                                                <a href="{{ url('admin/polls/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">
                                            @endif
                                            <i class="fa fa-pencil"></i>
                                            </a>                            
                                            <form action="{{ route('polls.destroy',  $item->id) }}" method="post" style="display:inline">
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
                                    
          

