<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\AplicationPoll;
use App\Answer;
use App\Category;
use App\GeneralDefinitions;
use App\Poll;
use App\Range;
use App\Resume;
use App\MasterAplication;
use App\DetailAplication;
use App\Question;

class EncuestaPorGrupoController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth'/*,  ['except' => ['index'] ]*/);
    }
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $encuesta = Poll::find($request->poll_id);
        $preguntas = Question::where('poll_id', '=', $request->poll_id)->get();

        if ($encuesta->category->group_type >0) {
            $group_a_total = 0;
            $group_b_total = 0;
            $group_c_total = 0;
            $group_d_total = 0;

            $grupo_a =0;
            $grupo_b =0;
            $grupo_c =0;
            $grupo_d =0;

            foreach ($request->id_respuestas as $key => $value) {
                //print_r('llave: '.$key .' valor o id: '. $value. ' ');
                $respuesta = Answer::where('id', $value)->first();
                
                if ($respuesta->group_name == 'a' && $respuesta->value >0) {
                    //return 1;
                    $grupo_a += 1;
                }
                if ($respuesta->group_name == 'b' && $respuesta->value >0) {
                    $grupo_b += 1;
                }
                if ($respuesta->group_name == 'c' && $respuesta->value >0) {
                    $grupo_c += 1;
                }
                if ($respuesta->group_name == 'd' && $respuesta->value >0) {
                    $grupo_d += 1;
                }
                
            } 
            //return " grupo a : " . $grupo_a . " grupo b : " . $grupo_b . " grupo c : " . $grupo_c. " grupo d : " . $grupo_d;
            $st = Session::get('start_date');

            MasterAplication::where('user_id', '=', Auth::user()->id)
                ->where('poll_id', '=', $request->poll_id)
                ->delete();

            $master_aplication = new MasterAplication();
            $master_aplication->start_date = $st; 
            $master_aplication->user_id = Auth::user()->id;
            $master_aplication->poll_id = $request->poll_id;;
            $master_aplication->status = 0;
            $master_aplication->save();
        
            //$respuestas = Answer::where('poll_id', $encuesta->id)->get();
            $total = 0;

            AplicationPoll::where('user_id', '=', Auth::user()->id)
                ->where('poll_id', '=', $request->poll_id)
                ->delete();
            if(isset($request->id_respuestas) && count($request->id_respuestas) > 0)
                foreach ($request->id_respuestas as $key => $value) {
                    //print_r('llave: '.$key .' valor: '. $value. ' ');
                    $aplication_poll = new AplicationPoll();
                    $total += Answer::where('id', $value)->first()->value;
                    $answer = Answer::find($value);
                    $aplication_poll->start = $st;
                    $aplication_poll->end = Carbon::now();
                    $aplication_poll->value = $answer->value;
                    $aplication_poll->user_id = Auth::user()->id;
                    $aplication_poll->poll_id = $request->poll_id;
                    $aplication_poll->question_id = $answer->question_id;
                    $aplication_poll->answer_id = $answer->id;
                    $aplication_poll->save();
                }        
            // cuando la encuesta es por porcentaje y con 2 respuestas
            $yes_or_not = false;
            $resume = new \stdClass();
            $resume->text = null;
            $ranges = Range::where('poll_id', '=', $request->poll_id)->get();
            $rangos = array();
            $rango_usuario = array();

            if ( $encuesta->category->answers_yes_or_not == 1 && $encuesta->category->percentage_values == 1 ) {
                $yes_or_not = true;
                $numero_preguntas = Question::where('poll_id', '=', $encuesta->id)->count();
                $preguntas_contestadas = $total;
                $total = 0;
                $total = ($preguntas_contestadas * 100 ) /  $numero_preguntas; 
                //dd($total);
            }
            //***************************************************************** */
            
            if(count($ranges) > 0)
                foreach ($ranges as $key => $value) {
                    $rangos[] = array(
                        'name'      => $value->text,
                        'y'         => $value->to,
                        'drilldown' => $value->text
                    );
                    if ( $total >= $value->from && $total <= $value->to) {
                        $range = $value;
                        $resume = new Resume();
                        $resume->user_id = Auth::user()->id;
                        $resume->poll_id = $request->poll_id;
                        $resume->total = $total;
                        $resume->from = $value->from;
                        $resume->to = $value->to;
                        $resume->text = $value->text;
                        $resume->save();

                        $rango_usuario = array(
                            'name'      => 'Su rango',
                            'y'         => $value->to,
                            'drilldown' => 'Su rango'
                        );
                    }
                }

            $rangos[] = $rango_usuario;

            $rangos = json_encode($rangos);

            //desvincular encuesta de usuario para que no la vuelva a aplicar
            //$this->desvincular(Auth::user()->id, $request->poll_id);
            if ($yes_or_not) $total = $total . ' %';
            return view('user.encuestas.resultados.resultado', compact('resume', 'total', 'encuesta', 'rangos'));

            
        }
    }

  
    public function show($id)
    {
        //return "ashow grupos";

        $contestadas = null;
        $generaldefinitions = GeneralDefinitions::where('id', '>',0)->first();

        $master_aplication = MasterAplication::where('poll_id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->where('status', '=', 0)
            ->first();
        
        $encuesta   = Poll::findOrFail($id);
        $preguntas  = Question::where('poll_id', '=', $encuesta->id)->get();
        $detail_aplication = [];

        if ($master_aplication) // si ha guardado la encuesta anteriormente
            $detail_aplication = DetailAplication::where('master_aplication_id', '=', $master_aplication->id)->get();

        Session::put('start_date', Carbon::now()->format('Y-m-d H:i:s'));

        $numero_preguntas = Question::where('poll_id', '=', $encuesta->id)->count();
        //return $encuesta->category->timer_type;
        if($encuesta->category->timer_type == 2){ // Cuando es tiempo por pregunta
            if ($encuesta->category->show_all_questions == 0) 
                //return $generaldefinitions;
                return view('user.encuestas.grupos.grupos', compact('encuesta', 'preguntas', 'contestadas', 'numero_preguntas', 'generaldefinitions'));
            return view('user.encuestas.grupos.grupos', compact('encuesta', 'preguntas', 'detail_aplication', 'contestadas', 'generaldefinitions'));
        }else{
            //tiempo general
            return view('user.encuestas.grupos.grupos', compact('encuesta', 'preguntas', 'detail_aplication', 'contestadas', 'generaldefinitions'));
        }
    }
    
    public function reanudar($id)
    {
        //dd($id);
        $generaldefinitions = GeneralDefinitions::where('id', '>',0)->first();
        $contestadas = AplicationPoll::where('poll_id', '=', $id)
            //->where('user_id', '=', Auth::user()->id)
            ->get();
        //dd($contestadas);
        $encuesta = Poll::find($id);

        $preguntas = Question::where('poll_id', '=', $encuesta->id)
            ->get();
        return view('user.encuestas.grupos.grupos', compact('encuesta', 'preguntas', 'contestadas', 'generaldefinitions'));

    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function desvincular($id, $poll_id)
    {
        //desvincular encuesta de usuario para que no la vuelva a aplicar
        $poll__users =  DB::table('poll__users')
            ->where('user_id', '=',  $id)
            ->where('poll_id', '=',  $poll_id)
            ->delete();
        
        return;
    }
    


}
