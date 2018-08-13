{{--  --}}
@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
<section id="service" style=" margin-top: 26px;">
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Login</h3>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        <div class="panel-body">
                                {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box" style="border-right: 1px solid #dfdfe0;"> <br />
                                    <a href="/login/facebook" class="btn facebook btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="min-width:170px; background-color:#354E84;color:#fff;" class="" role="button">Inicio con Facebook</a>
                                    <a href="/login/twitter" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#00A5E3;color:#fff;">
                                    Inicio con Twitter</a>
                                    <a href="/login/google" class="btn twitter btn-block" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" role="button" style="min-width:170px; background-color:#c32f10;color:#fff;">Inicio con Google</a>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 login-box">
                                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom:10px; border: 1px solid #ddd;">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email@gmail.com" required autofocus>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom:10px; border: 1px solid #ddd;">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required />
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    <p>
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Olvide mi contraseña
                                        </a>
                                    </p>
                                    No tienes una cuenta? <a href="{{ route('register') }}"> Registrate aquí</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                     <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label" style="position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;"><i class="fa fa-check"></i></span>Iniciar</button>
                                    <button type="re" class="btn btn-labeled btn-danger">
                                        <span class="btn-label" style="position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;"><i class="fa fa-ban"></i></span>Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>  
@endsection
