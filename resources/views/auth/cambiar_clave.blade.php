{{--  --}}
@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" action="{{ route('cambiar') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Contraseña</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        @if(isset($msj))
                                            <label><strong style="color: blue">{{$msj}}</strong></label>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Cambiar
                                            </button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
@endsection