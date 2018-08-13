@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div style="text-align: center;">
                                @if(isset($msj))
                                    <label><strong style="color: blue">{{$msj}}</strong></label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>  
@endsection