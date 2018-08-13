@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <!-- Service section -->
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="sec-title text-center"><br>
                    <h2 class="wow animated text-center" style="color: #999999;"> Mis Encuestas  </h2>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (Auth::guest())
                                <h3 class="text-center">Debes estar registrado para ver las encuestas</h3>
                            @else
                                @if (!$polls == null)
                                    <div class="table-responsive"> 
                                    <table class="table">
                                        <thead style="background: #999; color: #fff;">
                                            <tr>
                                                <th>TITULO DE LA ENCUESTA</th>
                                                <!-- <th>MODIFICADO</th> -->
                                                <th>PREGUNTAS</th>
                                                
                                                <th>ACCION</th>
                                            </tr>
                                        </thead>
                                        <tbody>                          
                                            @foreach ($polls as $item)
                                        <tr>                                
                                            <td class="active" style='font-size: 13px;font-weight: bold;'>{{ $item->name }}{{--  <a href="#"></a>  --}}</td>
                                            {{-- <td class="active">{{ $item->updated_at }}</td> --}}
                                            <td class="active">{{ count($item->questions) }}</td>
                                            @if ($item->category->hour > 0 || $item->category->minutes > 0 || $item->category->seconds > 0)
                                                <td class="active">
                                                    @if ($item->category->group_type == 1)
                                                        <a href="{{ route('encuestas-grupos.show', $item->id) }}" style="cursor:pointer">
                                                    @else    
                                                        <a href="{{ route('encuestas.show', $item->id) }}" style="cursor:pointer">
                                                    @endif
                                                        <i class="fa fa-pencil-square-o">Comenzar</i> 
                                                    </a>
                                                </td>
                                            @else
                                                <td class="active">
                                                    @if ($item->category->group_type == 1)
                                                        <a href="{{ route('encuestas-grupos.show', $item->id) }}"><i class="fa fa-history">Comenzar por grupos</i></a>
                                                    @else 
                                                        <a href="{{ route('encuestas.reanudar', $item->id) }}"><i class="fa fa-history">Comenzar</i></a>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- end Service section -->
        {{-- <br><br><br><br><br>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Encuestas</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!$polls == null)
                        <div class="table-responsive">                          
                        <table class="table"><tr>
                            <th>Nombre</th><th>Categoria</th></tr>
                            </thead>
                            <tbody>                          
                              @foreach ($polls as $item)
                            <tr>                                
                                <td class="active"><a href="{{ route('encuestas.show', $item->id) }}">{{ $item->name }}</a></td>                             
                                <td class="success">{{ $item->category_id }}</td>
                            </tr>
                              @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>
            </div>
        </div> --}}
  
@endsection