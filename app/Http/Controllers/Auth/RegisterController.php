<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    use RegistersUsers;

   protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    
    protected function create(array $data)
    {   
        $codigo_confirmacion = str_replace("/", "", bcrypt(sha1(uniqid('', true)))) ;
        $codigo_confirmacion = str_replace(".", "", $codigo_confirmacion);
        $usuario = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'codigo_confirmacion' => $codigo_confirmacion,
                'verificado' => 0
            ]);
       $ok = true;
        if($usuario)        
          $ok = $this->enviarCorreo($usuario);
         
        if ($ok) {
            return view('registrado', ['msj' => 'Enviamos un correo de confirmación a su correo']);
        }
        return view('registrado',['msj' => 'Ocurrio un error!!!']);
        
    }
    public function vistamensajeRegistrado(){
        return view('registrado');
    }
    public function enviarCorreo($data){
        $asunto = "Activación de cuenta";
        $destinatario = $data->email;
        $dato = User::where('email', '=', $data->email)->first();
        $codigo_confirmacion = $data->codigo_confirmacion;
       if($dato){
            $destinatario = $data->email; //correo es el correo al que se va a enviar
            $correofrom = "pruebaempresacorreo@gmail.com";

            \Mail::send('mail.bienvenida',['usuario'=> $dato->name, 'codigo_confirmacion' => $codigo_confirmacion ], function ($message) use($destinatario, $correofrom){
                $message->from($correofrom, 'Administrador');
                $message->to($destinatario)->subject('Activar cuenta');
            });
            return true;
        }
        
        return false;
    }
    public function validar_link_confimacion($codigo){
        
        $usuario = User::select('name', 'id')->where('codigo_confirmacion', $codigo)->first();
        if(!is_object($usuario))
            return redirect()->route('home');
        
        $r = User::where("id", '=', $usuario->id)->update(['verificado' => true]);
        return view('usuario_confirmado');
    }
            
}
