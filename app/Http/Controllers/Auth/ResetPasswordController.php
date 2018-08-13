<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use DB;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function guardar(Request $request){
       $validator =  $this->validate($request, [
            'email' => 'required', 'min:3', 'max:50', 'email'
            
        ]);
        
        if($validator){
            return ["s"=> "n", "msj" => "Email Invalido"];
        }
        $d = $request->all();
        $usuario = User::where('email', $d['email'])->first();
        if(!is_object($usuario))
            return (["s" => "n", "msj" => "Email invalido"]);
        
        if($this->enviarCorreoRecuperacion($usuario))
                return redirect()->route('home');
    }
    public function enviarCorreoRecuperacion($data = array()){
        $asunto = "Restablecimiento de Contraseña";
        $destinatario = $data->email;
        $dato = User::where('email', '=', $data->email)->first();
       if($dato){
            $destinatario = $dato->email; //correo es el correo al que se va a enviar
            $codigo_confirmacion = str_replace("/", "", bcrypt(sha1(uniqid('', true)))) ;
            $codigo_confirmacion = str_replace(".", "", $codigo_confirmacion);
            if ($data->email) {
                 $codigo = User::where('email', $dato->email)->update(['codigo_confirmacion' => $codigo_confirmacion,
                    'verificado' => 0]);
            }
            $correofrom = "pruebaempresacorreo@gmail.com";

            \Mail::send('mail.recuperacion',['usuario'=> $dato->name, 'codigo_confirmacion' => $codigo_confirmacion, ], function ($message) use($destinatario, $correofrom){
                $message->from($correofrom, 'Administrador');
                $message->to($destinatario)->subject('Recuperacion de cuenta');
            });
            return true;
        }
        
        return false;
    }
    public function validar_link($codigo){
        
        $usuario = User::select('name')
                        ->where('codigo_confirmacion', 'like' , $codigo)->first();

        if(!is_object($usuario))
            return redirect()->route('home');
        
        Session::put('usuario_cambio_clave', $usuario->name);
        return view('auth.cambiar_clave', ['usuario' => $usuario]);
    }
    public function guardarNuevaContrasena(Request $request){
       $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);

        $r = User::where("name", Session::get('usuario_cambio_clave'))->first();

        DB::beginTransaction();
        try {
            $usuario = Session::get('usuario_cambio_clave');

            $password = $request->password;

            $r = User::where("name", '=' , $usuario)->update(['password' => bcrypt($password), 'verificado' => 1]);
        } catch (Exception $e) {
            DB::rollback();
            return $e->errorInfo[2];
        }

        DB::commit();
        return view('auth.cambiar_clave', ['msj' => 'Ha cambiado su contraseña satisfactoriamente']);
        
    }
}
