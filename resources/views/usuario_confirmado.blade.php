@extends('user.layouts.app2')
@section('content')
    <br>    <br>    <br>    <br>
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-info" style='background-color: #fff !important;'>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                       <span class="glyphicon glyphicon-ok"></span> <strong>Confirmación de usuario</strong>
                        <hr class="message-inner-separator">
                        <h2>
                           Usuario confirmado exitosamente!!!.
                        </h2>
                    </div>
                </div>
                
            </div>
        </div>
    </section>  
@endsection
@push('css')
<style type="text/css">
    body { margin-top:30px; }
    hr.message-inner-separator
    {
        clear: both;
        margin-top: 10px;
        margin-bottom: 13px;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
        background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
    }

</style>
@endpush