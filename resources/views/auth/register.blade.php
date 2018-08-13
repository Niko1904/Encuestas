@extends('user.layouts.app2')
@section('content')
     <br>    <br>    <br>    <br>
    <section id="service" style=" margin-top: 26px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Registro</div>
                        <!--<div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-2 separator social-login-box" style="border-right: 1px solid #dfdfe0;"> <br />
                                        <a href="/login/facebook" class="btn facebook btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="min-width:170px; background-color:#354E84;color:#fff;" class="" role="button">Inicio con Facebook</a>
                                        <a href="/login/twitter" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#00A5E3;color:#fff;">
                                        Inicio con Twitter</a>
                                        <a href="/login/google" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#c32f10;color:#fff;">Inicio con Google</a>
                                    </div>
                                </div>
                                </div>    
                                <div class="col-md-6">
                                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

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
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>-->
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            <div class="panel-body">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box" style=""> <br />
                                        <a href="/login/facebook" class="btn facebook btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="min-width:170px; background-color:#354E84;color:#fff;" class="" role="button">Inicio con Facebook</a>
                                        <a href="/login/twitter" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#00A5E3;color:#fff;">
                                        Inicio con Twitter</a>
                                        <a href="/login/google" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#c32f10;color:#fff;">Inicio con Google</a>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 login-box " style="border-left: 1px solid #dfdfe0; height: 370px;">
                                        <div class="input-group {{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom:10px; ">
                                            <label for="name" class="col-md-4 control-label">Nombre</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre"  required autofocus>
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                        <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom:10px; ">
                                            <label for="name" class="col-md-4 control-label">E-mail</label>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="email" required />
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom:10px; ">
                                            <label for="name" class="col-md-4 control-label">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password"  required autofocus>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong style="color: red">{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                        <div class="input-group" style="margin-bottom:10px; ">
                                            <label for="name" class="col-md-12 control-label" style="text-align: left !important; ">Confirmar Password</label>
                                           <input id="password-confirm" type="password" class="form-control" placeholder="Confirma Password"  name="password_confirmation" required>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="checkbox">
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
       <!-- -->
   </section>  
@endsection