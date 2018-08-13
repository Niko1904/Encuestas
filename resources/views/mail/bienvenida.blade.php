<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
         .redes-a{
            padding: 1% 0% 2% 6%;
            margin-left: 7px;
        }
        .img-redsocial{
            margin-top: 7px !important;
        }
    </style>
</head>
<body>
 
    <h1>Te damos la Bienvenida </h1>
    <p> Usuario: <b> {{ $usuario }} </b>  </p>
    <p> Para activar tu cuenta por favor haz clic en el siguiente enlace : </p>
    <h3> 
        <a href="{{ route('validar_link_confimacion').'/'.$codigo_confirmacion  }}"> 
            Activar Cuenta
        </a> 
    </h3>
    
     
</body>
</html>